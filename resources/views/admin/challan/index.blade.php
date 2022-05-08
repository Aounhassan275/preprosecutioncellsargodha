@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>VIEW CHALLANS | Investigation & Monitoring Cell</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">VIEW ALL CHALLANS</h5>
                <button id="show_challan_filters" class="btn btn-primary btn-sm pull-right">Show Challan Filters</button>
                <button id="show_date_filters" style="display:none;" class="btn btn-primary btn-sm pull-right">Show Date Filters</button>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.challan.index') }}" method="get">
                    <div class="row">
                        <div class="form-group col-3 challan_filters" style="display:none;">
                            <label class="form-label">FIR#</label>
                            <input type="number" name="fir" value="{{@$data['fir']}}"  placeholder="E.g.123"  class="form-control" min="1" minlength="1" max="1500" maxlength="4" >                        
                        </div>
                        <div class="form-group col-3 challan_filters" style="display:none;">
                            <label class="form-label">Year</label>  
                            <select name="dated" class="form-control select2" >
                                <option selected disabled>Select</option>
                                @foreach($years as $year)
                                <option @if(@$data['dated'] && @$data['dated'] == $year) selected @endif value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3 challan_filters" style="display:none;">
                            <label class="form-label">Under Section</label>
                            <input type="text" name="under_section" value="{{@$data['under_section']}}" class="form-control" placeholder="E.g.302 PPC" >                        
                        </div>
                        <div class="form-group col-4 date_filters" >
                            <label class="form-label">From</label>
                            <input type="date" name="from" id="from" required class="form-control" placeholder="E.g.302 PPC" >                        
                        </div>
                        <div class="form-group col-4 date_filters" >
                            <label class="form-label">To</label>
                            <input type="date" name="to" id="to" required class="form-control" placeholder="E.g.302 PPC" >                        
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Police Station</label>
                            <select name="police_station" required class="form-control select2" >
                                <option selected disabled>Select</option>
                                @foreach(App\Models\PoliceStation::all() as $police_station)
                                    <option @if(@$data['police_station'] && @$data['police_station'] == $police_station->name) selected @endif value="{{$police_station->name}}">{{$police_station->name}}</option>
                                @endforeach
                            </select>                       
                         </div>  
                    </div>
                    <div class="row float-right" >
                        <button type="submit" class="btn btn-primary">Search Challan
                            <i class="icon-search4 ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Challan User Table</h5>
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
<script>
    $(document).ready(function(){
        $('#show_date_filters').on('click', function() {
            $('#show_date_filters').hide();
            $('#show_challan_filters').show();
            $('.challan_filters').hide();
            $('.date_filters').show();
            $('#to').attr('required',true);
            $('#from').attr('required',true);
        });  
        $('#show_challan_filters').on('click', function() {
            $('#show_challan_filters').hide();
            $('#show_date_filters').show();
            $('.date_filters').hide();
            $('.challan_filters').show();
            $('#to').attr('required',false);
            $('#from').attr('required',false);

        });  
    });
</script>
@endsection