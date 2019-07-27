<?php

namespace App\Http\Controllers;
use Auth;
use App\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
       $user_id = Auth()->user()->id;
       $user    = User::find($user_id);
       $jobs    = Job::where('user_id', $user->id)
                  ->orderBy('created_at', 'desc')
                  ->paginate(5); 
       return view('company.jobs', compact('jobs', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobpost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required',
            'body'     => 'required',
            'salary'   => 'required',
            'location' => 'required',
            'country'  => 'required'
        ]);
        $job            = new Job;
        $job->title     = $request->input('title');
        $job->body      = $request->input('body');
        $job->salary    = $request->input('salary');
        $job->location  = $request->input('location');
        $job->country   = $request->input('country'); 
        $job->user_id   = auth()->user()->id;   
        $job->save();

        return redirect('/dashboard')->with('success', "<i class='fas fa-check fa-fw'></i> Job Posting Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id  = Auth()->user()->id;
        $job      = Job::find($id); 
        $jobcount = Job::where('user_id', $job->user_id)->count();
        $exist    = DB::table('applies')
                       ->join('jobs', 'applies.job_id', '=', 'jobs.id')
                       ->when($id, function ($query) use ($id) {
                    return $query->where('applies.job_id', $id);
                })
                       ->when($user_id, function ($query) use ($user_id) {
                    return $query->where('applies.user_id', $user_id);
                })
                       ->first();  
        if ($exist == null) {
            $result = 'not exist';          
        } else {
             $result = 'exist';
        }     

        return view('jobpost.show', compact('job', 'jobcount', 'result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);

        //check for correct user
        if(Auth()->user()->id !== $job->user_id) {
            return redirect('/')->with('error', 'Unauthorize Page');
        }

        $job->delete();
    }
}
