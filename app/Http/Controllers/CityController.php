<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CityController extends Controller
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
        
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $cities = City::where('name', 'LIKE', "%$keyword%")
				->orWhere('type', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $cities = City::paginate($perPage);
        }                
        
        return view('cities.index')->with(['cities' => $cities,'permissions' => $permissions, 'roles' => $roles, 'province' => $province]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('lookups.create')->with('roles', $roles);
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
            'value' => 'required|unique:cities|numeric',
            'province_id' => 'required|numeric'
        ]);
        $requestData = $request->all();        
        City::create($requestData);                
        return redirect()->route('cities.index')->with('success_message', 'City ' .$request->type ." : " . $request->name . ' added!');
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
        $city = City::find($id);       
        $province = Province::get()->pluck('name', 'id')->all();
        return view('cities.edit', compact('city','province'));
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
        $city = City::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
            'value' => ['required',Rule::unique('cities')->ignore($city->id),'numeric'],
            'province_id' => 'required|numeric'
        ]);

        $input = $request->all();
        $city->fill($input)->save();

        return redirect()->route('cities.index')->with('success_message', 'City ' .$request->name ." : " . $request->value . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = Cityt::findOrFail($id);

        if (empty($city)) {
            return redirect()->route('cities.index')->with('error_message', 'Cannot delete this City!');
        }

        $city->delete();

        return redirect()->route('cities.index')->with('success_message', 'City deleted!');
    }
}