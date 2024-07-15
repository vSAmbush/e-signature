<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property int $created_at
 * @property int $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = strtolower($username);

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = bcrypt($password);

        return $this;
    }

    public function validatePassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
