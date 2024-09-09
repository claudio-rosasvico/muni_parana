<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emprendimiento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emprendimientos';

    protected $fillable = [
        'emprendedor_id',
        'nombre',
        'CUIT', 
        'domicilio',
        'afip',
        'ater',
        'afim',
        'habilitacion',
        'carnet_manipulacion',
        'rubro',
        'observacion'
    ];

    public function emprendedor(){
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    } 
    
    public function productos(){
        return $this->hasMany(Emprendimiento_producto::class, 'emprendimiento_id');
    } 


}
