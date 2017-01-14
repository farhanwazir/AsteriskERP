<?php

namespace Asterisk\Modules\PRM\Controllers\Peoples;


use Asterisk\Http\Controllers\Controller;
use Asterisk\Http\Requests\PRMPeopleRequest;
use Asterisk\Http\Requests\Request;
use Asterisk\Modules\PRM\Models\Peoples\People;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PeopleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("PRM::peoples", ['items' => People::paginate(Config::get('asterisk.list.items'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("PRM::people.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PRMPeopleRequest $request
     * @return Response
     */
    public function store(PRMPeopleRequest $request)
    {
        $redefine_values = ['photo' => Config::get('asterisk.prm.people.photo.no-photo')];
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $redefine_values['photo'] = $this->uploadDisplayPic($request->first_name, $photo);
        }
        $request_data = $request->all();
        $data = array_merge($request_data, $redefine_values);
        $people = People::create($data);

        if(Config::get('asterisk.prm.people.registration.default_country')) {
            $people->contacts()->create([ 'country_code' => $request->input('country_code'), 'is_current' => 1 ]);
        }
        if(!$people){
            Flash::error( 'Unknown error occur on creating people, try again later.' );
        } else {
            Flash::success( $people->full_name .', has been created.');
        }

        $redirect_to = config('asterisk.prm.people.registration.contact')
                    ? action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@create', ['people' => $people->id])
                    : action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['people' => $people->id]);

        return new RedirectResponse( $redirect_to );
    }

    /**
     * Display the specified resource profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view("PRM::people.profile", ['people' => People::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view("PRM::people.edit", ['people' => People::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PRMPeopleRequest $request)
    {
        $people = People::findOrFail($id);
        $people->update($request->all());
        Flash::success( $people->full_name .', personal information has been updated.');
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['people' => $people->id]) );
    }

    /**
     * @param $id
     * @param Request $request
     * @param bool|true $ajax
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function updateDisplayPic($id, PRMPeopleRequest $request, $ajax = false){
        $people = People::findOrFail($id);
        $old_photo = $people->photo;
        $redefine_values = ['photo' => $old_photo];
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $redefine_values['photo'] = $this->uploadDisplayPic($people->first_name, $photo);
            $request_data['photo'] = $request->photo;
            $data = array_merge($request_data, $redefine_values);
            $people->update($data);
            Flash::success( $people->full_name .', display picture has been updated.');
            //delete old photo
            if(Config::get('asterisk.prm.people.photo.no-photo') != $old_photo){
                $this->deleteDisplayPic($old_photo);
            }

            if($ajax){
                return response()->json(array('path'=> Config::get('asterisk.prm.people.photo.path') . $redefine_values['photo']), 200);
            }
        }else{
            Flash::error( 'No file found for upload.');
            if($ajax){
                return response()->json(false, 200);
            }
        }
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['people' => $people->id]) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $people = People::findOrFail($id);
        $name = $people->full_name;
        $people->delete();
        Flash::success($name .', has been deleted.');
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@index') );
    }

    /**
     * Trashed items display
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        return view("PRM::peoples", ['items' => People::onlyTrashed()->paginate(Config::get('asterisk.list.items')), 'trashed' => true]);
    }

    /**
     * Restore deleted item
     * @param $id
     */
    public function restore($id)
    {
        $people = People::onlyTrashed()
            ->where('id', $id)
            ->restore();
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@index'));
    }

    /**
     * Restore deleted item
     * @param $id
     */
    public function removeTrashed($id)
    {
        $people = People::onlyTrashed()
            ->where('id', $id)
            ->forceDelete();
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@trashed'));
    }

    public function search($tag){
        return view('PRM::peoples',
            ['items' => People::where('first_name', 'LIKE', '%'. $tag .'%')->orWhere('last_name', 'LIKE', '%'. $tag .'%')->paginate(Config::get('asterisk.list.items')),
                'keyword' => $tag,
                'search_result' => true]);

    }

    /*
     * Custom functions
     * */


    /**
     * @param $user
     * @param $photo
     * @return string -- filename
     */
    public function uploadDisplayPic($user, $photo){
        $filename  = rand(9, 100000) . str_random(12) . $user . str_random(11) . time() . '.' . $photo->getClientOriginalExtension();

        $photo_dir = Config::get('asterisk.prm.people.photo.path');
        $photo_dir_original = Config::get('asterisk.prm.people.photo.original_path');
        if(!File::exists($photo_dir)){
            File::makeDirectory($photo_dir, 0777, true, true);
        }
        if(!File::exists($photo_dir_original)){
            File::makeDirectory($photo_dir_original, 0777, true, true);
        }

        $path = public_path($photo_dir . $filename);
        $path_original = public_path($photo_dir_original . $filename);

        //save thumbnail
        Image::make($photo->getRealPath())->resize(Config::get('asterisk.prm.people.photo.width'), Config::get('asterisk.prm.people.photo.height'))->save($path);
        //save original file
        Image::make($photo->getRealPath())->save($path_original);

        return $filename;
    }

    /**
     * Delete Display Picture
     * @param $file_name
     * @return bool
     *
     * This function is strictly use for deletion of old display picture
     */
    public function deleteDisplayPic($file_name){
        $photo_dir = Config::get('asterisk.prm.people.photo.path');
        $photo_dir_original = Config::get('asterisk.prm.people.photo.original_path');
        if(File::exists($photo_dir . $file_name)){
            unlink($photo_dir . $file_name);
        }
        if(File::exists($photo_dir_original . $file_name)){
            unlink($photo_dir_original . $file_name);
        }

        return !File::exists($photo_dir_original . $file_name)? true : false;
    }

    public function peopleMatchingJSON($tag){

        return response()->json(People::where('first_name', 'LIKE', '%'.$tag.'%')
                                        ->orWhere('last_name', 'LIKE', '%'.$tag.'%')->get());
    }
}
