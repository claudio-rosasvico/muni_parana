<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capacitacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'capacitaciones';

    protected $fillable = [
        'id',
        'nombre',
        'ubicacion',
        'docente',
        'fecha',
        'hora',
        'observaciones'
    ];

    public function emprendedores(){
        return $this->hasMany(Emprendedor_capacitacion::class, 'capacitacion_id');
    }
}
