<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ConfigGroup extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'name',
        'order',
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

    public function configItems()
    {
        return $this->hasMany(ConfigItem::class, 'config_group_id', 'uuid');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->order) {
                $model->order = ConfigGroup::max('order') + 1;
            }
        });

        static::deleting(function ($model) {
            if ($model->configItems) {
                foreach ($model->configItems as $configItem) {
                    $filePath = $configItem->value_file;
                    if ($filePath && Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
        });
    }
}
