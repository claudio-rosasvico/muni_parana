<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'observaciones'
    ];

    public function emprendimientos(){
        return $this->hasMany(Emprendimiento_producto::class, 'producto_id');
    }
}
