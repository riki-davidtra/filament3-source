<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ConfigItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'config_group_id',
        'name',
        'key',
        'type',
        'value',
        'value_file',
    ];

    public $incrementing = true;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function configGroup()
    {
        return $this->belongsTo(ConfigGroup::class, 'config_group_id', 'uuid');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $fields = ['value_file'];
            foreach ($fields as $field) {
                $filePath = $model->$field;
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        });
    }
}
