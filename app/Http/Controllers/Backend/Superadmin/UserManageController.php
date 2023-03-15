<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_datas = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->whereNotIn('users.id', [1])
            ->select('users.*', 'roles.name')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.pages.superadmin.users.users', compact('show_datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('backend.pages.superadmin.users.add', compact('user_role','permissions'));
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
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|digits:11',
            'designation' => 'required',
            'role_id' => 'required',
            'image' => 'required',
            'status' => 'required',
            'password' => 'required|min:6',
        ]);

        // image upload
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        $uploadPath = 'public/uploads/user/';
        $file->move($uploadPath, $name);
        $fileUrl = $uploadPath.$name;

        $store_data = new User();
        $store_data->name = $request->name;
        $store_data->username = $request->username;
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->designation = $request->designation;
        $store_data->role_id = $request->role_id;
        $store_data->image = $fileUrl;
        $store_data->password = bcrypt(request('password'));
        $store_data->status = $request->status;
        $store_data->save();

        // Permission Save
        $store_data->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'User added successfully');
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
        $user = User::find($id);
        $user_role = Role::all();

        return view('backend.pages.superadmin.users.edit', compact('user', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|digits:11',
            'designation' => 'required',
            'role_id' => 'required',
            'password' => 'nullable|same:confirmed',
            'status' => 'required',
        ]);
        $update_data = User::find($request->hidden_id);
        // image upload
        $update_file = $request->file('image');
        if ($update_file) {
            $name = time().$update_file->getClientOriginalName();
            $uploadPath = 'public/uploads/user/';
            $update_file->move($uploadPath, $name);
            $fileUrl = $uploadPath.$name;
        } else {
            $fileUrl = $update_data->image;
        }

        $update_data->name = $request->name;
        $update_data->username = $request->username;
        $update_data->email = $request->email;
        $update_data->phone = $request->phone;
        $update_data->designation = $request->designation;
        $update_data->role_id = $request->role_id;
        $update_data->image = $fileUrl;
        if ($request->password) {
            $update_data->password = bcrypt($request->password);
        }
        $update_data->status = $request->status;
        $update_data->save();

        // Permission save
        $update_data->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'User updated successfully');
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
}
