<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'teacher_id',
        'program_id',
        'user_id',
        'parent_name',
        'child_name',
        'child_age',
        'rating',
        'content',
        'is_approved',
    ];
    
    protected $casts = [
        'is_approved' => 'boolean',
    ];
    
    /**
     * Get the teacher that owns the review.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    
    /**
     * Get the program that owns the review.
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    
    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope for approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
    
    /**
     * Get time ago format.
     */
    public function getTimeAgoAttribute()
    {
        $created = $this->created_at;
        $now = now();
        
        $diff = $now->diff($created);
        
        if ($diff->y > 0) {
            return $diff->y . '년 전';
        } elseif ($diff->m > 0) {
            return $diff->m . '개월 전';
        } elseif ($diff->d > 0) {
            return $diff->d . '일 전';
        } elseif ($diff->h > 0) {
            return $diff->h . '시간 전';
        } elseif ($diff->i > 0) {
            return $diff->i . '분 전';
        } else {
            return '방금 전';
        }
    }
}
