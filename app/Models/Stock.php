<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'quantity',
    ];

    protected $visible = [
        'id',
        'name',
        'value',
        'quantity',
        'product_id',
    ];

    protected $appends = [
        'name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getNameAttribute()
    {
        return $this->product->name;
    }
}
