@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>USER DETAIL | PRE-PROSECUTION BRANCH</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xl-3">
        
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">User Details</h5>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title mb-0">{{$user->name}}</h5>
                <div class="text-muted mb-2">
                </div>
                @if ($user->status == 'block')
                <div>
                    <a class="btn btn-success btn-sm" href="{{route('admin.user.activation',$user->id)}}">Active</a>
                    @if(Auth::user()->type == 1)
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.delete',$user->id)}}">Delete</a>
                    @endif
                </div>
                @else
                <div>
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.block',$user->id)}}">Block</a>
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.delete',$user->id)}}">Delete</a>
                </div>
                <div>
                    <br>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.login.fake',$user->id) }}">Login</a>
                </div>
                @endif
            </div>
            <hr class="my-0">
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Settings</h5>
            </div>
            <div class="list-group list-group-flush" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                Update Profile
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xl-9">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="account" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Private info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.user.update')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <label for="inputFirstName">User name</label>
                                    <input type="text" class="form-control" name="name" id="inputFirstName" value="{{$user->name}}" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control">
                                        <option selected disabled >Select</option>   
                                        <option value="Police Station" @if($user->type == 'Police Station') selected @endif>Police Station</option>
                                        <option value="Prosecution Branch" @if($user->type == 'Prosecution Branch') selected @endif>Prosecution Branch</option>
                                        <option value="Court" @if($user->type == 'Court') selected @endif>Court</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" name="email"  value="{{$user->email}}" >
                                </div>   
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Password</label>
                                    <input type="password" class="form-control" name="password" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Posting</label>
                                    <select name="posting" class="form-control select2" required>
                                        <option selected disabled>Select</option>
                                        @foreach(App\Models\PoliceStation::all() as $police_station)
                                            <option @if($user->posting == $police_station->name) selected @endif value="{{$police_station->name}}">{{$police_station->name}}</option>
                                        @endforeach
                                    </select>
                                </div>   
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Phone#</label>
                                    <input type="text" class="form-control" name="phone"  value="{{$user->phone}}" maxlength="12" minlength="12" >
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit"  class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>  
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        // Select2
        $(".select2").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
        })
    });
</script>
@endsection



