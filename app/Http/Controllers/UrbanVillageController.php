<?php

namespace App\Http\Controllers;

use App\Models\SubDistrict;
use App\Models\Province;
use App\Models\City;
use App\Models\UrbanVillage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class UrbanVillageController extends Controller
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
        $sub_district = SubDistrict::get()->pluck('name', 'id')->all();
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $urbanvillages = UrbanVillage::where('name', 'LIKE', "%$keyword%")
				->orWhere('type', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $urbanvillages = UrbanVillage::paginate($perPage);
        }                
        return view('urbanvillages.index')->with(['urbanvillages' => $urbanvillages,'permissions' => $permissions, 'roles' => $roles,'sub_district' => $sub_district,'city' => $city,'province' => $province]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('urbanvillages.create')->with('roles', $roles);
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
        UrbanVillage::create($requestData);                
        return redirect()->route('urbanvillages.index')->with('success_message', 'Urban Village ' .$request->type ." : " . $request->name . ' added!');
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
        $urbanvillage = UrbanVillage::find($id);   
        $province = Province::get()->pluck('name', 'id')->all();
        $city = City::get()->pluck('name', 'id')->all();
        $sub_district = SubDistrict::get()->pluck('name', 'id')->all();
        return view('urbanvillages.edit', compact('urbanvillage','province','city','sub_district'));
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
        $urbanvillage = UrbanVillage::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $input = $request->all();
        $urbanvillage->fill($input)->save();

        return redirect()->route('urbanvillages.index')->with('success_message', 'Urban Village ' .$request->type ." : " . $request->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urbanvillage = UrbanVillage::findOrFail($id);

        if (empty($urbanvillage)) {
            return redirect()->route('urbanvillages.index')->with('error_message', 'Cannot delete this Urban Village!');
        }

        $urbanvillage->delete();

        return redirect()->route('urbanvillages.index')->with('success_message', 'Urban Village deleted!');
    }
}