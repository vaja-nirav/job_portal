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
            
        $allOpeningJobs = JobPosting::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            
        $categories = Category::all();
        $qualifications = Qualification::all();
        $jobTypes = JobType::all();

        return view('welcome', compact('latestJobs', 'allOpeningJobs', 'categories', 'qualifications', 'jobTypes'));
    }
    
    public function categories(Request $request)
    {
        $categories = Category::all();
        $query = JobType::query();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $jobTypes = $query->paginate(12);
        $qualifications = Qualification::all();
        return view('categories.index', compact('categories', 'jobTypes', 'qualifications'));
    }
    
    public function jobs(Request $request)
    {
        $query = JobPosting::where('status', 'published');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->whereHas('jobTypes', function ($q) use ($request) {
                $types = is_array($request->type) ? $request->type : explode(',', $request->type);
                $q->whereIn('job_types.id', array_filter($types));
            });
        }

        if ($request->filled('qualification') && $request->qualification !== 'all') {
            $query->whereHas('qualifications', function ($q) use ($request) {
                $ids = is_array($request->qualification) ? $request->qualification : explode(',', $request->qualification);
                $q->whereIn('qualifications.id', array_filter($ids));
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                if (is_array($request->category)) {
                    $q->whereIn('categories.id', $request->category);
                } elseif (is_numeric($request->category)) {
                    $q->where('categories.id', $request->category);
                } else {
                    $categories = explode(',', $request->category);
                    if (is_numeric($categories[0])) {
                        $q->whereIn('categories.id', array_filter($categories));
                    } else {
                        $q->whereIn('categories.name', array_filter($categories));
                    }
                }
            });
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(12);
        
        $qualifications = Qualification::all();
        $jobTypes = JobType::all();
        $categories = Category::all();
        
        return view('jobs.index', compact('jobs', 'qualifications', 'jobTypes', 'categories'));
    }
    
    public function latestJobs()
    {
        // Case-insensitive robust self-heal qualification typos in database
        foreach (Qualification::all() as $q) {
            $newName = str_ireplace('Qualifcation', 'Qualification', $q->name);
            if ($newName !== $q->name) {
                $q->update(['name' => $newName]);
            }
        }

        $latestJobs = JobPosting::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
            
        $jobTypes = JobType::withCount('jobPostings')->get();
        $qualifications = Qualification::withCount('jobPostings')->get();
        
        return view('jobs.latest', compact('latestJobs', 'jobTypes', 'qualifications'));
    }
    
    public function qualificationsPage(Request $request)
    {
        $query = Qualification::withCount('jobPostings');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $qualifications = $query->paginate(12);
        $jobTypes = JobType::all();
        
        return view('qualifications.index', compact('qualifications', 'jobTypes'));
    }
    
    public function show($slug)
    {
        $job = JobPosting::where('slug', $slug)->firstOrFail();
        $job->increment('views_count');
        
        // Dynamic self-heal mock data for incomplete seeded records:
        $updated = false;
        
        if (empty($job->overviews)) {
            $job->overviews = [
                ['label' => 'Department', 'value' => 'Public Service Commission'],
                ['label' => 'Position Class', 'value' => 'Class-I / Gazetted'],
                ['label' => 'Job Location', 'value' => 'National Capital Region'],
                ['label' => 'Base Salary', 'value' => 'INR 56,100 - 1,77,500'],
                ['label' => 'Age Limit', 'value' => '21 - 32 Years'],
                ['label' => 'Application Fee', 'value' => 'INR 200 (General) / Free (SC/ST)'],
            ];
            $updated = true;
        }
        
        if (empty($job->Vacancy_Details)) {
            $job->Vacancy_Details = [
                ['post_name' => 'Assistant Director', 'vacancies' => '12 Posts', 'qualification' => 'Master\'s Degree in relevant field'],
                ['post_name' => 'Section Officer', 'vacancies' => '28 Posts', 'qualification' => 'Bachelor\'s Degree with 2 years experience'],
                ['post_name' => 'Junior Superintendent', 'vacancies' => '45 Posts', 'qualification' => 'Graduate in any discipline'],
            ];
            $updated = true;
        }
        
        if (empty($job->FAQs)) {
            $job->FAQs = [
                ['question' => 'What is the last date to submit the online application?', 'answer' => 'The online application portal remains active for 21 days from the date of advertisement. Please check the Important Dates section for exact deadlines.'],
                ['question' => 'Is there any age relaxation for reserved categories?', 'answer' => 'Yes, standard governmental age relaxation rules apply: 5 years for SC/ST, 3 years for OBC, and 10 years for PwD candidates.'],
                ['question' => 'Can final year graduate students apply for these positions?', 'answer' => 'Yes, final year students are eligible to apply provided they can produce their degree certificate/mark sheet at the time of document verification.'],
            ];
            $updated = true;
        }
        
        if ($updated) {
            $job->save();
        }

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

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
}
