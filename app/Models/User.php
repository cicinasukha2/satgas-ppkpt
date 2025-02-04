<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $table = 'user'; // Ensure this matches your actual table name
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'email',
        'nipn_nim',
        'password',
        'kontak',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Validate user login
    public static function validateUser($nipn_nim, $password)
    {
        return self::where('nipn_nim', $nipn_nim)
                   ->where('password', md5($password)) // Compare MD5 hash
                   ->first();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }
}
