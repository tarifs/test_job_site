@extends('layouts.app3')

@section('title')
Manage Jobs
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
       @if(count($errors)>0)
        <div class="alert alert-danger w-50 mx-auto mt-3 text-center">
          <ul>
            @foreach($errors->all() as $error)
              <li style="list-style: none;">{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
             <div class="col-md-10  my-5">
              <h2 class="h2 text-info">Manage Jobs</h2>
               <div class="card card-default text-white">

                  <div class="tab-content text-muted p-3">
                      <div class="tab-pane active" id="admin-tabs-1" role="tabpanel">
                          <div class="row table-responsive jobTable">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Title</th>
                                  <th>Salary</th>
                                  <th>Member Since</th>                                  
                                  <th></th>    
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                  <td> <h5 class="h5">{{ $job->title }}</h5> </td>
                                  <td> {{ $job->salary }} </td>
                                  <td> {{ $job->created_at->format('M j, Y') }} </td>
                                  <td><i class="fas fa-trash h5 text-danger deleteJobPosting" data-id="{{$job->id}}"></i></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                             <div class="ml-3"> {{$jobs->links()}}</div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
