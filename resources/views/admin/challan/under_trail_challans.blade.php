@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>VIEW UNDER TRAIL CHALLAN | Investigation & Monitoring Cell</h3>
    </div>
</div>

<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Under Trail Challan</h5>
        </div>
        <div class="table-responsive">
            <table id="datatables-buttons" class="table table-striped ">
                <thead>
                    <tr>
                        <th style="width:auto;">#</th>
                        <th style="width:auto;">FIR</th>
                        <th style="width:auto;">Dated </th>
                        <th style="width:auto;">u/s</th>
                        <th style="width:auto;">PS</th>
                        <th style="width:auto;">I.O Contacted to Complainant</th>
                        <th style="width:auto;">Whether Challan Prepared Within 14 Days</th>
                        <th style="width:auto;">Nature Of Report u/s 173</th>
                        <th style="width:auto;">If Challan not prepared within 14 days,whether Interim report prepared wihtin next 3 days</th>
                        <th style="width:auto;">File Sent to Investigation & Monitoring Cell after 3 days of Reg. of FIR</th>
                        <th style="width:auto;">Whether Report u/s 173 Crpc is Received at Pre-Prosecution Cell</th>
                        <th style="width:auto;">When Challan/Interim Received By Prosecution Dept.</th>
                        <th style="width:auto;">Challan Status</th>
                        <th style="width:auto;">Date of Receiving of reports u/sec 173 crpc</th>
                        <th style="width:auto;">View</th>
                        <th style="width:auto;">Created At</th>
                        <th style="width:auto;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($challans as $key => $challan)
                    <tr>  
                        <td>{{$key+1}}</td>
                        <td>{{$challan->fir."/".$challan->dated->format('y')}}</td>
                        <td>{{$challan->dated->format('d M,Y')}}</td>
                        <td>{{$challan->under_section}}</td>
                        <td>{{$challan->police_station}}</td>
                        <td>
                            @if ($challan->i_o_contacted_to_complainant)
                                <span class="badge badge-success">Yes</span>  
                            @elseif($challan->threedaysFilter() == true && !$challan->i_o_contacted_to_complainant)
                                <span class="badge badge-danger">No</span>                                                      
                            @elseif($challan->threedaysFilter() == false && !$challan->i_o_contacted_to_complainant) 
                                <span class="badge badge-warning">Pending</span>                                                      
                            @endif
                        </td>
                        <td>
                            @if ($challan->challan_prepare_within_14_days)
                                <span class="badge badge-success">Yes</span>  
                            @elseif($challan->fourteendaysFilter() == true && !$challan->challan_prepare_within_14_days)
                                <span class="badge badge-danger">No</span>                                                      
                            @elseif($challan->fourteendaysFilter() == false && !$challan->challan_prepare_within_14_days) 
                                <span class="badge badge-warning">Pending</span>                                                      
                            @endif
                        </td>
                        <td>{{$challan->nature_of_challan}}</td>
                        <td>
                            @if ($challan->challan_interim_report_within_14_days)
                                <span class="badge badge-success">Yes</span>  
                            @else
                                <span class="badge badge-danger">No</span>                                                      
                            @endif
                        </td>
                        <td>
                            @if ($challan->file_send_after_3_days)
                                <span class="badge badge-success">Yes</span>  
                            @else
                                <span class="badge badge-danger">No</span>                                                      
                            @endif
                        </td>
                        <td>
                            @if ($challan->challan_receive_in_branch)
                                <span class="badge badge-success">Yes</span>  
                            @else
                                <span class="badge badge-danger">No</span>                                                      
                            @endif
                        </td>
                        <td>{{$challan->interim_sent_to_prosecution_department_date?@$challan->interim_sent_to_prosecution_department_date->format('d M,Y'):""}}</td>
                        <td>
                            @if($challan->challan_passed_date)
                                <span class="badge badge-success">Passed</span>  
                            @elseif($challan->objection_date && $challan->challan_passed_date == null)
                                <span class="badge badge-warning">Objection Phase</span>  
                            @else
                                <span class="badge badge-danger">Pending</span>  
                            @endif
                        </td>
                        <td>{{$challan->date_of_receiving_challan_in_court?@$challan->date_of_receiving_challan_in_court->format('d M,Y'):""}}</td>        
                        <td><a href="{{asset($challan->image)}}"><i class="feather text-info" data-feather="eye"></i></a></td>
                        <td>{{$challan->created_at->format('d M,Y')}}</td>
                        <td> <a href="{{route('admin.challan.show',$challan->id)}}" class="button"><button class="btn btn-primary"> Detail</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    $(function() {
        // Datatables with Buttons
        var datatablesButtons = $("#datatables-buttons").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: ["copy", "print"]
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection