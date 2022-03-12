@extends('user.layout.index')
@section('title')
Create New FIR
@endsection
@section('styles')
@endsection
@section('contents')

<div class="row" >
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline bg-dark">
                <h5 class="card-title">Add New FIR</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
 
            <div class="card-body">
                <form  action="{{route('user.fir.store')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-label">FIR#</label>
                            <input type="number" name="fir" placeholder="E.g.123" class="form-control" min="1" minlength="1" max="1500" maxlength="4" required>                        
                        </div>
                        <div class="form-group col-4">
                            <label class="form-label">Dated#</label>
                            <input type="date" name="dated" class="form-control pull-right">                        
                        </div>
                        <div class="form-group col-4">
                            <label class="form-label">Under Section</label>
                            <input type="text" name="under_section" class="form-control" placeholder="E.g.302 PPC" required>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label class="form-label">Offence</label>
                            <select data-placeholder="Enter 'as'" name="offence"  class="form-control select-minimum " required data-fouc>
                                <option></option>
                                <optgroup label="Offence">
                                    @foreach(App\Models\Offence::all() as $offence)
                                    <option  value="{{$offence->name}}">{{$offence->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div> 
                        <div class="form-group col-3">
                            <label class="form-label">Police Station</label>
                            <input type="text" name="police_station" class="form-control" value="{{Auth::user()->posting}}" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control"  required>
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">I/O name</label>
                            <input type="text" name="i_o_name" class="form-control"placeholder="E.g.Afzal ASI" required>
                        </div>
                    </div>
                    <div class="row float-right" >
                        <button type="submit" class="btn btn-primary">Create FIR Now 
                            <i class="icon-plus22 ml-2"></i>
                        </button>
                    </div>
               
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>
@endsection
@section('scripts')
<script>
      $(function() {
        $('.dates').datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            dateFormat: 'm/d/Y',
            autoclose: true,
        });
    });
</script>
@endsection