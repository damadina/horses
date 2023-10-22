<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class empleado extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function vacaciones() {
        return $this->hasMany(vacacione::class)->orderBy('fechaDesde');;
    }
    public function trabajos() {
        return $this->hasMany(trabajo::class)->orderBy('fecha');
    }

}