<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class ProvinceController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();
        $roles = Role::get();        
        
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $provinces = Province::where('name', 'LIKE', "%$keyword%")
				->orWhere('type', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $provinces = Province::paginate($perPage);
        }                
        return view('provinces.index')->with(['provinces' => $provinces,'permissions' => $permissions, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('provinces.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //##created_by
        $this->validate($request, [            
            'name' => 'required|max:40',
            'value' => 'required|unique:provinces|numeric'            
        ]);
        $requestData = $request->all();        
        Province::create($requestData);                
        return redirect()->route('provinces.index')->with('success_message', 'Province ' .$request->type ." : " . $request->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $province = Province::find($id);       
        return view('provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $province = Province::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
            'value' => 'required|unique:provinces|numeric'       
        ]);

        $input = $request->all();
        $province->fill($input)->save();

        return redirect()->route('provinces.index')->with('success_message', 'Province ' .$request->type ." : " . $request->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $province = Province::findOrFail($id);

        if (empty($province)) {
            return redirect()->route('provinces.index')->with('error_message', 'Cannot delete this Province!');
        }

        $province->delete();

        return redirect()->route('provinces.index')->with('success_message', 'Province deleted!');
    }
}