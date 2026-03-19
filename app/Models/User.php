<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * العلاقة: المستخدم لديه العديد من المهام
     * hasMany تعني "لديه العديد من"
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
        // أي: هذا المستخدم لديه مهام كثيرة، والمفتاح الخارجي في جدول tasks هو user_id
    }

    /**
     * العلاقة: المستخدم لديه العديد من التصنيفات
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
