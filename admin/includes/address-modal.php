<div class="modal fade" id="addresses" role="modal" tabindex="-1" aria-hidden="true" aria-labelledby="addresses">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bhr">
        <button type="button" class="close" name="button" data-dismiss="modal" aria-label="Close">&times;</button>
        <div class="modal-title text-center ">
          <h4 class="bh">Addresses</h4>
        </div>
      </div>
      <div class="modal-body bhr">
        <div class="container-fluid">
            <div class="form-group">
              <label for="residential">Residential address</label>
              <textarea name="modal-residential" class="form-control" id="modal-residential" rows="3"><?=((isset($residential))?$residential:'');?></textarea>
            </div>
            <div class="form-group">
              <label for="postal">Postal address</label>
              <textarea name="modal-postal" class="form-control" id="modal-postal" rows="3"><?=((isset($postal))?$postal:'');?></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="updateAddresses();$('#addresses').modal('toggle');return false;"><span class="glyphicon glyphicon-ok"></span> Ok</button>
        <button type="button" class="btn btn-default" name="button" data-dismiss="modal"><span class="glyphicon glyphicon-cancel"></span> Close</button>
      </div>
    </div>
  </div>
</div>
