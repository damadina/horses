<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tutorial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // relacion uno a muchos inversa
    public function trabajo() {
        return $this->belongsTo(trabajo::class);
    }

    //relacion uno a muchos inversa
    public function platform(){
        return $this->belongsTo(platform::class);
    }
}
