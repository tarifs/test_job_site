@extends('layouts.app3')

@section('title')
Manage Companies
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
              <h2 class="h2 text-info">Manage Companies</h2>
               <div class="card card-default text-white">

                  <div class="tab-content text-muted p-3">
                      <div class="tab-pane active" id="admin-tabs-1" role="tabpanel">
                          <div class="row table-responsive clientTable">
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
                                @foreach($companies as $client)
                                <tr>
                                  <td> {{ $client->name }} </td>
                                  <td> {{ $client->email }} </td>
                                  <td> {{ $client->created_at->format('M j, Y') }} </td>
                                  <td><h4>
                                    @if($client->role == '2')
                                    <button class="btn btn-danger banUsers" data-id="{{$client->id}}">BAN</button>
                                    @elseif($client->role == '4')
                                     <button class="btn btn-default unbanClient" data-id="{{$client->id}}">UNBAN</button>
                                    @endif
                                  </h4></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                             <div class="ml-3"> {{$companies->links()}}</div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
