<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CipherSweetEncrypted
{
    use HasApiTokens, HasFactory, Notifiable, UsesCipherSweet;

    const ROL_ADMIN = 'admin';
    const ROL_SOCIA = 'socia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'dni',
        'num_socia',
        'rol',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addField('nome')
            ->addBlindIndex('nome', new BlindIndex('nome_index'))
            ->addField('email')
            ->addBlindIndex('email', new BlindIndex('email_index'))
            ->addField('dni')
            ->addBlindIndex('dni', new BlindIndex('dni_index'));
    }

    public static function findByEmail(string $email)
    {
        return User::whereBlind('email', 'email_index', $email)
            ->first();
    }
}
