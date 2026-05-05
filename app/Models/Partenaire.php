<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Partenaire extends Model {
    protected $fillable = ['responsable','entreprise','telephone','type','pack','type_apport','niveau_sponsor','message'];
}
