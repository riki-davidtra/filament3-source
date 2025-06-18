<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FornasEvent extends Model
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

    public function fornasRegistrations()
    {
        return $this->hasMany(FornasRegistration::class, 'fornas_event_id', 'uuid');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            if ($model) {
                if ($model->letter_file) {
                    Storage::disk('public')->delete($model->letter_file);
                }
            }
        });
    }
}
