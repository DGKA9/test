<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'orderID',
        'orderDate',
        'deliveryDate',
        'orderStatus',
        'totalInvoice',
        'customerID',
        'paymentID'
    ];

    public function Cutomer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }

    public  function Payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID', 'paymentID');
    }

    public function Product()
    {
        return $this->belongsToMany(Product::class, 'detail__products')
            ->using(Detail_Product::class);
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
