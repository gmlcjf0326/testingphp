<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'child_age',
        'program_id',
        'message',
        'status',
        'admin_note',
    ];
    
    /**
     * Get the program that owns the inquiry.
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    
    /**
     * Scope for pending inquiries.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    /**
     * Get status label.
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => '대기중',
            'contacted' => '연락완료',
            'completed' => '상담완료',
            default => '알 수 없음',
        };
    }
    
    /**
     * Get status color.
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'contacted' => 'info',
            'completed' => 'success',
            default => 'secondary',
        };
    }
}
