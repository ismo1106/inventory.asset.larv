<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus['level_1'] = Menu::where('header', 0)->orderBy('order', 'asc')->get();
        $menus['level_2'] = Menu::where('header', '<>', 0)->orderBy('order', 'asc')->get();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
        ]);

        Menu::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'updated_by' => auth()->user()->id,
        ]);
        return back()->with('success_message', 'Menu successfully added.');
    }

    public function updateSort(Request $request)
    {
        $post_db = array();
        $array = json_decode($request->input('txt-sort'), true);
        $post_db = $this->run_array_parent($array, '0');

        foreach ($post_db as $id => $value) {
            $menu = Menu::find($id);
            $menu->header = $value['parent'];
            $menu->order = $value['order'];
            $menu->save();
        }

        return back()->with('success_message', 'Menu successfully updated.');
    }

    public function run_array_parent($array, $parent)
    {
        $post_db = array();
        foreach ($array as $head => $body) {
            if (isset($body['children'])) {
                $head++;
                $post_db[$body['id']] = ['parent' => $parent, 'order' => $head];
                $post_db = $post_db + $this->run_array_parent($body['children'], $body['id']);
            } else {
                $head++;
                $post_db[$body['id']] = ['parent' => $parent, 'order' => $head];
            }
        }

        return $post_db;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }

    public function testMethod()
    {
        $routeArray = request()->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);

        $nameClass = rtrim($controller, 'Controller');
        $nameMethod = request()->route()->getActionMethod();

        return response()->json([
                    $nameClass,
                    $nameMethod,
                    1
        ]);
    }

}
