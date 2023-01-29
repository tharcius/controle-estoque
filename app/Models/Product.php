<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $visible = [
        'id',
        'name',
        'value',
    ];

    public function historics()
    {
        return $this->hasMany(Historic::class);
    }

    public function historic()
    {
        return $this->hasMany(Historic::class)->orderBy('created_at', 'desc')->limit(1);
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
