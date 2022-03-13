@extends('user.layout.index')
@section('title')
Create New Challan
@endsection
@section('styles')
<script src="{{asset('user_asset/global_assets/js/demo_pages/picker_date.js')}}"></script>
@endsection
@section('contents')

<div class="row" >
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline bg-dark">
                <h5 class="card-title">Add New Challan</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
 
            <div class="card-body">
                <form  action="{{route('user.challan.store')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-label">FIR#</label>
                            <select data-placeholder="Enter 'as'" name="fir_id"  class="form-control select-minimum " required data-fouc>
                                <option></option>
                                <optgroup label="FIRS">
                                    @foreach(Auth::user()->firs as $fir)
                                    <option  value="{{$fir->id}}">{{$fir->fir."/".$fir->dated->format('y')}}</option>
                                    @endforeach
                                </optgroup>
                            </select>                        
                        </div> 
                        {{-- <div class="form-group col-3">
                            <label class="form-label">I/O Name</label>
                            <input type="text" name="i_o_name" placeholder="E.g.Afzal ASI" class="form-control" required>                        
                        </div>   --}}
                        <div class="form-group col-4">
                            <label class="form-label">Accused Name</label>
                            <input type="text" name="accused_name" placeholder="Accused Name" class="form-control" required>                        
                        </div> 
                        <div class="form-group col-4">
                            <label class="form-label">Challan Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-label">I/O Contacted to Complainant</label>
                            <select name="i_o_contacted_to_complainant" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <br>
                        </div>
                        <div class="form-group col-4">
                            <label class="form-label">Whether Challan Prepared within 14 Days</label>
                            <select name="challan_prepare_within_14_days" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label class="form-label">Nature of Report u/s 173</label>
                            <select name="nature_of_challan" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="Complete Challan">Complete Challan</option>
                                <option value="Incomplete Challan">Incomplete Challan</option>
                                <option value="Interim Report">Interim Report</option>
                                <option value="Untrace Report">Untrace Report</option>
                                <option value="Cancellation Report">Cancellation Report</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="form-group col-6">
                            <label class="form-label">If Challan Not Prepared within 14 Days,whether Interim report within next 3 days</label>
                            <select name="challan_interim_report_within_14_days" class="form-control">
                                <option selected disabled>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>  
                        <div class="form-group col-4">
                            <label class="form-label">Road No#</label>
                            <input type="text" name="road_no" class="form-control" placeholder="Road Number">                        
                       </div>
                    </div>
                    <div class="row float-right" >
                        <button type="submit" class="btn btn-primary">Create Challan Now 
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