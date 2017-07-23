<div id="addprogram" class="modal fade" tab-index="-1" role="modal" aria-hidden="true" aria-labelledby="addresses">
   <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="programs.php" method="POST">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" arial-Label="Close">&times</button>
                        <h3 class="modal-title text-center">
                            <label id='label'>New Program</label>
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="program_name">Title :</label>
                            <div class="col-xs-6">
                                <input  class="form-control" id='title' type="text" name ="program_name" required/>
                                <input  class="form-control" id='title' type="hidden" name ="delete_name" required/>
                                <input class="form-control" id='id' type="hidden" name ="id"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="description">Description :</label>
                            <div class="col-xs-8">
                                <textarea  class="form-control" id='description' name ="description" rows="8" cols="20" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-8" id='change'>
                                <input type="submit"id='save' name="save_program" class="btn btn-block btn-success" value="save"/>
                                <input type="submit"id='edit' name="update_program" class="btn btn-block btn-primary" value="update"/>
                                <input type="submit"id='delete' name="delete_program" class="btn btn-block btn-danger" value="archive"/>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
   </div>
</div>
<script>
   
</script>