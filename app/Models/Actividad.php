<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'actividades';

    protected $fillable = [
        'id',
        'nombre',
        'ubicacion',
        'fecha_desde',
        'fecha_hasta',
        'observaciones'
    ];

    public function emprendedores(){
        return $this->hasMany(Emprendedor_actividad::class, 'actividad_id');
    }
}
