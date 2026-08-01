<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'status', 'token', 'source', 'confirmed_at', 'synced_at'];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'synced_at' => 'datetime',
        'confirmation_sent_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Subscriber $s) {
            $s->token ??= Str::random(48);
        });
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isUnsubscribed(): bool
    {
        return $this->status === 'unsubscribed';
    }

    public function markConfirmed(): void
    {
        $this->forceFill(['status' => 'confirmed', 'confirmed_at' => now()])->save();
    }

    public function markUnsubscribed(): void
    {
        $this->forceFill(['status' => 'unsubscribed'])->save();
    }
}
