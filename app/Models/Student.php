<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    /** @use HasFactory<StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dob',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date',
        ];
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }
}
