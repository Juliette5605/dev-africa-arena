<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Edition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Compte administrateur par défaut (TalentSync AI) ─────────
        Admin::firstOrCreate(
            ['email' => 'alex.wilson@talentsync.ai'], // Nouvel email pro
            [
                'name'     => 'Adjété Alex WILSON',
                'password' => Hash::make('TalentSync2026@Admin'), // Nouveau mot de passe
            ]
        );

        // ── Édition active ───────────────────────────
        Edition::firstOrCreate(
            ['nom' => 'TalentSync Edition #1 — Saison 2026'],
            [
                'date_selection' => '2026-09-12',
                'date_finale'    => '2026-09-13',
                'lieu'           => 'Lomé, Togo',
                'active'         => true,
            ]
        );

        $this->command->info('');
        $this->command->info('    Base de données TalentSync AI initialisée !');
        $this->command->info('');
        $this->command->info('   Compte admin créé :');
        $this->command->info('   ✉  alex.wilson@talentsync.ai');
        $this->command->info('   🔑 TalentSync2026@Admin');
        $this->command->info('');
        $this->command->info('   Panel admin → http://localhost:8000/admin');
        $this->command->info('');
    }
}