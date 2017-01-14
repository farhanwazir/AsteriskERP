<?php

namespace Asterisk\Modules\PRM\Controllers\Peoples;

use Asterisk\Http\Controllers\Controller;
use Asterisk\Http\Requests\PRMContactRequest;
use Asterisk\Modules\PRM\Models\Peoples\Contacts;
use Asterisk\Modules\PRM\Models\Peoples\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\Flash;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($people)
    {
        $people = People::findOrFail($people);
        $contacts = new \stdClass();
        $contacts->featured = $people->contacts()->featured()->allActive()->get();
        $contacts->non_featured = $people->contacts()->nonFeatured()->allActive()->get();

        return view("PRM::contacts", [ 'contacts' => $contacts, 'people' => $people, 'text' => Config::get('PRM::module.hello') ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $people
     * @return Response
     */
    public function create($people)
    {
        return view("PRM::contact.add", [ 'people' => People::findOrFail($people) ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $people
     * @param PRMContactRequest|PRMPeopleRequest $request
     * @return Response
     */
    public function store($people, PRMContactRequest $request)
    {
        $people = People::findOrFail($people);
        $contact = $people->contacts()->create($request->all());
        Flash::success( $people->full_name .', contact information has been added.');
        if($request->is_current){
            $this->removeCurrents($people, $contact->id);
        }
        if($request->is_origin){
            $this->removeOrigins($people, $contact->id);
        }
        $redirect_to = isset($request->add_more)
                        ? action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@create', ['people' => $people->id])
                        : action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['people' => $people->id]);
        return new RedirectResponse( $redirect_to );
    }

    /**
     * Display the specified resource profile.
     *
     * @param $people
     * @return Response
     * @internal param int $id
     */
    public function show($people)
    {
        return view("PRM::people.profile", ['people' => People::findOrFail($people)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $people
     * @param $contact
     * @return Response
     * @internal param int $id
     */
    public function edit($people, $contact)
    {
        return view("PRM::contact.edit", [ 'people' => $people = People::findOrFail($people), 'contact' => $people->contacts()->where('id', $contact)->first() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $people
     * @param $contact
     * @param PRMContactRequest $request
     * @return Response
     * @internal param int $id
     */
    public function update($people, $contact, PRMContactRequest $request)
    {
        $people = People::findOrFail($people);
        $contact = Contacts::findOrFail($contact);
        $contact->people()->associate($people);
        //Laravel skipping checkboxes in case of unchecked, so here i added double check condition
        $checkboxes = [];
        if(!$request->has('is_current')){
            $checkboxes['is_current'] = false;
        }
        if(!$request->has('is_origin')){
            $checkboxes['is_origin'] = false;
        }

        $contact->update(array_merge($request->all(), $checkboxes));
        if($request->is_current == true){
            $this->removeCurrents($people, $contact->id);
        }
        if($request->is_origin == true){
            $this->removeOrigins($people, $contact->id);
        }
        Flash::success( $people->full_name .', Contact information has been updated.');
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['id' => $people->id]) );
    }

    /**
     * @param $people
     * @param $contact
     * @return RedirectResponse
     */
    public function destroy($people, $contact)
    {
        $contact = Contacts::where('people_id', $people)
                            ->where('id', $contact);
        $contact->delete();
        Flash::success('Contact has been deleted.');
        return new RedirectResponse(action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['id' => $people]) );
    }

    /**
     * @param $people
     * @param int $exclude
     * @return boolean
     */
    public function removeCurrents($people, $exclude = 0)
    {
        return $this->updateSingleCol($people, 'is_current', 0, $exclude);
    }

    /**
     * @param $people
     * @param int $exclude
     * @return boolean
     */
    public function removeOrigins($people, $exclude = 0)
    {
        return $this->updateSingleCol($people, 'is_origin', 0, $exclude);
    }

    /**
     * @param $people
     * @param $col
     * @param $val
     * @param int $exclude
     * @return boolean
     */
    private function updateSingleCol($people, $col, $val, $exclude = 0){
        $contacts = $people->contacts();
        /* todo: add check, if records not more than 1 then immediately return with excute update query */
        if($exclude > 0){
            $contacts->exclude($exclude);
        }

        return $contacts->update([$col => $val]);
    }

}