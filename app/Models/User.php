<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Venturecraft\Revisionable\RevisionableTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, RevisionableTrait;

    protected $revisionCreationsEnabled   = true;
    protected $revisionEnabled            = true;
    protected $revisionForceDeleteEnabled = true;
    protected $revisionCleanup            = true; //Remove old revisions (works only when used with $historyLimit)
    protected $historyLimit               = 500; //Maintain a maximum of 500 changes at any point of time, while cleaning up old revisions

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    ];
}
