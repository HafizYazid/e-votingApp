<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidate';
    protected $primaryKey = 'id_kandidat';
    public $timestamps = false;

    protected $fillable = ['ketua', 'wakil', 'visi', 'misi', 'suara', 'foto'];
}