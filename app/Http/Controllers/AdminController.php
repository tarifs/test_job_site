<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use App\Skill;
class AdminController extends Controller
{
    public function showApplicants() {
    	$applicants = User::where(function ($query) {
                        $query->where('role', '1')
                              ->orWhere('role', '4');
               			 })
		    	              ->orderBy('created_at', 'desc')
		    	              ->paginate(5);
    	return view('admin.applicants', compact('applicants'));
    }

    public function banApplicants(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->role = '4';
    	$user->save();
    }

    public function unbanApplicants(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->role = '1';
    	$user->save();
    }

    public function showCompanies() {
    	$companies = User::where(function ($query) {
                        $query->where('role', '2')
                              ->orWhere('role', '4');
               			 })
		    	              ->orderBy('created_at', 'desc')
		    	              ->paginate(5);
    	return view('admin.companies', compact('companies'));
    }
		
	 public function unbanCompanies(Request $request) {
    	$id = $request->id;
    	$user = User::find($id);
    	$user->role = '2';
    	$user->save();
    }		
    public function showJobs() {
    	$jobs = Job::orderBy('created_at', 'desc')
		    	->paginate(5);
    	return view('admin.jobs', compact('jobs'));
    }

    public function deleteJob($id)
    {
       $job = Job::findOrFail($id);    
       $job->delete();
    }
}
