<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        if ($request->filled('search')) {

//            $search = $request->input('search');
//           $data= User::query()
//                ->where('name', 'LIKE', "%{$search}%")
//                ->orWhere('email', 'LIKE', "%{$search}%")
//                ->get();
            $data = User::search($request->search)->paginate(5);
            $trash = User::onlyTrashed()->get();

            if (!count($data)) {
                Alert::error('No search found', 'There is not users found!');
            }

        } else {
            $data = User::whereHas("roles", function($q){ $q->where("name", "user"); })->orderBy('id', 'asc')->paginate(3, ['*'], 'users');
            $trash = User::onlyTrashed()->paginate(3, ['*'], 'trashed');
        }
        return view('users.index', compact('data', 'trash', 'notifications', 'user'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success-create','The user added successfully');
    }

    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles', 'user', 'notifications'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole', 'user', 'notifications'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'sometimes'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success-edit','The user updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->tasks()->exists()) {
            return redirect()->back()->with('status', 'User belongs to task. Cannot delete.');
        } else {
            $user->delete();
        }
        return redirect()->back()->with('success-delete','The user deleted successfully');
    }

    public function restoreAll()
    {
        User::onlyTrashed()->restore();

        return redirect()->back();
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect()->back();
    }

}
