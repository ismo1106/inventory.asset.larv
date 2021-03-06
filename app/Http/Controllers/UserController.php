<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Spatie\Permission\Models\Role;
use App\User;
use Excel;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::where('id', '<>', auth()->user()->id);

            return Datatables::eloquent($users)
                            ->addColumn('role', function ($user) {
                                return ($user->roles()->pluck('name')->implode(' ') ? $user->roles()->pluck('name')->implode(' ') : '-');
                            })
                            ->addColumn('actions', function ($user) {
                                $edit = '<a href="' . route('users.edit', $user->id) . '" class="edit-user btn btn-xs btn-info pull-left ladda-button" '
                                        . 'data-style="slide-left" style="margin-right: 3px;"><span class="ladda-label">Edit</span></a>';
                                $delete = \Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]])
                                        . \Form::submit('Delete', ['class' => 'delete-user btn btn-xs btn-danger']) . \Form::close();
                                return $edit . $delete;
                            })
                            ->rawColumns(['actions'])->make(true);
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
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
            'name' => 'required|max:120',
            'username' => 'required|max:120|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
                    'name' => $request->input('name'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'status' => $request->input('status'),
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
        ]);

        $roles = $request['roles'];

        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('users.index')->with('success_message', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:120',
            'username' => 'required|max:120|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $input = $request->only(['name', 'email', 'username']);
        $roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }
        return redirect()->route('users.index')->with('success_message', 'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportToExcel()
    {
        $users = User::select('name', 'username', 'email', 'created_at')->get();

        $usersArray = [];
        // Define the Excel spreadsheet headers
        $usersArray[] = ['Name', 'Username', 'Email', 'Created At'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($users as $user) {
            $usersArray[] = $user->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('users', function($excel) use ($usersArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Users');
            $excel->setCreator('Team')->setCompany('Fast App');
            $excel->setDescription('users file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($usersArray) {
                $sheet->fromArray($usersArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

}
