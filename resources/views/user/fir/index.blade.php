@extends('user.layout.index')
@section('title')
FIR 
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
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">View All FIRS</h5>
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
                <th>Offence</th>
                <th>PS</th>
                <th>View</th>
                {{-- <th>Action</th> --}}
            </tr> 
        </thead>
        <tbody>
            @foreach (Auth::user()->firs as $key => $fir)
            <tr> 
                <td>{{$key+1}}</td>
                <td>{{$fir->fir."/".$fir->dated->format('y')}}</td>
                <td>{{$fir->dated->format('d M,Y')}}</td>
                <td>{{$fir->under_section}}</td>
                <td>{{$fir->offence}}</td>
                <td>{{$fir->police_station}}</td>
                <td><a href="{{asset($fir->image)}}"><i class="icon-eye"></i></a></td>
                {{-- <td class="text-center">
                    <a href="{{route('user.fir.edit',$fir->id)}}" target="_blank"><i class="icon-pencil7"></i></a>
                    <form action="{{route('user.fir.destroy',$fir->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn"><i class="icon-trash"></i></button>
                    </form>
                </td> --}}
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