<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'provider_id', 'category_id'];

    /* Many to one */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /* Many to one */
    public function providers()
    {
        return $this->belongsTo(Provider::class);
    }

    /* Many to many */
    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
