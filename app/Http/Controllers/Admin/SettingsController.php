<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'      => 'required|string|max:100',
            'site_slogan'    => 'required|string|max:200',
            'site_email'     => 'required|email',
            'site_phone'     => 'required|string|max:30',
            'site_address'   => 'required|string|max:200',
            'cash_prize'     => 'required|string|max:30',
            'max_candidats'  => 'required|integer|min:1',
            'nb_finalistes'  => 'required|integer|min:1',
            'nb_jours'       => 'required|integer|min:1',
        ]);

        $fields = [
            'site_name','site_slogan','site_email','site_phone','site_address',
            'cash_prize','max_candidats','nb_finalistes','nb_jours',
            'facebook','linkedin','instagram','twitter',
            'maintenance_msg','newsletter_subject',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) Setting::set($field, $request->input($field));
        }

        // Maintenance — checkbox
        Setting::set('maintenance_mode', $request->has('maintenance_mode') ? '1' : '0');

        ActivityLog::log('modifié', 'Paramètres', 'Mise à jour générale des paramètres');
        return back()->with('success', '✅ Paramètres sauvegardés avec succès.');
    }
}
