<?php

namespace App\Http\Controllers;
use App\Job;
use App\Apply;
use App\User;
use App\Skill;
use App\Profile;
use DB;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $job = Job::find($id);
        return view('jobpost.application')->withJob($job);

    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'application_letter' => 'required'
        ]);

    	$applicant                     = new Apply;
    	$applicant->application_letter = $request->input('application_letter');
        $applicant->job_id             = $request->input('job');
    	$applicant->status             = 'pending';
    	$applicant->user_id            = auth()->user()->id;   
    	$applicant->save();

    	$applicant->jobs()->attach($id);

    	return redirect("my-jobs")->with('success', "<i class='fas fa-check fa-fw'></i> Successfully Applied");;
    }

    public function view($id)  
    {
        $user    = User::find($id);        
        $skills  = Skill::orderBy('skill', 'asc')->get();     
        $profile = Profile::where('user_id', $id)->first();          
        return view('applicant.applicant', compact('user', 'profile', 'skills'));
    }


}
