<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;


class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customerID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'customerID',
        'firstName',
        'lastName',
        'userID'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function Order()
    {
        return $this->hasMany(Order::class);
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function Evaluate()
    {
        return $this->hasMany(Evaluate::class);
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
