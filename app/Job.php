<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    function user() {
    	return $this->belongsTo('App\User');
   }

//    function applicants() {
//     return $this->belongsToMany('App\Apply', 'apply_job', 'job_id', 'apply_user_id');
// }
}
