@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 my-5">
            @include('partials.alert')
            <div class="card card-default">
            	<div class="row">
	                <div class="card-body col-lg-12">
	                    @if(count($jobs) > 0)
		                    @foreach ($jobs as $job)
		                    <div class="card mb-3">
		                        <h5 class="h5 card-header"><a href="jobs/{{$job->id}}" class="text-info">{{$job->title}}</a></h5>
		                        <div class="card-block px-3">		                         
			                        <p class="small">
			                        	<span>Salary: &#36;{{$job->salary}}</span>
			                        	<span> - </span>
			                        	<span>Posted: {{$job->created_at->diffForHumans()}}</span>
			                        </p>
			                        <p class="small">
			                        	<span><span class="text-success"><i class="fas fa-location-arrow"></i> Location:</span> {{ ucwords($job->location) }}</span>
			                        	<br>
			                        	<span><span class="text-success"><i class="fas fa-flag"></i> Country:</span> {{ ucwords($job->country) }}</span>
			                        </p>
		                  	  </div>
		                    </div>	    
		                    @endforeach
		                    {{--  {{ $jobs->links() }}  --}}
		                @else 
		                	<h2 class="h2 text-muted text-center">NO RESULT FOUND</h2>
		                @endif
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
