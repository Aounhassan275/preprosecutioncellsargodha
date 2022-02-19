@extends('prosecution.layout.index')
@section('title')
Edit Challan
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
                <h5 class="card-title">Edit New Challan</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
 
            <div class="card-body">
                <form   enctype="multipart/form-data">
                    <h4><b> Basic Information:</b></h4>
                    <br>
                    <input type="hidden" value="{{@$challan->id}}" id="challan_id">
                    <div class="row">
                        <div class="form-group col-2">
                            <label class="form-label">FIR#</label>
                            <input type="number" name="fir" placeholder="E.g.123" value="{{$challan->fir}}" class="form-control" min="1" minlength="1" max="1500" maxlength="4" readonly>                        
                        </div>
                        <div class="form-group col-2">
                            <label class="form-label">Dated#</label>
                            <input type="text" name="dated" class="daterange-single form-control pull-right" style="height: 35px; "
                            value="{{ date('m/d/Y', strtotime(@$challan->dated))}}" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label class="form-label">Under Section</label>
                            <input type="text" name="under_section" value="{{$challan->under_section}}" class="form-control" placeholder="E.g.302 PPC" readonly>                        
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Police Station</label>
                            <input type="text" name="police_station" class="form-control" value="{{$challan->police_station}}" readonly>
                        </div>   
                        <div class="form-group col-3">
                            <label class="form-label">I/O Name</label>
                            <input type="text" name="i_o_name" value="{{@$challan->i_o_name}}" placeholder="E.g.Afzal ASI" class="form-control" readonly>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="form-label">Road No#</label>
                            <input type="text" name="road_no" value="{{@$challan->road_no}}" class="form-control" placeholder="Raid Number" readonly>                        
                       </div>
                       
                       <div class="form-group col-4">
                            <label class="form-label">Nature of Report u/s 173</label>
                            <input type="text" value="{{@$challan->nature_of_challan}}" class="form-control" placeholder="Raid Number" readonly>                        

                        </div>
                        <div class="form-group col-4">
                            <label class="form-label">Challan Image </label>
                            <br>
                            <a href="{{asset($challan->image)}}" class="btn btn-info"><i class="icon-eye"></i>View Image</a>
                        </div>
                    </div>
                </form>
                <h4><b> Challan Status :</b></h4>
                <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-warning">
                                    <th>Name</th>
                                    <th>
                                        Status
                                    </th>
                                    <th class="text-center">
                                        Action
                                    </th>
                                </tr>
                                <tr class="border-bottom-danger">
                                    <th>I/O Contacted to Complainant</th>
                                    <th>
                                        @if($challan->i_o_contacted_to_complainant)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </th>
                                    <th>
                                        {{-- @if($challan->i_o_contacted_to_complainant)
                                            <a href="{{route('user.i_o_contacted_to_complainant.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                        @else  
                                            <a href="{{route('user.i_o_contacted_to_complainant.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>

                                        @endif --}}
                                    </th>
                                </tr>
                                <tr class="border-bottom-primary">
                                    <th>Whether Challan Prepared within 14 Days</th>
                                    <th>
                                        @if($challan->challan_prepare_within_14_days)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </th>
                                    <th>
                                        {{-- @if($challan->challan_prepare_within_14_days)
                                            <a href="{{route('user.challan_prepare_within_14_days.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                        @else 
                                            <a href="{{route('user.challan_prepare_within_14_days.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>
                                        @endif --}}
                                    </th>
                                </tr>
                                <tr class="border-bottom-success">
                                    <th>If Challan Not Prepared within 14 Days,whether Interim report prepared within next 3 days</th>
                                    <th>
                                        @if($challan->challan_interim_report_within_14_days)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </th>
                                    <th>
                                        {{-- @if($challan->challan_interim_report_within_14_days)
                                            <a href="{{route('user.challan_interim_report_within_14_days.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                        @else
                                            <a href="{{route('user.challan_interim_report_within_14_days.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>
                                        @endif --}}
                                    </th>
                                </tr>
                                <tr class="border-bottom-info">
                                    <th>File Sent to Pre-Prosecution Branch After 3 days of Reg. of FIR</th>
                                    <th>
                                        @if($challan->file_send_after_3_days)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                                <tr class="border-bottom-info">
                                    <th>Whether Report u/sec 173 crpc is received at Pre-Prosecution Cell</th>
                                    <th>
                                        @if($challan->challan_receive_in_branch)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <br>
                <h4><b> Other Informations :</b></h4>
                <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-dark bg-teal">
                            <thead>
                                <tr class="bg-teal-700">
                                    <th>Field Name</th>
                                    <th>Field Detail</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>When Challan / Interim Sent to Prosecution Department</td>
                                    <td>
                                        @if($challan->interim_sent_to_prosecution_department_date)
                                        {{$challan->interim_sent_to_prosecution_department_date->format('M d,Y')}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#challan_sent_to_prosecution_date_modal" class="btn btn-warning form-control" data-toggle="modal" data-target="#challan_sent_to_prosecution_date_modal">
                                            Update
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date when Challan Passed By Prosecution Branch</td>
                                    <td>
                                        @if($challan->challan_passed_date)
                                        {{$challan->challan_passed_date->format('M d,Y')}}
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a href="#challan_passed_date_modal" class="btn btn-warning form-control" data-toggle="modal" data-target="#challan_passed_date_modal">
                                            Update
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date when Objection Raised on Challan By Prosecution Branch</td>
                                    <td>
                                        @if($challan->objection_date)
                                        {{$challan->objection_date->format('M d,Y')}}
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="#challan_sent_to_prosecution_date_modal" class="btn btn-warning" data-toggle="modal" data-target="#challan_sent_to_prosecution_date_modal">
                                            Update
                                        </a> --}}
                                    </td>
                                </tr>
                                @if($challan->objection_date)
                                <tr>
                                    <td>Challan Resubmitted in Prosecution Branch after Removal of Defects</td>
                                    <td>
                                        @if($challan->challan_resubmitted_after_defect_removals)
                                            <span class="badge badge-success">Yes</span>  
                                        @else 
                                            <span class="badge badge-danger">No</span>  
                                        @endif
                                    </td>
                                    <td>
                                        @if($challan->challan_resubmitted_after_defect_removals)
                                            <a href="{{route('user.challan_resubmitted_after_defect_removals.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                        @else
                                            <a href="{{route('user.challan_resubmitted_after_defect_removals.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Date of receiving of Challan in Court</td>
                                    <td>
                                        @if($challan->date_of_receiving_challan_in_court)
                                        {{$challan->date_of_receiving_challan_in_court->format('M d,Y')}}
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="#challan_sent_to_prosecution_date_modal" class="btn btn-warning" data-toggle="modal" data-target="#challan_sent_to_prosecution_date_modal">
                                            Update
                                        </a> --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>
