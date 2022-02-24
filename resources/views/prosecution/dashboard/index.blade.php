@extends('prosecution.layout.index')

@section('title')

    
DASHBOARD

@endsection
@section('styles')
<style>
    blink {
        animation: blinker 2s linear infinite;
    }
    @keyframes blinker {
        50% {
          opacity: 0;
        }
      }
  </style>   
@endsection


@section('contents')
<div class="row">
  <div class="col-sm-6 col-xl-6">
    <a href="{{route('user.challan.index')}}">
    <div class="card card-body bg-blue-400 has-bg-image">
          <div class="media">
              <div class="media-body">
                  <h3 class="mb-0">{{App\Models\Challan::where('file_send_after_3_days',1)->count()}}</h3>
                  <span class="text-uppercase font-size-xs">Total Challan Received</span>
              </div>

              <div class="ml-3 align-self-center">
                  <i class="icon-users2 icon-3x opacity-75"></i>
              </div>
          </div>
      </div>
    </a>
  </div>

  <div class="col-sm-6 col-xl-6">
    <a href="{{route('user.challan.pending_challan')}}">
    <div class="card card-body bg-danger-400 has-bg-image">
          <div class="media">
              <div class="media-body">
                  <h3 class="mb-0">{{App\Models\Challan::where('file_send_after_3_days',1)
                    ->whereNull('challan_passed_date')->whereNull('objection_date')->count()}}</h3>
                  <span class="text-uppercase font-size-xs">Your Pending Challan</span>
              </div>

              <div class="ml-3 align-self-center">
                  <i class="icon-collaboration icon-3x opacity-75"></i>
              </div>
          </div>
      </div>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-xl-6">
    <a href="{{route('user.challan.passed_challan')}}">
      <div class="card card-body bg-indigo-400 has-bg-image">
          <div class="media">
              <div class="mr-3 align-self-center">
                  <i class="icon-cart2 icon-3x opacity-75"></i>
              </div>

              <div class="media-body text-right">
                <h3 class="mb-0">{{App\Models\Challan::whereNotNull('challan_passed_date')->count()}}</h3>
                <span class="text-uppercase font-size-xs">Challan Passed in Prosecution Branch</span>
              </div>
          </div>
      </div>
    </a>
  </div>
  <div class="col-sm-6 col-xl-6">
    <a href="{{route('user.challan.objection_challan')}}">
      <div class="card card-body bg-success-400 has-bg-image">
          <div class="media">
            <div class="ml-3 align-self-center">
              <i class="icon-users2 icon-3x opacity-75"></i>
            </div>
              <div class="media-body text-right">
                <h3 class="mb-0">{{App\Models\Challan::whereNotNull('objection_date')->whereNull('challan_passed_date')->count()}}</h3>
                <span class="text-uppercase font-size-xs">Challan with Objection</span>
              </div>

              
          </div>
      </div>
    </a>
  </div>

  {{-- <div class="col-sm-4 col-xl-4">
    <a href="{{route('user.challan.court')}}">
      <div class="card card-body bg-orange-400 has-bg-image">
          <div class="media">
            <div class="ml-3 align-self-center">
              <i class="icon-wallet icon-3x opacity-75"></i>
            </div>
            <div class="media-body text-right">
              <h3 class="mb-0">{{App\Models\Challan::whereNotNull('date_of_receiving_challan_in_court')->count()}}</h3>
              <span class="text-uppercase font-size-xs">Challan In Court</span>
            </div>
          </div>
      </div>
    </a>
  </div> --}}
</div>
@endsection
@section('scripts')
    <script src="{{ url('chart/Chart.min.js') }}"></script>
   
@endsection
