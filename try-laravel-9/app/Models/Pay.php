<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $table = "pays";
    protected $fillable = [
        'sueldo',
        'duracion',
        'contract_id'

    ];

    public function worker(){
        return $this->hasOne(Worker::class );
    }
    public function contract(){
        return $this->belongsTo(Contract::class );
    }
}
