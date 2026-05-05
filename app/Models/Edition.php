<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Edition extends Model {
    protected $fillable = ['nom','date_selection','date_finale','lieu','active'];
    protected $casts = ['date_selection'=>'date','date_finale'=>'date','active'=>'boolean'];
    public static function active(): ?self { return self::where('active',true)->first(); }
}
