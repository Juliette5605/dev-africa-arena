<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Newsletter extends Model {
    protected $fillable = ['email','nom','confirmed','token','confirmed_at'];
    protected $casts = ['confirmed'=>'boolean','confirmed_at'=>'datetime'];
}
