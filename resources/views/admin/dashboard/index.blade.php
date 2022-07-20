@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>DASHBOARD | Investigation & Monitoring Cell</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{route('admin.user.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-primary float-right">All</span>
                                <h5 class="card-title mb-0">Total User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::all()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.actives')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-info float-right">All</span>
                                <h5 class="card-title mb-0">Total Active Users</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::active()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.blocks')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-danger float-right">All</span>
                                <h5 class="card-title mb-0">Total Block Users </h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::block()->count()}}                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{route('admin.user.police_station')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-warning float-right">All</span>
                                <h5 class="card-title mb-0">Total Police Station Users</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::police_station()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.prosecution_branch')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-success float-right">All</span>
                                <h5 class="card-title mb-0">Total Prosecution Branch User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::prosecution_branch()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.court')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-primary float-right">All</span>
                                <h5 class="card-title mb-0">Total Court User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::court()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="media">
                        <div class="d-inline-block mt-2 mr-3">
                            <i class="feather-lg text-warning" data-feather="activity"></i>
                        </div>
                        <div class="media-body">
                            <a href="{{route('admin.challan.index')}}">
                                <h3 class="mb-2">{{App\Models\Challan::count()}}</h3>
                                <div class="mb-0" style="color:black;">Total Challans</div>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-warning" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_challan')}}">
                            <h3 class="mb-2">{{App\Models\Challan::where('challan_prepare_within_14_days',1)->where('challan_receive_in_branch',0)->count()}}</h3>
                            <div class="mb-0" style="color:black;">Your Pending Challan</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-warning" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.under_trail_challans')}}">
                            <h3 class="mb-2">{{count(App\Models\Challan::underTrailChallanPendency())}}</h3>
                            <div class="mb-0" style="color:black;">Under Trail Challans</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-danger" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_by_ps_in_contacts')}}">
                            <h3 class="mb-2">{{App\Models\Challan::where('i_o_contacted_to_complainant',0)->count()}}</h3>
                            <div class="mb-0" style="color:black;">Pendency From PS I/O Not Contacted to Complainant</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-danger" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_by_ps_in_interim_report')}}">
                            <h3 class="mb-2">{{App\Models\Challan::where('challan_interim_report_within_14_days',0)->count()}}</h3>
                            <div class="mb-0" style="color:black;">Pendency From PS Interim Report Not Prepared within 3 Days</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-danger" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_by_ps')}}">
                            <h3 class="mb-2">{{App\Models\Challan::where('challan_prepare_within_14_days',0)->count()}}</h3>
                            <div class="mb-0" style="color:black;">Pendency From PS Challan Not Prepared within 14 Days</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-success" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_by_prosecution')}}">
                            <h3 class="mb-2">{{App\Models\Challan::where('file_send_after_3_days',1)
                            ->whereNull('challan_passed_date')->whereNull('objection_date')->count()}}</h3>
                            <div class="mb-0" style="color:black;">Challan Pending By Prosecution Branch</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-success" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.passed')}}">
                            <h3 class="mb-2">{{App\Models\Challan::whereNotNull('challan_passed_date')->count()}}</h3>
                            <div class="mb-0" style="color:black;">Challan Passed By Prosecution Branch</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-success" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.objection')}}">
                            <h3 class="mb-2">{{App\Models\Challan::whereNotNull('objection_date')->whereNull('challan_passed_date')->count()}}</h3>
                            <div class="mb-0" style="color:black;">Challan with Objection</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-info" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.pending_by_court')}}">
                            <h3 class="mb-2">{{App\Models\Challan::whereNull('date_of_receiving_challan_in_court')
                            ->whereNotNull('challan_passed_date')->count()}}</h3>
                            <div class="mb-0" style="color:black;">Challan Pending By Court</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="d-inline-block mt-2 mr-3">
                        <i class="feather-lg text-info" data-feather="activity"></i>
                    </div>
                    <div class="media-body">
                        <a href="{{route('admin.challan.court')}}">
                            <h3 class="mb-2">{{App\Models\Challan::whereNotNull('date_of_receiving_challan_in_court')->count()}}</h3>
                            <div class="mb-0" style="color:black;">Challan Received By Court</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection