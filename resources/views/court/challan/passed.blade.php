@extends('prosecution.layout.index')
@section('title')
CHALLAN 
@endsection
@section('styles')
<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js')}}"></script>
<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js')}}"></script>
<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
<script src="{{asset('user_asset/global_assets/js/demo_pages/datatables_extension_buttons_html5.js')}}"></script>
<script src="{{asset('user_asset/global_assets/js/demo_pages/picker_date.js')}}"></script>
@endsection
@section('contents')
<!-- Column selectors -->
<div class="row" >
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Search Passed Challan</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('user.challan.passed_challan') }}" method="get">
                    <div class="row">
                        <div class="form-group col-3">
                            <label class="form-label">FIR#</label>
                            <input type="number" name="fir" value="{{@$data['fir']}}"  placeholder="E.g.123"  class="form-control" min="1" minlength="1" max="1500" maxlength="4" >                        
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Year</label>  
                            <select data-placeholder="Enter 'as'" name="dated"  class="form-control select-minimum "  data-fouc>
                                <option></option>
                                <optgroup label="Years">
                                    @foreach($years as $year)
                                    <option @if(@$data['dated'] && @$data['dated'] == $year) selected @endif value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Under Section</label>
                            <input type="text" name="under_section" value="{{@$data['under_section']}}" class="form-control" placeholder="E.g.302 PPC" >                        
                        </div>
                        <div class="form-group col-3">
                            <label class="form-label">Police Station</label>
                            <input type="text" name="police_station" class="form-control" value="{{Auth::user()->posting}}">
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
        <!-- /basic layout -->

    </div>
</div>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">View Passed Challans</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
   

    <table class="table datatable-button-html5-basic">
        <thead>
            <tr>
                <th>#</th>
                <th>FIR</th>
                <th>Dated</th>
                <th>u/s</th>
                <th>PS</th>
                <th>I.O Contacted to Complainant</th>
                <th>If Challan not prepared within 14 days,whether Interim report prepared wihtin next 3 days</th>
                <th>Nature Of Report u/s 173</th>
                <th>Whether Challan Prepared Within 14 Days</th>
                <th>File Sent to Investigation & Monitoring Cell after 3 days of Reg. of FIR</th>
                <th>Whether Report u/s 173 Crpc is Received at Pre-Prosecution Cell</th>
                <th>When Challan/Interim Received By Prosecution Branch</th>
                <th>Challan Status</th>
                <th>Date of Receiving of reports u/sec 173 crpc</th>
                <th>View</th>
                <th>Action</th>
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
                    @else
                        <span class="badge badge-danger">No</span>                                                      
                    @endif
                </td>
                <td>
                    @if ($challan->challan_prepare_within_14_days)
                        <span class="badge badge-success">Yes</span>  
                    @else
                        <span class="badge badge-danger">No</span>                                                      
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
                <td><a href="{{asset($challan->image)}}"><i class="icon-eye"></i></a></td>
                <td class="text-center">
                    <a href="{{route('user.challan.edit',$challan->id)}}"><i class="icon-pencil7"></i></a>
                
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /column selectors -->

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