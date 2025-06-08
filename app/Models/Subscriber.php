<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'name',
        'token',
        'subscribed_at',
        'unsubscribed_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Scope to get only subscribed users (subscribed and not unsubscribed)
     */
    public function scopeSubscribed($query)
    {
        return $query->whereNotNull('subscribed_at')
                    ->whereNull('unsubscribed_at');
    }

    /**
     * Scope to get unsubscribed users
     */
    public function scopeUnsubscribed($query)
    {
        return $query->whereNotNull('unsubscribed_at');
    }

    /**
     * Check if subscriber is currently subscribed
     */
    public function isSubscribed(): bool
    {
        return !is_null($this->subscribed_at) && is_null($this->unsubscribed_at);
    }

    /**
     * Subscribe the user
     */
    public function subscribe(): void
    {
        $this->update([
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
            'token' => $this->token ?: Str::random(32),
        ]);
    }

    /**
     * Unsubscribe the user
     */
    public function unsubscribe(): void
    {
        $this->update([
            'unsubscribed_at' => now(),
        ]);
    }

    /**
     * Generate a unique token for the subscriber
     */
    public static function generateUniqueToken(): string
    {
        do {
            $token = Str::random(32);
        } while (self::where('token', $token)->exists());

        return $token;
    }

    /**
     * Boot method to generate token on creation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->token)) {
                $subscriber->token = self::generateUniqueToken();
            }
        });
    }
}
