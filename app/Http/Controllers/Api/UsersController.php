<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $users = User::with('roles')->get();


        return response()->json(compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');

        return response()->json(compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required',
        ]);

        $user = User::create($request->all());

        if ($request->input('roles')) {
            foreach ($request->input('roles') as $role) {
                $user->assign($role);
            }
        }

        $users = User::with('roles')->get();

        return response()->json(compact('users'));
    }

    /**
     * Show the form for editing User.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->roles = $user->roles()->pluck('name');

        $roles = Role::get()->pluck('name', 'name');

        return response()->json(compact('user','roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->only('name','email');

        if($request->input('password')){
            $data['password'] =  $request->input('password');
        }

        $user->update($data);

        foreach ($user->roles as $role) {
            $user->retract($role);
        }
        foreach ($request->input('newroles') as $role) {
            $user->assign($role);
        }

        return response()->json(compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->delete();

        $users = User::with('roles')->get();

        return response()->json(compact('users'));
    }
}
