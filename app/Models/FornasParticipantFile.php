<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FornasParticipantFile extends Model
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

    public function fornasParticipan()
    {
        return $this->belongsTo(FornasParticipant::class, 'fornas_participant_id', 'uuid');
    }
}
