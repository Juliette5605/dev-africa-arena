<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Edition;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ─────────────────────────
        Admin::firstOrCreate(
            ['email' => 'alex.wilson@devafricaarena.ai'],
            [
                'name'     => 'Adjété Alex WILSON',
                'password' => Hash::make('DevAfricaArena2026@Admin'),
            ]
        );

        // ── Edition ───────────────────────
        Edition::firstOrCreate(
            ['nom' => 'DevAfricaArena Edition #1 — Saison 2026'],
            [
                'date_selection' => '2026-09-12',
                'date_finale'    => '2026-09-13',
                'lieu'           => 'Lomé, Togo',
                'active'         => true,
            ]
        );

        // ── Quiz ─────────────────────────
        $this->seedHighLevelQuizzes();

        $this->command->info('🔥 DB prête avec Quiz intelligents');
    }

    private function seedHighLevelQuizzes()
    {
        $data = [
            [
                'domaine' => 'ia',
                'niveau' => 'avance',
                'type' => 'open_question',
                'points' => 20,
                'enonce' => "Pourquoi le Gradient Clipping est indispensable dans les RNN ?",
                'explication' => "Empêche l'explosion du gradient.",
                'options' => [
                    ['t' => "Accélérer Adam", 'c' => false],
                    ['t' => "Éviter explosion du gradient", 'c' => true],
                    ['t' => "Réduire taille modèle", 'c' => false],
                ]
            ],
            [
                'domaine' => 'web',
                'niveau' => 'intermediaire',
                'type' => 'qcm',
                'points' => 10,
                'enonce' => "Différence entre interface et classe abstraite en PHP ?",
                'explication' => "Interface = contrat, classe abstraite = logique possible.",
                'options' => [
                    ['t' => "Interface permet multi-implémentation", 'c' => true],
                    ['t' => "Classe abstraite sans constructeur", 'c' => false],
                ]
            ]
        ];

        foreach ($data as $item) {

            // 🔥 éviter doublons
            $exists = Question::where('enonce', $item['enonce'])->first();
            if ($exists) continue;

            $q = Question::create([
                'domaine' => $item['domaine'],
                'niveau' => $item['niveau'],
                'type' => $item['type'],
                'points' => $item['points'],
                'enonce' => $item['enonce'],
                'explication' => $item['explication'],
            ]);

            foreach ($item['options'] as $opt) {
                QuestionOption::create([
                    'question_id' => $q->id,
                    'texte' => $opt['t'],
                    'est_correcte' => $opt['c']
                ]);
            }
        }
    }
}