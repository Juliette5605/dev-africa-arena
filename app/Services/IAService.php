<?php

namespace App\Services;

use App\Models\Candidature;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class IAService
{
    protected string $baseUrl;
    protected string $jobsUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) env('IA_SERVICE_URL', 'https://web-production-f3fa9.up.railway.app'), '/');
        $this->jobsUrl = (string) env('IA_JOBS_URL', 'https://sheetdb.io/api/v1/qg4gis5u4esa6');
    }

    public function health(): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(10)
                ->get($this->baseUrl . '/health');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'mode' => 'remote',
                    'message' => 'Microservice IA en ligne',
                    'data' => $response->json(),
                ];
            }
        } catch (Throwable $e) {
            Log::warning('IA health check failed: ' . $e->getMessage());
        }

        return [
            'success' => true,
            'mode' => 'local',
            'message' => 'Microservice indisponible, fallback local actif',
            'data' => ['status' => 'fallback'],
        ];
    }

    public function generateCv(Candidature $candidat): array
    {
        $payload = [
            'profil' => [
                'nom' => $candidat->nom,
                'prenom' => $candidat->prenom,
                'email' => $candidat->email,
                'telephone' => '',
                'localisation' => $candidat->pays ?: 'Lome, Togo',
                'competences' => $this->extractSkills($candidat),
                'langages' => [],
                'experiences' => [],
                'formations' => [[
                    'diplome' => $candidat->diplome,
                    'etablissement' => 'DevAfricaArena',
                    'annee' => optional($candidat->created_at)->format('Y'),
                ]],
                'objectif_professionnel' => $candidat->motivation,
            ],
        ];

        try {
            $response = Http::acceptJson()
                ->timeout(25)
                ->post($this->baseUrl . '/generate-cv', $payload);

            if ($response->successful()) {
                $content = $this->extractDocumentContent($response->json(), ['cv', 'content', 'result']);

                if ($content !== null) {
                    return [
                        'success' => true,
                        'content' => $content,
                        'source' => 'remote',
                    ];
                }
            }
        } catch (Throwable $e) {
            Log::warning('IA generate CV failed: ' . $e->getMessage());
        }

        return [
            'success' => true,
            'content' => $this->buildLocalCv($candidat),
            'source' => 'local',
            'warning' => 'CV genere localement car le microservice n’a pas retourne de contenu exploitable.',
        ];
    }

    public function generateCoverLetter(Candidature $candidat, string $poste, ?string $entreprise = null): array
    {
        $entreprise = trim($entreprise ?: 'DevAfricaArena');

        $payload = [
            'profil' => [
                'nom' => $candidat->nom,
                'prenom' => $candidat->prenom,
                'email' => $candidat->email,
                'competences' => $this->extractSkills($candidat),
                'objectif_professionnel' => $candidat->motivation,
            ],
            'poste' => $poste,
            'entreprise' => $entreprise,
            'motivation' => $candidat->motivation,
            'offre' => [
                'titre' => $poste,
                'entreprise' => $entreprise,
                'description' => 'Opportunite coherente avec le profil candidat DevAfricaArena.',
            ],
        ];

        try {
            $response = Http::acceptJson()
                ->timeout(25)
                ->post($this->baseUrl . '/generate-cover-letter', $payload);

            if ($response->successful()) {
                $content = $this->extractDocumentContent($response->json(), ['lettre', 'content', 'result']);

                if ($content !== null) {
                    return [
                        'success' => true,
                        'content' => $content,
                        'source' => 'remote',
                    ];
                }
            }
        } catch (Throwable $e) {
            Log::warning('IA generate cover letter failed: ' . $e->getMessage());
        }

        return [
            'success' => true,
            'content' => $this->buildLocalCoverLetter($candidat, $poste, $entreprise),
            'source' => 'local',
            'warning' => 'Lettre generee localement car le microservice n’a pas repondu correctement.',
        ];
    }

    public function matchOpportunities(Candidature $candidat): array
    {
        $offers = $this->fetchOffers();

        try {
            $response = Http::acceptJson()
                ->timeout(25)
                ->post($this->baseUrl . '/match-opportunities', [
                    'profil' => [
                        'nom' => $candidat->nom,
                        'prenom' => $candidat->prenom,
                        'email' => $candidat->email,
                        'competences' => $this->extractSkills($candidat),
                        'niveau' => $candidat->niveau,
                        'localisation' => $candidat->pays ?: 'Lome, Togo',
                    ],
                    'offres' => $offers,
                ]);

            if ($response->successful()) {
                $matches = $this->normalizeMatches($response->json(), $offers);

                if (!empty($matches)) {
                    return [
                        'success' => true,
                        'matches' => $matches,
                        'source' => 'remote',
                    ];
                }
            }
        } catch (Throwable $e) {
            Log::warning('IA opportunity matching failed: ' . $e->getMessage());
        }

        return [
            'success' => true,
            'matches' => $this->localMatch($candidat, $offers),
            'source' => 'local',
            'warning' => 'Matching calcule localement avec les offres disponibles.',
        ];
    }

    public function autoApply(Candidature $candidat, string $offreTitre, string $offreUrl): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(40)
                ->post($this->baseUrl . '/auto-apply', [
                    'profil' => [
                        'nom' => $candidat->nom,
                        'prenom' => $candidat->prenom,
                        'email' => $candidat->email,
                        'competences' => $this->extractSkills($candidat),
                    ],
                    'offre' => [
                        'titre' => $offreTitre,
                        'url' => $offreUrl,
                    ],
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'result' => $response->json(),
                    'source' => 'remote',
                ];
            }
        } catch (Throwable $e) {
            Log::warning('IA auto-apply failed: ' . $e->getMessage());
        }

        return [
            'success' => true,
            'result' => [
                'status' => 'prepared',
                'message' => "Le dossier de {$candidat->prenom} {$candidat->nom} est prepare pour l'offre \"{$offreTitre}\".",
                'next_step' => 'Verifiez manuellement le lien de l’offre et envoyez le dossier genere.',
                'offre_url' => $offreUrl,
            ],
            'source' => 'local',
        ];
    }

    public function genererCV(Candidature $candidat)
    {
        $result = $this->generateCv($candidat);

        return $result['content'];
    }

    public function genererLettre(Candidature $candidat, $offreTitre = 'Developpeur Fullstack')
    {
        $result = $this->generateCoverLetter($candidat, (string) $offreTitre, 'DevAfricaArena');

        return $result['content'];
    }

    public function analyserCandidat($motivation, $expertise)
    {
        try {
            $response = Http::acceptJson()
                ->timeout(15)
                ->post($this->baseUrl . '/analyse-candidat', [
                    'motivation' => $motivation,
                    'expertise' => $expertise,
                ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (Throwable $e) {
            Log::warning('IA Analyse Error: ' . $e->getMessage());
        }

        $score = $this->calculerScoreLocal($motivation, $expertise);
        $analyse = $this->genererAnalyseLocal($motivation, $expertise, $score);

        return [
            'score' => $score,
            'analyse' => $analyse,
        ];
    }

    protected function fetchOffers(): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(15)
                ->get($this->jobsUrl);

            if ($response->successful() && is_array($response->json())) {
                $offers = collect($response->json())
                    ->filter(fn ($offer) => !empty($offer['Titre']))
                    ->map(fn ($offer) => [
                        'titre' => $offer['Titre'],
                        'entreprise' => $offer['Entreprise'] ?? 'Entreprise partenaire',
                        'ville' => $offer['Ville'] ?? 'Remote',
                        'type' => $offer['Type'] ?? 'Mission',
                        'url' => $offer['Lien'] ?? '#',
                        'image' => $offer['Image'] ?? null,
                        'keywords' => $this->extractKeywords($offer['Titre'] . ' ' . ($offer['Type'] ?? '') . ' ' . ($offer['Ville'] ?? '')),
                    ])
                    ->values()
                    ->all();

                if (!empty($offers)) {
                    return $offers;
                }
            }
        } catch (Throwable $e) {
            Log::warning('Offers fetch failed: ' . $e->getMessage());
        }

        return [
            [
                'titre' => 'Developpeur Laravel Junior',
                'entreprise' => 'Startup Lome Tech',
                'ville' => 'Lome',
                'type' => 'CDI',
                'url' => 'https://example.com/jobs/laravel-junior',
                'image' => null,
                'keywords' => ['laravel', 'php', 'backend', 'api'],
            ],
            [
                'titre' => 'Designer Produit UX/UI',
                'entreprise' => 'Creative Studio Africa',
                'ville' => 'Remote',
                'type' => 'Freelance',
                'url' => 'https://example.com/jobs/designer-ux-ui',
                'image' => null,
                'keywords' => ['design', 'ux', 'ui', 'figma', 'prototype'],
            ],
            [
                'titre' => 'Analyste Data Junior',
                'entreprise' => 'Data Impact',
                'ville' => 'Accra',
                'type' => 'Stage',
                'url' => 'https://example.com/jobs/data-analyst',
                'image' => null,
                'keywords' => ['data', 'analyse', 'sql', 'python', 'dashboard'],
            ],
            [
                'titre' => 'Growth Marketer Digital',
                'entreprise' => 'Growth Africa',
                'ville' => 'Remote',
                'type' => 'CDD',
                'url' => 'https://example.com/jobs/growth-marketer',
                'image' => null,
                'keywords' => ['marketing', 'seo', 'contenu', 'growth', 'acquisition'],
            ],
            [
                'titre' => 'Ingenieur IoT et Prototypage',
                'entreprise' => 'Maker Lab',
                'ville' => 'Lome',
                'type' => 'Mission',
                'url' => 'https://example.com/jobs/iot-maker',
                'image' => null,
                'keywords' => ['iot', 'maker', 'hardware', 'prototypage', 'embarque'],
            ],
        ];
    }

    protected function normalizeMatches(mixed $payload, array $offers): array
    {
        $matches = [];
        $rawMatches = $this->extractMatchArray($payload);

        foreach ($rawMatches as $item) {
            if (is_string($item)) {
                $offer = collect($offers)->first(fn ($offer) => Str::contains(Str::lower($offer['titre']), Str::lower($item)));

                $matches[] = $offer ?: ['titre' => $item];
                continue;
            }

            if (!is_array($item)) {
                continue;
            }

            $matches[] = [
                'titre' => $item['titre'] ?? $item['title'] ?? $item['poste'] ?? 'Opportunite recommande',
                'entreprise' => $item['entreprise'] ?? $item['company'] ?? null,
                'ville' => $item['ville'] ?? $item['location'] ?? null,
                'type' => $item['type'] ?? null,
                'url' => $item['url'] ?? $item['lien'] ?? null,
                'score' => $item['score'] ?? null,
                'source' => 'remote',
            ];
        }

        return array_values(array_filter($matches));
    }

    protected function extractMatchArray(mixed $payload): array
    {
        if (is_array($payload) && array_is_list($payload)) {
            return $payload;
        }

        if (!is_array($payload)) {
            return [];
        }

        foreach (['matches', 'opportunites', 'opportunities', 'results', 'data'] as $key) {
            $value = data_get($payload, $key);
            if (is_array($value)) {
                return $value;
            }
        }

        return [];
    }

    protected function localMatch(Candidature $candidat, array $offers): array
    {
        $skills = $this->extractSkills($candidat);
        $skillTokens = collect($skills)
            ->flatMap(fn ($skill) => $this->extractKeywords($skill))
            ->unique()
            ->values()
            ->all();

        $matches = collect($offers)
            ->map(function ($offer) use ($skillTokens, $candidat) {
                $haystack = Str::lower(
                    ($offer['titre'] ?? '') . ' ' .
                    ($offer['entreprise'] ?? '') . ' ' .
                    ($offer['ville'] ?? '') . ' ' .
                    ($offer['type'] ?? '') . ' ' .
                    implode(' ', $offer['keywords'] ?? [])
                );

                $score = 0;

                foreach ($skillTokens as $token) {
                    if ($token !== '' && Str::contains($haystack, $token)) {
                        $score += 2;
                    }
                }

                if ($candidat->niveau && Str::contains($haystack, Str::lower($candidat->niveau))) {
                    $score += 1;
                }

                if ($candidat->pays && Str::contains($haystack, Str::lower($candidat->pays))) {
                    $score += 1;
                }

                return array_merge($offer, [
                    'score' => $score,
                    'source' => 'local',
                ]);
            })
            ->sortByDesc('score')
            ->take(5)
            ->values()
            ->all();

        if (!empty($matches) && ($matches[0]['score'] ?? 0) > 0) {
            return $matches;
        }

        return array_slice($offers, 0, 3);
    }

    protected function buildLocalCv(Candidature $candidat): string
    {
        $skills = implode(', ', $this->extractSkills($candidat));

        return trim(
            "CV PROFIL DEVAFRICAARENA\n\n" .
            "Identite\n" .
            "- Nom: {$candidat->prenom} {$candidat->nom}\n" .
            "- Email: {$candidat->email}\n" .
            "- Localisation: " . ($candidat->pays ?: 'Lome, Togo') . "\n\n" .
            "Profil\n" .
            ($candidat->motivation ?: 'Profil motive pour evoluer dans les metiers du numerique.') . "\n\n" .
            "Competences principales\n" .
            "- {$skills}\n" .
            "- Niveau: {$candidat->niveau}\n\n" .
            "Formation\n" .
            "- {$candidat->diplome}\n\n" .
            "Vision\n" .
            ($candidat->vision ?: 'Souhaite transformer ses competences en opportunites concretes.') . "\n\n" .
            "Conseil\n" .
            "Ajoutez vos projets concrets, outils maitrises et realisations pour renforcer ce CV."
        );
    }

    protected function buildLocalCoverLetter(Candidature $candidat, string $poste, string $entreprise): string
    {
        $displayName = trim($candidat->prenom . ' ' . $candidat->nom);
        $skills = implode(', ', $this->extractSkills($candidat));

        return trim(
            "Objet: Candidature au poste de {$poste}\n\n" .
            "Madame, Monsieur,\n\n" .
            "Je vous soumets ma candidature pour le poste de {$poste} au sein de {$entreprise}. " .
            "Mon parcours et mon implication dans l'ecosysteme DevAfricaArena m'ont permis de structurer un profil " .
            "oriente vers la resolution de problemes concrets et la creation de solutions utiles.\n\n" .
            "Je dispose d'une base en {$skills} et d'un niveau {$candidat->niveau}. " .
            "Ma motivation principale est la suivante: " . ($candidat->motivation ?: 'contribuer a des projets numeriques a fort impact.') . "\n\n" .
            "Je serais heureux de mettre mon energie, ma rigueur et ma capacite d'apprentissage au service de votre equipe.\n\n" .
            "Cordialement,\n{$displayName}"
        );
    }

    protected function extractDocumentContent(mixed $payload, array $preferredKeys): ?string
    {
        if (is_string($payload)) {
            $content = trim($payload);

            return $content !== '' ? $content : null;
        }

        if (!is_array($payload)) {
            return null;
        }

        foreach ($preferredKeys as $key) {
            $value = data_get($payload, $key);

            if (is_string($value) && trim($value) !== '') {
                return trim($value);
            }
        }

        if (!empty($payload)) {
            return json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return null;
    }

    protected function extractSkills(Candidature $candidat): array
    {
        return collect(preg_split('/[,;|\/]+/', (string) $candidat->expertise))
            ->map(fn ($skill) => trim($skill))
            ->filter()
            ->values()
            ->all() ?: ['Numerique'];
    }

    protected function extractKeywords(string $text): array
    {
        return collect(preg_split('/[^a-z0-9]+/i', Str::lower($text)))
            ->map(fn ($token) => trim($token))
            ->filter(fn ($token) => strlen($token) >= 3)
            ->unique()
            ->values()
            ->all();
    }

    private function calculerScoreLocal($motivation, $expertise)
    {
        $score = 2;

        if (strlen((string) $motivation) > 100) {
            $score++;
        }
        if (strlen((string) $motivation) > 300) {
            $score++;
        }
        if (!empty($expertise) && strlen((string) $expertise) > 5) {
            $score++;
        }

        return min(5, max(1, $score));
    }

    private function genererAnalyseLocal($motivation, $expertise, $score)
    {
        $analyses = [
            1 => 'Profil a developper. Recommandation : clarifier les objectifs professionnels.',
            2 => 'Profil elementaire. Les competences sont presentes mais peu detaillees.',
            3 => 'Profil satisfaisant. Bonnes bases avec un potentiel interessant.',
            4 => 'Tres bon profil. Candidat montre forte motivation et competences claires.',
            5 => 'Profil excellent. Candidat tres motive avec expertise bien definie.',
        ];

        return $analyses[$score] ?? 'Analyse non disponible.';
    }
}
