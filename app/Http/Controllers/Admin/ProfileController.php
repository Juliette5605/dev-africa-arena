<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateInfo(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
        ]);
        $admin->update(['name' => $request->name, 'email' => $request->email]);
        ActivityLog::log('modifié', 'Profil', 'Nom/Email mis à jour');
        return back()->with('success', '✅ Informations mises à jour.');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'current_password'  => 'required',
            'password'          => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'password.min'              => 'Minimum 8 caractères.',
            'password.confirmed'        => 'Les mots de passe ne correspondent pas.',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $admin->update(['password' => Hash::make($request->password)]);
        ActivityLog::log('modifié', 'Profil', 'Mot de passe changé');
        return back()->with('success', '✅ Mot de passe mis à jour.');
    }
}
