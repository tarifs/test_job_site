<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Apply;
use Illuminate\Support\Facades\DB;
class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        if(Auth()->user()->role !==2){
            return redirect('/')->with('error','Unauthorize Page');
        }
        $user_id = Auth()->user()->id;
        $user    = User::find($user_id);
        $jobs    = Job::where('user_id',$user->id)->orderBy('created_at','DESC')->paginate(5);
        return view('company.dashboard')->with('jobs',$jobs);
    }

    public function shortlist($id) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $job        = Job::findOrFail($id);
        $applicants = DB::table('applies')
            ->join('profiles', 'applies.user_id', '=', 'profiles.user_id')
            ->join('jobs', 'applies.job_id', '=', 'jobs.id')
            ->join('users', 'applies.user_id', '=', 'users.id')
            ->where(function ($query) use ($id) {
                        $query->where('applies.job_id', $id);
                 })  
            ->orderBy('applies.created_at', 'desc')
            ->get();
        return view('company.shortlist', compact('job', 'applicants'));
    }

    public function apply($id, $user_id) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
         $job       = Job::findOrFail($id);
         $applicant = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('applies', 'users.id', '=', 'applies.user_id')
            ->when($id, function ($query) use ($id) {
                    return $query->where('applies.job_id', $id);
                })
            ->when($user_id, function ($query) use ($user_id) {
                    return $query->where('applies.user_id', $user_id);
                })
            ->first();
            
        return view('company.proposal', compact('job', 'applicant'));
    }   

    public function approved($id, $user) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $applicant = DB::table('applies')
            ->when($id, function ($query) use ($id) {
                    return $query->where('job_id', $id);
                })
            ->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user);
                })
            ->update(['status' => 'approved']);   
        return redirect('jobs');
    }  

    public function reject($id, $user) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
         $applicant = DB::table('applies')
            ->when($id, function ($query) use ($id) {
                    return $query->where('job_id', $id);
                })
            ->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user);
                })
            ->update(['status' => 'rejected']);

        return redirect('jobs');
    }
    
}
