<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['sale_code', 'user_id', 'customer_id'];
    protected $primaryKey = 'sale_code';
    public $incrementing = false;
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
}
