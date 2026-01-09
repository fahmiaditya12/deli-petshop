<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Helper methods
    public function isLowStock($threshold = 10)
    {
        return $this->stock <= $threshold;
    }

    public function updateStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function getImageUrl()
    {
        if (!$this->image) {
            return null;
        }
        
        // Check if file exists
        if (\Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }
}