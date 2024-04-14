<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;


class Evaluate extends Model
{
    use HasFactory;
    protected $table = 'evaluates';
    protected $primaryKey = 'evaluateID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'evaluateID',
        'rating',
        'comment',
        'lastUpdate',
        'productID',
        'customerID'
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customerID', 'customerID');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
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
