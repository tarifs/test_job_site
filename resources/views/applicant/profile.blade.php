@extends('layouts.app')


@section('title')
    Profile - {{$user->name}}
@endsection

@section('select2css')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            @include('partials.alert')
            <div class="row mb-3">
                <div class="col-md-2 text-center">
                    @if(!empty($profile->photo))
                      <img class="p-0 profilepicture rounded-circle" src="{{ asset($profile->photo) }}"   data-toggle="modal" data-target="#uploadphoto{{$user->id}}">   
                    @else 
                       <i class="fas fa-user-circle fa-10x text-muted"  data-toggle="modal" data-target="#uploadphoto{{$user->id}}"></i>
                    @endif   



                    {{-- Upload Photo --}}
                <div class="modal fade" id="uploadphoto{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <form action="{{ url('/profile/uploadphoto') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header">
                          <h5 class="modal-title text-info" id="exampleModalLabel">Upload Photo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body editworksbody">
                          <div class="form-group">
                            <input type="file" class="form-control-file text-center" id="profilepicture" name="profilepicture" aria-describedby="fileHelp">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                </div>
                <div class="col-md-10 pl-5">
                    <h3 class="h3 text-info d-inline-block">{{$user->name}}</h3>     
                     @if ($profile !== null)
                     <button class="btn btn-default float-right" data-toggle="modal" data-target="#editprofile{{$user->id}}"><i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span></button>
                    @else
                      <button class="btn btn-default float-right" data-toggle="modal" data-target="#addprofile{{$user->id}}"><i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span></button>
                    @endif 
                    <h5 class="h5">
                       @if ($profile !== null)
                         {{$profile->job_title}}
                       @endif 

                    </h5>
                    <small class="h6 text-muted"><i class="fas fa-map-marker-alt"></i>  
                      @if ($profile !== null)
                         {{$profile->city}}, {{$profile->province}} {{$profile->country}}
                       @endif</small>
                </div>
            </div>

            {{-- Edit Profile --}}
            @if ($profile !== null)
            <div class="modal fade" id="editprofile{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            @else
              <div class="modal fade" id="addprofile{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            @endif 
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-info" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body editworksbody">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-briefcase"></i>&nbsp;Title</span>
                      </div>
                      <input type="text" id="editJobTitle" class="form-control" name="edit_job_title" value="{{$profile !== null ? $profile->job_title : ''}}">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt" va></i>&nbsp;City</span>
                      </div>
                      <input type="text" id="editCity" class="form-control"  name="edit_city" value="{{$profile !== null ? $profile->city : ''}}">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i>&nbsp;Province</span>
                      </div>
                      <input type="text" id="editProvince" class="form-control"  name="edit_province" value="{{$profile !== null ? $profile->province : ''}}">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i>&nbsp;Country</span>
                      </div>
                      <input type="text" id="editCountry" class="form-control"  name="country" value="{{$profile !== null ? $profile->country : ''}}">
                    </div>
                    <div class="form-group">
                      <span class="input-group-text"><i class="fas fa-briefcase"></i>&nbsp;Overview</span>
                      <textarea class="form-control" id="editOverview"  name="edit_overview" rows="3">{{$profile !== null ? $profile->overview : ''}}</textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     @if ($profile !== null)
                     <button type="submit" class="btn btn-primary editProfileButton" data-dismiss="modal" data-id="{{$user->id}}">Save changes</button>
                    @else
                     <button type="submit" class="btn btn-primary addProfileButton" data-dismiss="modal">Save changes</button>
                    @endif 
                  </div>
                </div>
              </div>
        </div>


            <div class="row mb-3">
                <div class="col-12">
                  <h4 class="h5 text-info">Overview</h4>
                  <p>{!! $profile !== null ? nl2br(e($profile->overview)) : '' !!}</p>
                </div>
            </div>      
                <div class="card mb-0">
                    <div class="card-header">
                        <a class="card-title">
                           <h5 class="d-inline-block h5 text-success font-weight-bold mb-0">Skills</h5>
                           <button class="btn btn-default float-right py-0 px-1" data-toggle="modal" data-target="#editskills{{$user->id}}">
                                <i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span>
                            </button> 
                           <button class="btn btn-primary float-right  py-0 mr-1 px-1" data-toggle="modal" data-target="#addskills{{$user->id}}">
                                <i class="far fa-edit text-white"></i> <span class="text-white h6">Add New</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                      @foreach($user->skills as $skill)
                       <button type="button" class="btn btn-sm btn-info mt-1">{{$skill->skill}}</button>
                      @endforeach

                    </div>

                    <!-- Edit Skills Modal -->
                    <div class="modal fade" id="editskills{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <form action="{{ url('/profile/skills/edit') }}" method="post">
                        {{ csrf_field() }}
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Skills</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body editskillsbody">
                                 <select class="form-control selectedskills" multiple="multiple" placeholder="Select State" name="skills[]">
                                      <option></option>
                                      @foreach($skills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                     </form>
                    </div>

                    <!-- Add Skills Modal -->
                    <div class="modal fade" id="addskills{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <form action="{{ url('/profile/skills/store') }}" method="post">
                        {{ csrf_field() }}
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">                                
                                <h5 class="modal-title" id="exampleModalLabel">Add New Skill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body addskillsbody">
                                     <div class="form-group col-xs-12">
                                      
                                        <select class="form-control select2" multiple="multiple" placeholder="Select State" name="skills[]">
                                          <option></option>
                                          @foreach($skills as $skill)
                                            <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                          @endforeach
                                      </select>
                                     </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                     </form>
                    </div>



                    <div class="card-header">
                        <a class="card-title">
                          <h5 class="d-inline-block h5 text-success font-weight-bold mb-0">Resume</h5>
                          <button class="btn btn-default float-right py-0 px-1" data-toggle="modal" data-target="#editwork{{$user->id}}">
                            <i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span>
                        </button> 
                           <button class="btn btn-primary float-right  py-0 mr-1 px-1" data-toggle="modal" data-target="#addwork{{$user->id}}">
                                <i class="far fa-edit text-white"></i> <span class="text-white h6">Add New</span>
                           </button>
                        </a>
                    </div>
                </div>                

                    <!-- Add Resume Modal -->
                    <div class="modal fade" id="addwork{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{ url('/profile/uploadresume') }}" method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                              <div class="modal-header">
                                <h5 class="modal-title text-info" id="exampleModalLabel">Upload Resume</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body editworksbody">
                                <div class="input-group mb-3">
                                  <input type="file" id="addPosition" class="form-control">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary addNewWorkButton" data-dismiss="modal">Save changes</button>
                              </div>
                                </form>
                            </div>
                          </div>
                    </div>
        </div>
    </div>
</div>
@endsection
@section('jsplugins')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2({
          width: 'resolve', 
          placeholder: "Please select Skills",
          allowClear: true
        });
        $('.selectedskills').select2().val({!! json_encode($user->skills()->allRelatedIds()) !!}).trigger('change');
    });
    </script>
@endsection