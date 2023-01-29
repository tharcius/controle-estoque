<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'value',
        'details',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function scopeInput($query)
    {
        return $query->whereType('input')->get();
    }

    public function scopeOutput($query)
    {
        return $query->whereType('output')->get();
    }

    /**
     * @return Attribute
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value / 100),
            set: fn($value) => ($value * 100)
        );
    }
}
