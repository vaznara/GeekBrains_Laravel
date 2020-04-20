<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('form_validator:\App\User', ['only' => 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $users = User::query()
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role', 'roles.slug as slug')
            ->paginate(9);

        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        if($user->id == 1) {
            return redirect()->route('admin.user.index')->with(['error' => 'Редактирование главного админа запрещено']);
        }

        // Если пользователь не супер админ и пытается редактировать админа - редиректим на список пользователей с ошибкой
        if(!Auth::user()->isSuper() && $user->hasRole('admin')) {
            return redirect()->route('admin.user.index')->with(['error' => 'У вас нет прав доступа на редактирование админа']);
        }

        $roles = Role::query()->get();
        return view('admin.user.form', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {

        if($request->password) {
            $user->fill($request->all());
            $user->password = Hash::make($request->password);
        } else {
            $user->fill($request->except(['password', 'password_confirmation']));
        }

        $user->save();

        return redirect()->route('admin.user.index')->with(['success' => 'Данные пользовтеля были обновлены']);
    }

    /**
     * Remove the specified resource from storage
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if($user->id == Auth::user()->id) {
            return redirect()->route('admin.user.index')->with(['error' => 'Невозможно удалить самого себя']);
        }

        // Если пользователь не супер админ и пытается редактировать админа - редиректим на список пользователей с ошибкой
        if(!Auth::user()->isSuper() && $user->hasRole('admin')) {
            return redirect()->route('admin.user.index')->with(['error' => 'Вы не можете удалить админа']);
        }

        $user->delete();
        return redirect()->route('admin.user.index')->with(['success' => 'Пользователь удален']);
    }
}
