<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Lookup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class UnitController extends Controller
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
        $active = Lookup::where('type', 'IsActive')->get()->pluck('name', 'value')->all();
        
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $units = Unit::where('name', 'LIKE', "%$keyword%")
				->orWhere('code', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $units = Unit::paginate($perPage);
        }                
        return view('units.index')->with(['units' => $units,'permissions' => $permissions, 'roles' => $roles, 'active' => $active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('units.create')->with('roles', $roles);
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
            'type' => 'required|numeric|max:40',
            'name' => 'required|max:40',
            'code' => 'required|numeric',
            'short_name' => 'required|max:20',
            'active' => 'required|numeric'
        ]);
        $requestData = $request->all();        
        Unit::create($requestData);                
        return redirect()->route('units.index')->with('success_message', 'Unit ' .$request->type ." : " . $request->name . ' added!');
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
        $unit = Unit::find($id);       
        $active = Lookup::where('type', 'IsActive')->get()->pluck('name', 'value')->all();
        return view('units.edit', compact('unit','active'));
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
        $unit = Unit::findOrFail($id);

        $this->validate($request, [
              'type' => 'required|max:40',
            'name' => 'required|max:40',
            'code' => 'required|numeric',
            'short_name' => 'required|max:20',
            'active' => 'required|numeric'
        ]);

        $input = $request->all();
        $unit->fill($input)->save();

        return redirect()->route('units.index')->with('success_message', 'Unit ' .$request->type ." : " . $request->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);

        if (empty($unit)) {
            return redirect()->route('units.index')->with('error_message', 'Cannot delete this Unit!');
        }

        $unit->delete();

        return redirect()->route('units.index')->with('success_message', 'Unit deleted!');
    }
}