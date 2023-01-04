<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'terakhir_dilihat'
    ];


    /**
     * The attributes that are guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }

    /**
     * Mengambil full url path image
     * @return string
     */
    public function getPathImage()
    {
        return $this->path_image ? load_file($this->path_image) : asset('skydash/images/faces/face28.jpg');
    }

    /**
     * Menampilkan status user, apakah sedang aktif atau tidak
     * @return string
     */
    public function getStatusActive()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return 'Aktif';
        }

        return 'Tidak Aktif';
    }

    /**
     * Mengambil warna berdasarkan role
     *
     * @param string $role
     * @return string
     */
    public function getRoleColor($role)
    {
        $color = '';
        switch ($role) {
            case 'admin':
                $color = 'green';
                break;
            case 'dit_gtk':
                $color = 'primary-purple';
                break;
            case 'lptk':
                $color = 'blue';
                break;
            case 'guru':
                $color = 'yellow';
                break;
                break;
        }

        return $color;
    }
}
