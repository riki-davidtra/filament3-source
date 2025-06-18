<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FornasParticipant extends Model
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

    public function fornasRegistration()
    {
        return $this->belongsTo(FornasRegistration::class, 'fornas_registration_id', 'uuid');
    }

    public function fornasParticipantFile()
    {
        return $this->hasOne(FornasParticipantFile::class, 'fornas_participant_id', 'uuid');
    }

    public function inorga()
    {
        return $this->belongsTo(Inorga::class, 'inorga_id', 'uuid');
    }
}
