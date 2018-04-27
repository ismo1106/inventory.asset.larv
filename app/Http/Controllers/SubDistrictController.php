<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use App\Models\Province;
use App\Models\City;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class SubDistrictController extends Controller
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
        $province = Province::get()->pluck('name', 'id')->all();
        $city = City::get()->pluck('name', 'id')->all();
                
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $subdistricts = SubDistrict::where('name', 'LIKE', "%$keyword%")
				->orWhere('type', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $subdistricts = SubDistrict::paginate($perPage);
        }                
        return view('subdistricts.index')->with(['subdistricts' => $subdistricts,'province' => $province,'city' => $city,'permissions' => $permissions, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('subdistricts.create')->with('roles', $roles);
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
            'type' => 'required|max:40',
            'name' => 'required|max:40',
            'value' => 'required|numeric',
            'order_no' => 'required|numeric'
        ]);
        $requestData = $request->all();        
        SubDistrict::create($requestData);                
        return redirect()->route('subdistricts.index')->with('success_message', 'Sub District ' .$request->type ." : " . $request->name . ' added!');
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
        $subdistrict = SubDistrict::find($id);  
        $province = Province::get()->pluck('name', 'id')->all();
        $city = City::get()->pluck('name', 'id')->all();
                
        return view('subdistricts.edit', compact('subdistrict','city','province'));
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
        $subdistrict = SubDistrict::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $input = $request->all();
        $subdistrict->fill($input)->save();

        return redirect()->route('subdistricts.index')->with('success_message', 'Sub District ' .$request->type ." : " . $request->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subdistrict = SubDistrict::findOrFail($id);

        if (empty($subdistrict)) {
            return redirect()->route('subdistricts.index')->with('error_message', 'Cannot delete this Sub District!');
        }

        $subdistrict->delete();

        return redirect()->route('subdistricts.index')->with('success_message', 'Sub District deleted!');
    }
}