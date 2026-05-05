<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    // Liste des sous-admins
    public function index()
    {
        $subAdmins = Admin::where('role', 'sub')->latest()->get();
        return view('admin.admins.index', compact('subAdmins'));
    }

    // Créer un sous-admin
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required'      => 'Le nom est obligatoire.',
            'email.required'     => 'L\'email est obligatoire.',
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.required'  => 'Le mot de passe est obligatoire.',
            'password.min'       => 'Minimum 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        Admin::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'sub',
            'can_edit'   => false,
            'created_by' => Auth::guard('admin')->id(),
        ]);

        return back()->with('success', ' Sous-admin créé avec succès.');
    }

    // Basculer la délégation (accorder / révoquer les droits de modification)
    public function toggleDelegation(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return back()->with('error', 'Impossible de modifier un super-admin.');
        }

        $admin->update(['can_edit' => !$admin->can_edit]);

        $status = $admin->can_edit ? 'accordée ' : 'révoquée ';
        return back()->with('success', "Délégation {$status} pour {$admin->name}.");
    }

    // Supprimer un sous-admin
    public function destroy(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return back()->with('error', 'Impossible de supprimer le super-admin.');
        }

        $admin->delete();
        return back()->with('success', ' Sous-admin supprimé.');
    }
}
