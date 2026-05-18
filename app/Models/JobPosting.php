<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'Important_Link' => 'array',
        'overviews' => 'array',
        'Important_Dates' => 'array',
        'Vacancy_Details' => 'array',
        'FAQs' => 'array',
    ];

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class);
    }

    public function jobTypes()
    {
        return $this->belongsToMany(JobType::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
