<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model {
    protected $fillable = ['key','value','group'];

    // Lire un paramètre (avec cache 60 min)
    public static function get(string $key, $default = null) {
        return Cache::remember('setting_'.$key, 3600, function() use ($key, $default) {
            $s = static::where('key', $key)->first();
            return $s ? $s->value : $default;
        });
    }

    // Écrire un paramètre (vide le cache)
    public static function set(string $key, $value): void {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('setting_'.$key);
    }

    // Écrire plusieurs paramètres d'un coup
    public static function setMany(array $data): void {
        foreach ($data as $key => $value) static::set($key, $value);
    }
}
