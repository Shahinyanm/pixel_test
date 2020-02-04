<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\UserCreateRequest;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::users()->get()->sortByDesc('id');

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.users.create-edit', compact('departments'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->name),
        ]);

        if ($request->has('departments') && !empty($request->departments)) {
            $user->users()->sync($request->departments);
        }

        notify()->success(__('main.user_created_successfully'));

        return redirect()->route('dashboard.users.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        $departments = Department::all();

        return view('dashboard.users.create-edit', compact('user','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User     $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = $request->password;
        }
        $user->save();

        if ($request->has('departments') && !empty($request->departments)) {
            $user->users()->sync($request->departments);
        }
        notify()->success(__('main.user_updated_successfully'));

        return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        notify()->success(__('main.user_deleted_successfully'));
        return back();

    }
}
