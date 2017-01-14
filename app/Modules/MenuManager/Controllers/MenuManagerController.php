<?php namespace Asterisk\Modules\MenuManager\Controllers;


use Asterisk\Modules\MenuManager\Models\MenuItem;
use Asterisk\Modules\MenuManager\Models\MenuManager;
use Asterisk\Http\Requests\MenuManagerRequest;
use Asterisk\Http\Requests\MenuItemRequest;
use Illuminate\Http\RedirectResponse;
use Asterisk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

/**
 * Class MenuManagerController
 * @package Asterisk\Modules\MenuManager\Controllers
 */
class MenuManagerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view("MenuManager::index", ['menus' => MenuManager::paginate(Config::get('asterisk.list.items'))]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("MenuManager::create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MenuManagerRequest $request)
	{
		$menu = MenuManager::create($request->all());
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index'));
	}

	/**
	 * Display the specified menu items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view("MenuManager::items", ['menu' => MenuManager::findOrFail($id)] );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view("MenuManager::edit", ['menu' => MenuManager::findOrFail($id)]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MenuManagerRequest $request, $id)
	{
		$menu = MenuManager::findOrFail($id);
		$menu->update($request->all());
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$menu = MenuManager::findOrFail($id);
		$menu->delete();
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index'));
	}

	/**
	 * Trashed items display
	 * @return \Illuminate\View\View
	 */
	public function trashed()
	{
		return view("MenuManager::index", ['menus' => MenuManager::onlyTrashed()->paginate(Config::get('asterisk.list.items')), 'trashed' => true]);
	}

	/**
	 * Restore deleted item
	 * @param $id
     */
	public function restore($id)
	{
		$menu = MenuManager::onlyTrashed()
							->where('id', $id)
							->restore();
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index'));
	}

	/**
	 * Restore deleted item
	 * @param $id
	 */
	public function removeTrashed($id)
	{
		$menu = MenuManager::onlyTrashed()
			->where('id', $id)
			->forceDelete();
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@trashed'));
	}

	public function search($tag){
		return view('MenuManager::index',
					['menus' => MenuManager::where('title', 'LIKE', '%'. $tag .'%')->paginate(Config::get('asterisk.list.items')),
						'keyword' => $tag,
						'search_result' => true]);

	}

	/** Menu Item Controller Functions **/


	/**
	 * Menu Item create form
	 * @param $id = menu_id
     */
	public function itemCreate($menu){
		return view('MenuManager::items.create', ['menu' => $menu]);
	}

	/**
	 * @param $id
	 * @param MenuItemRequest $request
	 * @return RedirectResponse
     */
	public function itemStore($menu, MenuItemRequest $request){
		$menu = MenuManager::findOrFail($menu);
		$menu->items()->create($request->all());
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show', ['menu' => $menu]));
	}

	/**
	 * @param $menu
	 * @param $item
	 * @return \Illuminate\View\View
     */
	public function itemEdit($menu, $item){
		return view("MenuManager::items.edit", ['menu' => $menu, 'item' => MenuItem::findOrFail($item)]);
	}

	public function itemUpdate(MenuItemRequest $request, $menu, $item)
	{
		$item = MenuItem::findOrFail($item);
		$item->update($request->all());
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show', ['menu' => $menu]));
	}

	public function itemDestroy($menu, $item)
	{
		$item = MenuItem::findOrFail($item);
		$item->forceDelete();
		return new RedirectResponse(action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show', ['menu' => $menu]));
	}


	public function menusMatchingJSON($tag){

		return response()->json(MenuManager::where('title', 'LIKE', '%'.$tag.'%')->get());
	}

}
