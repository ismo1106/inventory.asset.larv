<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class LookupController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::get();
        $lookups = Lookup::all(); 
        return view('lookups.index')->with(['lookups' => $lookups,'permissions' => $permissions, 'roles' => $roles]);
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
            'type' => 'required|max:40',
            'name' => 'required|max:40',
            'value' => 'required|numeric',
            'order_no' => 'required|numeric'
        ]);
        $requestData = $request->all();        
        Lookup::create($requestData);                
        return redirect()->route('lookups.index')->with('success_message', 'Lookup ' .$request->type ." : " . $request->name . ' added!');
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
        $lookup = Lookup::find($id);       
        return view('lookups.edit', compact('lookup'));
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
        $lookup = Lookup::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $input = $request->all();
        $lookup->fill($input)->save();

        return redirect()->route('lookups.index')->with('success_message', 'Lookup ' .$request->type ." : " . $request->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lookup = Lookup::findOrFail($id);

        if (empty($lookup)) {
            return redirect()->route('lookups.index')->with('error_message', 'Cannot delete this Permission!');
        }

        $lookup->delete();

        return redirect()->route('lookups.index')->with('success_message', 'Lookup deleted!');
    }
}