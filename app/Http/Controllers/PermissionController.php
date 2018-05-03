<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Excel;

class PermissionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::get();
        return view('permissions.index')->with(['permissions' => $permissions, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('permissions.create')->with('roles', $roles);
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
            'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) {
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')->with('success_message', 'Permission' . $permission->name . ' added!');
    }

    public function storeWithExcel(Request $request)
    {
        $validator = Validator::make([
                    'file_import' => $request->file('file_import'),
                    'extension' => strtolower($request->file('file_import')->getClientOriginalExtension()),
                        ], [
                    'file_import' => 'required',
                    'extension' => 'required|in:csv,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('file_import')) {
            //return 'have a file';
            $path = $request->file('file_import')->getRealPath();
            $fileName = $request->file('file_import')->getClientOriginalName();
            $partName = 'Import Permission ' . ' ' . date('Ymd-His') . ' ';

            $dataCSV = Excel::load($path, function ($reader) {
                        $reader->toArray();
                    })->get();
            if (!empty($dataCSV) && $dataCSV->count() && isset($dataCSV[0]['permission'])):
                $request->file('file_import')->storeAs('Permission', $partName . $fileName, 'public');
                foreach ($dataCSV as $csv):
                    Permission::create(['name' => trim($csv['permission'])]);
                endforeach;
                return back()->with('success_message', 'Import has been added.');
            else:
                return back()->with('error_message', 'File Data Excel/CSV Kosong atau Format Data Salah...');
            endif;
        }
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
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
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
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')->with('success_message', 'Permission' . $permission->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')->with('error_message', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('permissions.index')->with('success_message', 'Permission deleted!');
    }

}
