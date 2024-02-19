<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

class ApiToken extends Model
{
    use HasFactory;

    protected $table = 'api_tokens';

    protected $fillable = [
        'user_id',
        'service',
        'access_token'
    ];

    /**
     * Interacts with the user's access token for that service
     * The tokens are stored encrypted in case there's a leakage
     *
     */
    protected function accessToken(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Crypt::decrypt($value),
            set: fn(string $value) => Crypt::encrypt($value),
        );
    }

    /**
     * Returns the user that the api key belongs to
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
