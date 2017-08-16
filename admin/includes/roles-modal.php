<div class="modal fade" id="roles-modal" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="roles-modal-label">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center" id="roles-model-label">Roles</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="roles1">Admin</label>
          <input type="checkbox" name="roles1" class="form-control" id="roles1" value="admin">
        </div>
        <div class="form-group">
          <label for="roles2">Manager</label>
          <input type="checkbox" name="roles2" class="form-control" id="roles2" value="manager">
        </div>
        <div class="form-group">
          <label for="roles3">Technician</label>
          <input type="checkbox" name="roles3" class="form-control" id="roles3" value="technician">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" name="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="updateRoles();$('#roles-modal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
 <!--add new role modal-->
<div class="modal fade" id="add-role" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="roles-modal-label">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center" id="roles-model-label">Add new role</h4>
      </div>
      <form class="form-inline" action="roles.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
      <!--The roles form-->
        <div class="modal-body">
            <div class="form-group">
              <input type="text" name="company-role" id="company-role" class="form-control" value="<?=((isset($_GET['edit']))?$role_val:'');?>" placeholder="Role Name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" name="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          <?= ((isset($_GET['add']))?'<input type="submit" class="btn btn-success" name="Add" value="Add role">':'<input type="submit" name="Edit" value="Edit Role" class="btn btn-success">');?>
        </div>
      </form>
    </div>
  </div>
</div>



                    