@extends('layouts.app3')

@section('title')
Manage Applicants
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
              <h2 class="h2 text-info">Manage Applicants</h2>
               <div class="card card-default text-white">

                  <div class="tab-content text-muted p-3">
                      <div class="tab-pane active" id="admin-tabs-1" role="tabpanel">
                          <div class="row table-responsive freelancerTable">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Member Since</th>                                  
                                  <th></th>    
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($applicants as $freelancer)
                                <tr>
                                  <td> {{ $freelancer->name }} </td>
                                  <td> {{ $freelancer->email }} </td>
                                  <td> {{ $freelancer->created_at->format('M j, Y') }} </td>
                                  <td><h4>
                                    @if($freelancer->role == '1')
                                    <button class="btn btn-danger banUsers" data-id="{{$freelancer->id}}">BAN</button>
                                    @elseif($freelancer->role == '4')
                                     <button class="btn btn-default unbanFreelancer" data-id="{{$freelancer->id}}">UNBAN</button>
                                    @endif
                                  </h4></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                             <div class="ml-3"> {{$applicants->links()}}</div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
