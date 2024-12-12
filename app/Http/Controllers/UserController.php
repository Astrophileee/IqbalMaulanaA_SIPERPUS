<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->syncRoles($request->role);

        return response()->json(['success' => true, 'message' => 'Role updated successfully.']);
    }


    public function generatePDF(){

        $users = User::all();
        $roles = Role::all();
        $pdf = FacadePdf::loadView('users.pdf', ['users' => $users, 'roles' => $roles]);

        return $pdf->download('tableUsers.pdf');

    }
}
