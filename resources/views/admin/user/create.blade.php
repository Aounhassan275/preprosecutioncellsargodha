@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>CREATE USER | PRE-PROSECUTION BRANCH</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">CREATE USER</h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control" placeholder="User Name" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">User Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="User Email Address" required>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">User Password</label>
                            <input type="password" name="password" class="form-control" placeholder="User Password" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">User Type</label>
                            <select name="type" id="type" class="form-control">
                                <option selected disabled >Select</option>
                                <option value="Police Station">Police Station</option>
                                <option value="Prosecution Branch">Prosecution Branch</option>
                                <option value="Court">Court</option>
                            </select>
                        </div>
                       
                    </div> 
                    <div class="row">
                        <div class="form-group col-6" id="police_station_div" style="display:none;">
                            <label class="form-label">User Posting</label>
                            <select name="posting" class="form-control select2" required>
                                <option selected disabled>Select</option>
                                @foreach(App\Models\PoliceStation::all() as $police_station)
                                    <option value="{{$police_station->name}}">{{$police_station->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">User Phone#</label>
                            <input type="number" name="phone" class="form-control" minlength="12" maxlength="12" placeholder="923XXXXXXXXX" value="923" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
    $('#type').change( function (e) {
        if ($(this).val() == 'Police Station') {
            $('#police_station_div').show();
        }
        else {            
            $('#police_station_div').hide();
        }
    });
</script>
@endsection