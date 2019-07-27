<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Profile;
use App\Skill;
use Image;
use DB;
class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        $jobs = Job::all();
        return view('applicant.userdashboard', compact('jobs'));

    }

    public function storeProfile(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 

        $profile            = new Profile;
        $profile->job_title = $request->title;
        $profile->city      = $request->city;
        $profile->province  = $request->province;
        $profile->country   = $request->country;
        $profile->user_id   = Auth()->user()->id;
        $profile->overview  = $request->overview;        
        $profile->save();

    }

    public function updateProfile(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $id                 = $request->id;
        $profile            = Profile::where('user_id', $id)-> first();
        $profile->job_title = $request->title;
        $profile->city      = $request->city;
        $profile->province  = $request->province;
        $profile->country   = $request->country;
        $profile->overview  = $request->overview;        
        $profile->save();

    }

    public function uploadPhoto(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $id               = Auth()->user()->id;
        $user             = User::find($id);
        $profile          = Profile::where('user_id', $id)-> first();
        if($request->hasFile('profilepicture')) {
            $image        = $request->file('profilepicture');
            $filename     = time().'.'.$image->GetClientOriginalExtension();
            $location     = 'profileImages/';
            $url          = $location.$filename;
            $image->move($location,$filename);
            $profile->photo = $url;
            
        }
        $profile->save();
        return redirect()->back();

    }

    public function updatePhoto(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $id           = Auth()->user()->id;
        $profile      = Profile::where('user_id', $id)-> first();
        if($request->hasFile('profilepicture')) {
            $image    = $request->file('profilepicture');
            $filename = time().'.'.$image->GetClientOriginalExtension();
            $location = 'profileImages/';
            $url      = $location.$filename;
            $image->move($location,$filename);
            $profile->photo = $url;
        }
         
        return redirect()->back();
        return redirect('userdashboard');

    }

    public function profile(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $user_id  = Auth()->user()->id;
        $user     = User::find($user_id);
        $skills   = Skill::orderBy('skill', 'asc')->get();     
        $profile  = Profile::where('user_id', $user->id)->first();
        // $resume = Resume::where('user_id', $user->id)
        //             ->orderBy('created_at', 'desc')
        //             ->get(); 
        return view('applicant.profile', compact('user', 'profile', 'skills'));

    }

    public function myJobs(Request $request)
    {
        if(Auth()->user()->role !== 1) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $id   = Auth()->user()->id;
        $user = User::find($id);
        $jobs = DB::table('applies')
                       ->join('jobs', 'applies.job_id', '=', 'jobs.id')
                       ->when($id, function ($query) use ($id) {
                    return $query->where('applies.user_id', $id);
                })
                       ->orderBy('applies.created_at', 'desc')
                       ->get();
        return view('applicant.my_jobs')->withUser($user)->withJobs($jobs);

    }


}
