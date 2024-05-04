<?php echo '<div id="editModal'.$row['hid'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Course Info</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['hid'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Household #: </label>
                    <input class="form-control input-sm" type="text" name="householdno" value="'.$row['householdno'].'" />
                </div>
                <div class="form-group">
                    <label>Zone: </label>
                    <input name="txt_edit_zone" class="form-control input-sm" type="text" value="'.$row['hzone'].'"/>
                </div>
                <div class="form-group">
                    <label>Head of Family: <span style="color:gray; font-size: 10px;">(Lastname, Firstname Middlename)</span></label>
                        <input class="form-control input-sm" name="txt_edit_hof" type="text" value="'.$row['headoffamily'].'" />
                </div>
                <div class="form-group">
                    <label>Total Household Members : </label>
                    <input  id="txt_edit_totalmembers" name="txt_edit_totalmembers" class="form-control input-sm" type="number" value="'.$row['totalhouseholdmembers'].'" />
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';

