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

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeInput($query)
    {
        return $query->whereType('input');
    }

    public function scopeOutput($query)
    {
        return $query->where('type', 'output');
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
