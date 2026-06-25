<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Course;

class CourseDocument extends Model
{
    /** @use HasFactory<\Database\Factories\CourseDocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'path',
        'course_id'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
