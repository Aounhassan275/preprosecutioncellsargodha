@extends('court.layout.index')
@section('title')
Manage Judges
@endsection
@section('contents')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add New Judge</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.judges.store')}}" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Judge Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Judge Name" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Court Name</label>
                            <input type="text" name="court" class="form-control" placeholder="Enter Court Name" required>
                        </div>
                    </div> 
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Judges Detail</h5>
        </div>
        <div class="table-responsive">
            <table class="table" id="datatables-reponsive">
                <thead>
                    <tr>
                        <th style="width:auto;">Sr#</th>
                        <th style="width:auto;">Judge Name</th>
                        <th style="width:auto;">Court Name</th>
                        <th style="width:auto;">Action</th>
                        <th style="width:auto;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Judges::all() as $key => $judge)
                    <tr> 
                        <td>{{$key+1}}</td>
                        <td>{{$judge->name}}</td>
                        <td>{{$judge->court}}</td>
                        <td class="table-action">
                            <button data-toggle="modal" data-target="#edit_modal" name="{{$judge->name}}" 
                                court="{{$judge->court}}"  id="{{$judge->id}}" class="edit-btn btn"><i class="icon-pencil7"></i></button>
                        </td>
                        <td class="table-action">
                            {{-- <a href="{{url('poll/delete',$package->id)}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                            <form action="{{route('user.judges.destroy',$judge->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn"><i class="icon-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Judge Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Court Name</label>
                        <input class="form-control" type="text" id="court" name="court" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            let id = $(this).attr('id');
            let name = $(this).attr('name');
            let court = $(this).attr('court');
            $('#name').val(name);
            $('#court').val(court);
            $('#id').val(id);
            $('#updateForm').attr('action','{{route('user.judges.update','')}}' +'/'+id);
        });
    });
</script>
<script>
    $(function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            // responsive: true
        });
    });
</script>
@endsection