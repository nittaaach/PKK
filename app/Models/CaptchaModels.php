<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaptchaModels extends Model
{
    protected $table = 'captcha';                 // TABEL = captchas
    protected $fillable = ['id_users', 'number'];

    public function user()
    {
        // foreign key = id_users
        return $this->belongsTo(AuthModels::class, 'id_users');
    }
}
