@extends('layouts.app')


@section('title')
    Dashboard - Company
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 my-5">            
            @include('partials.alert')
            <div class="card card-default">  
                <div class="card-header"><h3 class="h3 text-center text-info">Create a Job Post</h3></div>
                <div class="card-body">
                  <form method="POST" action="/jobs">
                  	{{ csrf_field() }}
                  	 <div class="form-group">
					    <label for="title">Title of Job Posting</label>
					    <input type="text" class="form-control" id="title" name="title" placeholder="Example: Web Developer with Ecommerce Experience">
					  </div>
					  <div class="form-group">
					    <label for="article-ckeditor">Job Description</label>
					    <textarea class="form-control" id="article-ckeditor" rows="3" name="body"></textarea>
					  </div>
					  <div class="row">
						  <div class="form-group col-md-6">
						    <label for="budget">Salary</label>
						    <input type="text" class="form-control" id="salary" name="salary">
						  </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="budget">Location</label>
                          <input type="text" class="form-control" id="location" name="location">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label for="budget">Country</label>
                          <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
					  </div>
					  <button type="submit" class="btn btn-info">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsplugins') 
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>
@endsection