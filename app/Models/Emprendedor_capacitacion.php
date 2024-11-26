<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emprendedor_capacitacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emprendedores_capacitaciones';

    protected $fillable = [
        'id',
        'emprendedor_id',
        'capacitacion_id',
    ];

    public function emprendedor(){
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }

    public function capacitacion(){
        return $this->belongsTo(Capacitacion::class, 'capacitacion_id');
    }

}
