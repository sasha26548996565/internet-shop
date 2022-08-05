<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public function getRoles(): array
    {
        return [
            self::ROLE_ADMIN, self::ROLE_USER
        ];
    }

    public function likedProducts(): Relation
    {
        return $this->belongsToMany(Product::class, 'product_user_likes', 'user_id', 'product_id')->withTimestamps();
    }

    public function hasLike(int $productId): bool
    {
        return $this->likedProducts->contains($productId);
    }
}
