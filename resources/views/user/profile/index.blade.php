@extends('user.layout.index')

@section('title')
UPDATE YOUR OWN PROFILE
@endsection
@section('contents')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{route('user.user.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                   <div class="row">
                    <input type="hidden" name="id" class="form-control" value="{{Auth::user()->id}}">
                        <div class="form-group col-6">
                            <label class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" >
                        </div>
                   </div>
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" >

                        </div>
                   </div>
                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection