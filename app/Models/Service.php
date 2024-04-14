<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'serviceID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'serviceID',
        'serviceName'.
        'description',
        'price',
        'serviceTime'
    ];

    public function Booking()
    {
        return $this->belongsToMany(Booking::class, 'booking_service')
            ->using(BookingService::class);
    }

    public static function currentDate(): Carbon
    {
        return Carbon::now();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            $model->created_at = static::currentDate();
            $model->updated_at = static::currentDate();
        });

        static::updating(function ($model) {
            $model->updated_at = static::currentDate();
        });
    }
}
