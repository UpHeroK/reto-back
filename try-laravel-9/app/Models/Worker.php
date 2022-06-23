<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = "workers";
    protected $fillable = [
        'nombre',
        'documento',
        'direccion',
        'telefono',
        'edad',
        'hobby',
        'pay_id',
    ];


    public function pay(){
        return $this->belongsTo(Pay::class );
    }

}
