<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Models\Setting;
use Illuminate\Http\Request;

class CandidatureAdvancedController extends Controller
{
    // ── Notation ──────────────────────────────────────────────────
    public function noter(Request $request, Candidature $candidature)
    {
        $request->validate([
            'note'               => 'required|integer|min:1|max:5',
            'commentaire_admin'  => 'nullable|string|max:1000',
            'statut'             => 'required|in:en_attente,retenu,refuse',
        ]);

        $candidature->update([
            'note'              => $request->note,
            'commentaire_admin' => $request->commentaire_admin,
            'statut'            => $request->statut,
        ]);

        ActivityLog::log('noté', 'Candidature', $candidature->prenom.' '.$candidature->nom.' — '.$request->note.'/5');
        return back()->with('success', '✅ Évaluation enregistrée.');
    }

    // ── Basculer finaliste ────────────────────────────────────────
    public function toggleFinaliste(Candidature $candidature)
    {
        $max = (int) Setting::get('nb_finalistes', 6);
        $current = Candidature::where('finaliste', true)->count();

        if (!$candidature->finaliste && $current >= $max) {
            return back()->with('error', "⚠️ Limite atteinte : maximum {$max} finalistes.");
        }

        $candidature->update(['finaliste' => !$candidature->finaliste]);
        $action = $candidature->finaliste ? 'ajouté aux finalistes' : 'retiré des finalistes';
        ActivityLog::log($action, 'Candidature', $candidature->prenom.' '.$candidature->nom);
        return back()->with('success', "✅ {$candidature->prenom} {$candidature->nom} {$action}.");
    }

    // ── Page finalistes ───────────────────────────────────────────
    public function finalistes()
    {
        $finalistes = Candidature::where('finaliste', true)->orderByDesc('note')->get();
        $max        = (int) Setting::get('nb_finalistes', 6);
        return view('admin.finalistes', compact('finalistes', 'max'));
    }

    // ── Export PDF d'une candidature ──────────────────────────────
    public function exportPdf(Candidature $candidature)
    {
        $html = view('admin.pdf.candidature', compact('candidature'))->render();

        // Générer PDF avec DomPDF (si installé) ou HTML brut
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
            ActivityLog::log('exporté PDF', 'Candidature', $candidature->prenom.' '.$candidature->nom);
            return $pdf->download('candidature-'.$candidature->id.'.pdf');
        }

        // Fallback : HTML imprimable
        ActivityLog::log('exporté HTML', 'Candidature', $candidature->prenom.' '.$candidature->nom);
        return response($html)->header('Content-Type', 'text/html');
    }

    // ── Sauvegarde BDD ────────────────────────────────────────────
    public function backupDatabase()
    {
        $dbName = config('database.connections.mysql.database');
        $user   = config('database.connections.mysql.username');
        $pass   = config('database.connections.mysql.password');
        $host   = config('database.connections.mysql.host');
        $file   = storage_path('app/backups/backup-'.date('Y-m-d-His').'.sql');

        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        $tables  = \DB::select('SHOW TABLES');
        $key     = 'Tables_in_'.$dbName;
        $sql     = "-- DevAfrica Arena — Backup ".date('Y-m-d H:i:s')."\n\n";

        foreach ($tables as $table) {
            $t   = $table->$key;
            $sql .= "DROP TABLE IF EXISTS `{$t}`;\n";
            $create = \DB::select("SHOW CREATE TABLE `{$t}`");
            $sql .= $create[0]->{'Create Table'}.";\n\n";
            $rows = \DB::table($t)->get();
            foreach ($rows as $row) {
                $vals = collect((array)$row)->map(fn($v) => is_null($v) ? 'NULL' : "'".addslashes($v)."'")->implode(', ');
                $sql .= "INSERT INTO `{$t}` VALUES ({$vals});\n";
            }
            $sql .= "\n";
        }

        file_put_contents($file, $sql);
        ActivityLog::log('sauvegardé', 'Base de données', basename($file));

        return response()->download($file, basename($file))->deleteFileAfterSend(false);
    }
}
