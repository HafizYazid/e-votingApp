<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id_vote';
    public $timestamps = false; // karena kamu pakai 'voted_at' manual, bukan 'created_at'

    protected $fillable = [
        'id_user',
        'id_kandidat',
        'voted_at',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke Kandidat
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class, 'id_kandidat', 'id_kandidat');
    }
}
