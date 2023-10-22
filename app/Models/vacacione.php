<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacacione extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = "mysql";
    public function empleado() {
        return $this->belongsTo(empleado::class);
    }
}
