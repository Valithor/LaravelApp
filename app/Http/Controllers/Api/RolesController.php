<?php

namespace App\Http\Controllers\Api;

use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $roles = Role::with('abilities')->get();

        return response()->json(compact('roles'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $abilities = Ability::get()->pluck('name', 'name');

        return response()->json(compact('abilities'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::create($request->all());
        //$role->allow($request->input('abilities'));

        $roles = Role::with('abilities')->get();

        return response()->json(compact('roles'));
    }


    /**
     * Show the form for editing Role.
     *
     * @param  \Silber\Bouncer\Database\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $role->abilities = $role->abilities()->pluck('name');

        $abilities = Ability::get()->pluck('name', 'name');

        return response()->json(compact('role','abilities'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Silber\Bouncer\Database\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required'
        ]);

        $data = $request->only('name');
        $data['title'] = $data['name'];
        $data['name'] = Str::lower($data['name']);

        $role->update($data);

        foreach ($role->getAbilities() as $ability) {
            $role->disallow($ability->name);
        }

        $role->allow($request->input('newabilities'));

        return response()->json(compact('role'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  \Silber\Bouncer\Database\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $role->delete();

        $roles = Role::with('abilities')->get();

        return response()->json(compact('roles'));
    }
}
