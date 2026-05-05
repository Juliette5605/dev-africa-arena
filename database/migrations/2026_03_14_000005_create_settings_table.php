<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Valeurs par défaut
        $defaults = [
            ['key'=>'site_name',         'value'=>'DevAfricaArena',                           'group'=>'general'],
            ['key'=>'site_slogan',        'value'=>'Propulser l\'Afrique par le numérique',    'group'=>'general'],
            ['key'=>'site_email',         'value'=>'wilsoncodemosaic@gmail.com',               'group'=>'general'],
            ['key'=>'site_phone',         'value'=>'+228 71 15 50 55',                         'group'=>'general'],
            ['key'=>'site_address',       'value'=>'Lomé, Togo',                               'group'=>'general'],
            ['key'=>'cash_prize',         'value'=>'350 000',                                  'group'=>'competition'],
            ['key'=>'max_candidats',      'value'=>'100',                                      'group'=>'competition'],
            ['key'=>'nb_finalistes',      'value'=>'6',                                        'group'=>'competition'],
            ['key'=>'nb_jours',           'value'=>'2',                                        'group'=>'competition'],
            ['key'=>'facebook',           'value'=>'',                                         'group'=>'social'],
            ['key'=>'linkedin',           'value'=>'',                                         'group'=>'social'],
            ['key'=>'instagram',          'value'=>'',                                         'group'=>'social'],
            ['key'=>'twitter',            'value'=>'',                                         'group'=>'social'],
            ['key'=>'maintenance_mode',   'value'=>'0',                                        'group'=>'system'],
            ['key'=>'maintenance_msg',    'value'=>'Site en maintenance. Revenez bientôt !',   'group'=>'system'],
            ['key'=>'newsletter_subject', 'value'=>'Actualités DevAfricaArena',                'group'=>'newsletter'],
        ];

        foreach ($defaults as $s) {
            DB::table('settings')->insert(array_merge($s, ['created_at'=>now(),'updated_at'=>now()]));
        }
    }
    public function down(): void { Schema::dropIfExists('settings'); }
};
