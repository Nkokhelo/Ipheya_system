<div class="modal fade" id="rolesAssign" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="roles-modal-label">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center" id="roles-model-label">Assign Role</h4>
      </div>
         <form class="form-inline" action="roles.php<?=((isset($_GET['remove']))?'?remove='.$remove_id:'');?>" method="post">
            <div class="modal-body">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="employee email">
                        <select class="form-control" name="role" id="role">
                        <?=((isset($allEmployeeRoles))?$allEmployeeRoles:$allCompanyRoles);?>
                        </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" name="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <?= ((isset($_GET['remove']))?'<input type="submit" class="btn btn-danger" name="Remove" value="Remove role">':'<input type="submit" name="Assign" value="Assign role" class="btn btn-success">');?>
            </div>
        </form>
  </div>
</div>
</div>
