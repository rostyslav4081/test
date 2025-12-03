<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Illuminate\Database\Eloquent\Builder filter(array $filters)
 * @property-read string $event_text
 */
class SysEvent extends Model
{
    protected $table = 'sys_event';
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'deviceId',
        'timestamp',
        'event',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'event' => 'integer',
        'deviceId' => 'integer',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(DataDevice::class, 'deviceId', 'id');
    }

    public function getEventTextAttribute(): string
    {
        return match ($this->event) {
            0   => "Připojeno",
            100 => "Odpojeno",
            200 => "Vypnutí",
            300 => "Jízda",
            310 => "Pomalé nabíjení",
            311 => "Rychlé nabíjení",
            320 => "Zbalancováno",
            default => "",
        };
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['device'])) {
            $device = $filters['device'];

            $query->where(function ($q) use ($device) {
                $q->where('deviceId', (int) $device)
                    ->orWhereHas('device', function ($d) use ($device) {
                        $d->where('name', 'ILIKE', "%{$device}%")
                            ->orWhere('locDesc', 'ILIKE', "%{$device}%");
                    });
            });
        }

        if (!empty($filters['event_code'])) {
            $query->where('event', (int) $filters['event_code']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('timestamp', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('timestamp', '<=', $filters['date_to']);
        }

        return $query;
    }
}
