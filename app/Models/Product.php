<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'productID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'productID',
        'productName',
        'productImage',
        'productPrice',
        'productQuantity',
        'productDescription',
        'productTypeID',
        'supplierID'
    ];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'supplierID');
    }

    public function ProductType()
    {
        return $this->belongsTo(ProductType::class, 'productTypeID', 'productTypeID');
    }

    public function Order()
    {
        return $this->belongsToMany(Order::class, 'detail__products')
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
