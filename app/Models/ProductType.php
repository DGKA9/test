<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;


class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_types';
    protected $primaryKey = 'productTypeID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'productTypeID',
        'productTypeName',
        'pt_Description'
    ];

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
