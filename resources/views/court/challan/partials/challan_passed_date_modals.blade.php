<div id="challan_passed_date_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="challanPassedDateModalForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Challan Status Either Passed by Prosecutor or Objection Raised</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group" >
                        <label ><input type="checkbox" name="objection" @if($challan->objection_date && $challan->challan_passed_date == null) checked @endif id="objection"> Objection Raised</label>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" @if($challan->objection_date && $challan->challan_passed_date == null) style="display:none;" @endif id="challan_passed">
                            <label for="title">Challan Passed</label>
                            <input type="text" name="challan_passed_date" class="daterange-single form-control "
                                @if($challan->challan_passed_date)
                                value="{{ date('m/d/Y', strtotime(@$challan->challan_passed_date))}}"
                                @endif
                                >
                        
                        </div>
                        <div class="form-group col-md-6" id="objection_raised" @if(!$challan->objection_date  || $challan->challan_passed_date != null) style="display:none;"@endif>
                            <label for="title">Objection Raised</label>
                            <input type="text" name="objection_date" class="daterange-single form-control "
                                @if($challan->objection_date)
                                value="{{ date('m/d/Y', strtotime(@$challan->objection_date))}}"
                                @endif
                                >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Prosecutor Name</label>
                            <input type="text" name="prosecutor_name" value="{{@$challan->prosecutor_name}}" class="form-control " required>
                        
                        </div>
                    </div>
                    <p id="errors" style="color:red;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>