<div id="challan_sent_to_prosecution_date_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="challanSentToProsecutionDateModalForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Date of Receiving of Reports u/sec 173 crpc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Date</label>
                        <input type="text" name="date_of_receiving_challan_in_court" class="daterange-single form-control "
                            @if($challan->date_of_receiving_challan_in_court)
                            value="{{ date('m/d/Y', strtotime(@$challan->date_of_receiving_challan_in_court))}}"
                            @endif
                            >
                    
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