@include('prosecution.challan.partials.modals')
@include('prosecution.challan.partials.challan_passed_date_modals')
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
    $('#objection').change( function (e) {
        if ($(this).is(':checked')) {
            $('#challan_passed').hide();
            $('#objection_raised').show();
        }
        else {        
            $('#challan_passed').show();
            $('#objection_raised').hide();    
        }
    });
    $(document).on('submit', '#challanSentToProsecutionDateModalForm', function (event) {
        $('#errors').html("Please Wait!!");
        $('.btn').attr("disabled",true);
        $.ajax({
            url: '{{url("user/challan/challan_sent_to_prosecution_date")}}/'+$('#challan_id').val(),
            type: 'POST',
            data: $('#challanSentToProsecutionDateModalForm').serialize(),
        })
        .done(function (response) {
            $('.btn').attr("disabled",false);
            if(response.status == true)
            {
                setTimeout(function() {
                    $('#errors').html(response.message);
                    $('#challan_sent_to_prosecution_date_modal').modal("hide");
                }, 3000);
                location.reload();
            }else{
                $('#errors').html(response.message);
            }
        })
        .fail(function (response) {
        })
        .always(function () {
            console.log("complete");
        });
    });
    $(document).on('submit', '#challanPassedDateModalForm', function (event) {
        $('#errors').html("Please Wait!!");
        $('.btn').attr("disabled",true);
        $.ajax({
            url: '{{url("user/challan/challan_passed_date")}}/'+$('#challan_id').val(),
            type: 'POST',
            data: $('#challanPassedDateModalForm').serialize(),
        })
        .done(function (response) {
            $('.btn').attr("disabled",false);
            if(response.status == true)
            {
                setTimeout(function() {
                    $('#errors').html(response.message);
                    $('#challan_passed_date_modal').modal("hide");
                }, 3000);
                location.reload();
            }else{
                $('#errors').html(response.message);
            }
        })
        .fail(function (response) {
        })
        .always(function () {
            console.log("complete");
        });
    });
</script>
@endsection