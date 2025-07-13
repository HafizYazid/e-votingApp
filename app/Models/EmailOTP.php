<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmailOTP extends Model
{
    protected $table = 'email_otps';
    public $timestamps = true;
    
    // Fix: gunakan expired_at untuk konsistensi dengan controller
    protected $fillable = ['id_user', 'email', 'otp', 'expired_at'];
    
    protected $casts = [
        'expired_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}