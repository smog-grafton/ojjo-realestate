<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
        'is_encrypted',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_encrypted' => 'boolean',
    ];

    /**
     * Get the value attribute with proper type casting and decryption
     */
    public function getValueAttribute($value)
    {
        if ($this->is_encrypted && $value) {
            try {
                $value = Crypt::decrypt($value);
            } catch (\Exception $e) {
                // If decryption fails, return original value
                return $value;
            }
        }

        return match ($this->type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $value,
            'float' => (float) $value,
            'json' => json_decode($value, true),
            default => $value,
        };
    }

    /**
     * Set the value attribute with proper encryption if needed
     */
    public function setValueAttribute($value)
    {
        if ($this->type === 'json') {
            $value = json_encode($value);
        }

        if ($this->is_encrypted && $value) {
            $value = Crypt::encrypt($value);
        }

        $this->attributes['value'] = $value;
    }

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key
     */
    public static function set(string $key, $value, string $group = 'general', string $type = 'string', bool $isEncrypted = false): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'is_encrypted' => $isEncrypted,
            ]
        );
    }

    /**
     * Get all settings for a specific group
     */
    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Get mail configuration settings
     */
    public static function getMailConfig(): array
    {
        return static::getGroup('mail');
    }

    /**
     * Scope to filter by group
     */
    public function scopeByGroup($query, string $group)
    {
        return $query->where('group', $group);
    }
}
