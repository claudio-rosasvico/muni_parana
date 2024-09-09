<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emprendimiento_producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emprendimiento_productos';

    protected $fillable = [
        'emprendimiento_id',
        'producto_id'
    ];

    public function emprendimiento(){
        return $this->belongsTo(Emprendimiento::class, 'emprendimiento_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
