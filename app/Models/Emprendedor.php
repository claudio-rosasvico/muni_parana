<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emprendedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emprendedores';


    protected $fillable = [
        'id',
        'nro_expediente',
        'anio_expediente',
        'apellido',
        'nombre',
        'DNI',
        'fecha_nac',
        'domicilio',
        'telefono',
        'email',
        'venc_carnet',
        'activo',
        'CUD',
        'observaciones',
        'user_id'
    ];

    public function emprendimiento(){
        return $this->hasMany(Emprendimiento::class, 'emprendedor_id');
    }
}
