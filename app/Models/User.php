<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
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

    /**
     * Get the user's preferred locale.
     */
    public function preferredLocale(): string
    {
        $language = $this->language->language;

        if($language == 'pt-br'){
            return 'pt_BR';
        } else {
            return $language;
        }
    }

    public function apiTokens(): HasMany
    {
        return $this->hasMany(ApiToken::class);
    }

    public function lamps(): HasMany
    {
        return $this->hasMany(Lamp::class);
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class);
    }

    public function notification(): HasOne
    {
        return $this->hasOne(Notification::class);
    }

    /**
     * The precincts that the user subscribe to.
     */
    public function precincts(): BelongsToMany
    {
        return $this->belongsToMany(Precinct::class);
    }
}
