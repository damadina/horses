<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class platform extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tutoriales() {
        return $this->hasMany(tutorial::class);
    }

}
