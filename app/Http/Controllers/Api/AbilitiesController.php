<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Silber\Bouncer\Database\Ability;

class AbilitiesController extends Controller
{
    /**
     * Display a listing of Abilities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $abilities = Ability::all();

        return response()->json(compact('abilities'));
    }

    /**
     * Show the form for creating new Ability.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return response()->json(compact(''));
    }

    /**
     * Store a newly created Ability in storage.
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

        Ability::create($request->all());

        $abilities = Ability::all();

        return response()->json(compact('abilities'));
    }


    /**
     * Show the form for editing Ability.
     *
     * @param  \Silber\Bouncer\Database\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function edit(Ability $ability)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return response()->json(compact('ability'));
    }

    /**
     * Update Ability in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Silber\Bouncer\Database\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ability $ability)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $ability->update($request->all());

        return response()->json(compact('ability'));
    }


    /**
     * Remove Ability from storage.
     *
     * @param  \Silber\Bouncer\Database\Ability $ability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ability $ability)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $ability->delete();

        $abilities = Ability::all();

        return response()->json(compact('abilities'));
    }

}
