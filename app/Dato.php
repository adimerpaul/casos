<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    protected $fillable=[
        'nombre',
'parentesco',
'celular',
'fecha',
'fiebre',
'tos',
'fatiga',
'congestion',
'muscular',
'garganta',
'cafe',
'nauseas',
'diarrea',
'escalofrios',
'respiratoria',
'otros',
'a',
'b',
'c',
'enfermedad',
'embarazo',
'inmunodepresion',
'dano',
'insuficiencia',
'otros2',
'caso',
'casono',
'observaciones',
'caso_id'
    ];
}
