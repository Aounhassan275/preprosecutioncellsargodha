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
                <h5 class="card-title mb-0">Challan Details</h5>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title mb-0">I/o Name: {{$challan->i_o_name}}</h5>
                @if($challan->prosecutor_name)
                    <h5 class="card-title mb-0">Prosecutor Name:{{@$challan->prosecutor_name}}</h5>
                @endif
                <div class="text-muted mb-2">
                </div>
                <div>
                    <a class="btn btn-success btn-sm" href="#">{{$challan->nature_of_challan}}</a>
                    <a class="btn btn-danger btn-sm" href="#">
                        @if($challan->challan_passed_date)
                        Passed
                        @elseif($challan->objection_date && $challan->challan_passed_date == null)
                                Objection Phase
                        @else
                            Pending
                        @endif
                    </a>
                </div>
            </div>
            <hr class="my-0">
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Challan</h5>
            </div>
            <div class="list-group list-group-flush" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                Update Challan Information
                </a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                    Basic Information
                </a>   
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#court" role="tab">
                    Prosecution Branch and Court Working
                </a>   
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xl-9">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="account" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Challan Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables-buttons" class="table table-striped">
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
                                            @if($challan->file_send_after_3_days)
                                                <a href="{{route('admin.file_send_after_3_days.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                            @else
                                                <a href="{{route('admin.file_send_after_3_days.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>
                                            @endif
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
                                            @if($challan->challan_receive_in_branch)
                                            <a href="{{route('admin.challan_receive_in_branch.pending',$challan->id)}}" class="btn btn-danger form-control">Make Pending</a>
                                        @else
                                            <a href="{{route('admin.challan_receive_in_branch.active',$challan->id)}}" class="btn btn-success form-control">Make Complete</a>
                                        @endif
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            </div>

                    </div>
                </div>

            </div>  
            <div class="tab-pane fade" id="password" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">View Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-2">
                                <label class="form-label">FIR#</label>
                                <input type="number" name="fir" placeholder="E.g.123" readonly value="{{$challan->fir}}" class="form-control" min="1" minlength="1" max="1500" maxlength="4" required>                        
                            </div>
                            <div class="form-group col-2">
                                <label class="form-label">Dated#</label>
                                <input type="text" name="dated" readonly class="daterange-single form-control pull-right" style="height: 35px; "
                                value="{{ date('m/d/Y', strtotime(@$challan->dated))}}">
                            </div>
                            <div class="form-group col-2">
                                <label class="form-label">Under Section</label>
                                <input type="text" name="under_section" readonly value="{{$challan->under_section}}" class="form-control" placeholder="E.g.302 PPC" required>                        
                            </div>
                            <div class="form-group col-3">
                                <label class="form-label">Police Station</label>
                                <input type="text" readonly name="police_station" class="form-control" value="{{$challan->police_station}}" readonly>
                            </div>   
                            <div class="form-group col-3">
                                <label class="form-label">I/O Name</label>
                                <input type="text" readonly name="i_o_name" value="{{@$challan->i_o_name}}" placeholder="E.g.Afzal ASI" class="form-control" required>                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label class="form-label">Road No#</label>
                                <input type="text" name="road_no" value="{{@$challan->road_no}}" class="form-control" readonly >                        
                           </div>
                           <div class="form-group col-3">
                                <label class="form-label">Nature of Report u/s 173</label>
                                <input type="text" name="road_no" value="{{@$challan->nature_of_challan}}" readonly class="form-control" > 
                            </div>
                            <div class="form-group col-3">
                                <label class="form-label">Prosecutor Name</label>
                                <input type="text" name="road_no" value="{{@$challan->prosecutor_name}}" readonly class="form-control" > 
                            </div>
                           <div class="form-group col-3">
                                <label class="form-label">Challan Image </label>
                                <br>
                                <a href="{{asset($challan->image)}}" class="btn btn-info" style="color:white;"><i class="feather text-info" style="color:white;" data-feather="eye"></i>View </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>   
            <div class="tab-pane fade" id="court" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">View Other Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables-buttons" class="table table-striped">
                                <thead>
                                    <tr >
                                        <th>Field Name</th>
                                        <th>Field Detail</th>

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
                                    </tr>
                                    <tr>
                                        <td>Date when Challan Passed By Prosecution Branch</td>
                                        <td>
                                            @if($challan->challan_passed_date)
                                            {{$challan->challan_passed_date->format('M d,Y')}}
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date when Objection Raised on Challan By Prosecution Branch</td>
                                        <td>
                                            @if($challan->objection_date)
                                            {{$challan->objection_date->format('M d,Y')}}
                                            @endif
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
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>Date of receiving of Challan in Court</td>
                                        <td>
                                            @if($challan->date_of_receiving_challan_in_court)
                                            {{$challan->date_of_receiving_challan_in_court->format('M d,Y')}}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>

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



