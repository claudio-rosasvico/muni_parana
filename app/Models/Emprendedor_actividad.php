<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emprendedor_actividad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emprendedores_actividades';

    protected $fillable = [
        'id',
        'emprendedor_id',
        'actividad_id',
    ];

    public function emprendedor(){
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }
}
