<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'age_group',
        'duration',
        'price',
        'image',
        'icon',
        'is_featured',
        'is_active',
        'order',
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the reviews for the program.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Get the inquiries for the program.
     */
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    
    /**
     * Scope for active programs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope for featured programs.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
