<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Qualification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestJobs = JobPosting::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(9)
            ->get();
            
        $categories = Category::all();
        $qualifications = Qualification::all();
        $jobTypes = JobType::all();

        return view('welcome', compact('latestJobs', 'categories', 'qualifications', 'jobTypes'));
    }
    
    public function jobs(Request $request)
    {
        $query = JobPosting::where('status', 'published');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->whereHas('jobTypes', function ($q) use ($request) {
                $q->where('job_types.id', $request->type);
            });
        }

        if ($request->filled('qualification')) {
            $query->whereHas('qualifications', function ($q) use ($request) {
                $q->where('qualifications.id', $request->qualification);
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.name', $request->category);
            });
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(12);
        return view('jobs.index', compact('jobs'));
    }
    
    public function show($slug)
    {
        $job = JobPosting::where('slug', $slug)->firstOrFail();
        $job->increment('views_count');
        return view('jobs.show', compact('job'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);
        
        \App\Models\Subscriber::create([
            'email' => $request->email,
        ]);
        
        return back()->with('success', 'You have successfully subscribed to our updates!');
    }
}
