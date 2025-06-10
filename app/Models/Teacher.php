<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'bio',
        'specialties',
        'education',
        'experience',
        'location',
        'rating',
        'review_count',
        'lesson_count',
        'is_active',
    ];

    /**
     * 스케줄 관계
     */
    public function schedules()
    {
        return $this->hasMany(TeacherSchedule::class);
    }

    /**
     * 예약 관계
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    protected $casts = [
        'specialties' => 'array',
        'education' => 'array',
        'experience' => 'array',
        'rating' => 'decimal:2',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the reviews for the teacher.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Get the approved reviews for the teacher.
     */
    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }
    
    /**
     * Scope for active teachers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Update teacher's rating based on reviews.
     */
    public function updateRating()
    {
        $avgRating = $this->approvedReviews()->avg('rating') ?? 0;
        $reviewCount = $this->approvedReviews()->count();
        
        $this->update([
            'rating' => round($avgRating, 2),
            'review_count' => $reviewCount,
        ]);
    }
}
