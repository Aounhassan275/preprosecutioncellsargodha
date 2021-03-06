@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>VIEW POLICE STATION USER | Investigation & Monitoring Cell</h3>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Viewer User Table</h5>
        </div>
        <div class="table-responsive">
            <table id="datatables-buttons" class="table table-striped ">
                <thead>
                    <tr>
                        <th style="width:auto;">#</th>
                        {{-- <th style="width:auto;">Name</th> --}}
                        {{-- <th style="width:auto;">Email </th> --}}
                        <th style="width:auto;">Posting</th>
                        {{-- <th style="width:auto;">Type</th> --}}
                        <th style="width:auto;">Total Challan</th>
                        <th style="width:auto;">Total Completed</th>
                        <th style="width:auto;">Pendency I/o Not Contacted To Complainant</th>
                        {{-- <th style="width:auto;">Pendency Interim Report Not Prepared within 3 Days</th> --}}
                        <th style="width:auto;">Pendency Challan Not Prepared within 14 Days</th>
                        {{-- <th style="width:auto;">Status</th> --}}
                        <th style="width:auto;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $challans = 0;
                    $challan_prepare_within_14_days = 0;
                    $i_o_contacted_to_complainant = 0;
                    $total_completed = 0;
                    @endphp
                    @foreach (App\Models\User::police_station() as $key => $user)
                    <tr> 
                        <td>{{$key+1}}</td>
                        {{-- <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td> --}}
                        <td>{{$user->posting}}</td>
                        {{-- <td>{{$user->type}}</td> --}}
                        <td>
                            {{$user->challans()->count()}}
                        </td>
                        <td>
                            {{$user->challans()->where('challan_prepare_within_14_days',1)->where('i_o_contacted_to_complainant',1)->count()}}
                        </td>
                        <td>
                            {{$user->challans()->where('i_o_contacted_to_complainant',0)->count()}}
                        </td>
                        {{-- <td>
                            {{$user->challans()->where('challan_interim_report_within_14_days',0)->count()}}
                        </td> --}}
                        <td>
                            {{$user->challans()->where('challan_prepare_within_14_days',0)->count()}}
                        </td>
                        {{-- <td>
                            @if ($user->status == 'active')
                                <span class="badge badge-success">Active</span>      
                            @else
                                <span class="badge badge-danger">{{$user->status}}</span>                                                      
                            @endif
                        </td> --}}
                    

                            <td> <a href="{{route('admin.user.detail',$user->id)}}" class="button"><button class="btn btn-primary"> Detail</button></a></td>
                    </tr>
                    @php 
                    $challans = $challans + $user->challans()->count();
                    $challan_prepare_within_14_days = $challan_prepare_within_14_days + $user->challans()->where('challan_prepare_within_14_days',0)->count();
                    $i_o_contacted_to_complainant = $i_o_contacted_to_complainant + $user->challans()->where('i_o_contacted_to_complainant',0)->count();
                    $total_completed = $total_completed + $user->challans()->where('challan_prepare_within_14_days',1)->where('i_o_contacted_to_complainant',1)->count();
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="2"> <strong>Detail</strong> </td>
                        <td>{{@$challans}}</td>
                        <td>{{@$total_completed}}</td>
                        <td>{{@$i_o_contacted_to_complainant}}</td>
                        <td>{{@$challan_prepare_within_14_days}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(function() {
        // Datatables with Buttons
        var datatablesButtons = $("#datatables-buttons").DataTable({
            // responsive: true,
            lengthChange: !1,
            buttons: ["copy", "print"]
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection