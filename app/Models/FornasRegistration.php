<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FornasRegistration extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public $incrementing = true;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fornasEvent()
    {
        return $this->belongsTo(FornasEvent::class, 'fornas_event_id', 'uuid');
    }

    public function fornasParticipants()
    {
        return $this->hasMany(FornasParticipant::class, 'fornas_registration_id', 'uuid');
    }

    public function kormi()
    {
        return $this->belongsTo(Kormi::class, 'kormi_id', 'uuid');
    }

    protected static function booted()
    {
        static::creating(function ($fornasRegistration) {
            if (Auth::check() && empty($fornasRegistration->user_id)) {
                $fornasRegistration->user_id = Auth::id();
            }
        });
    }
}
