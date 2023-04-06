<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenAgenda extends Model
{
    use HasFactory;
    protected $table = 'absen_agendas';
    protected $guarded = ['id'];
}
