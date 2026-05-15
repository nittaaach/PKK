<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthModels extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password', // e.g., admin, user
    ];

    protected $hidden = [
        'password', // Hide password from array and JSON representations
    ];

     public function captcha()
    {
        // relasi ke tabel captcha
        return $this->hasOne(CaptchaModels::class, 'id_users');
    }
}
