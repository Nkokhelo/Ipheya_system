<div id="addproject" class="modal fade" tab-index="-1" role="modal" aria-hidden="true" aria-labelledby="addresses">
   <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <form class="form-horizontal" action="programs.php" method="POST">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" arial-Label="Close">&times</button>
                        <h3 class="modal-title text-center">
                            <label id='label'>Project Infomation</label>
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="project_name">Name :</label>
                            <div class="col-xs-4">
                                <input required class="form-control" id='project_name' type="text" name ="project_name"/>
                                <input required class="form-control" id='program_no' type="hidden" name ="program_no" value="<?=$_GET['view']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="description">Description :</label>
                            <div class="col-xs-8">
                                <textarea class="form-control" id='description' name ="description" rows="5" cols="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                                <label class="col-xs-2 control-label" for="">Project Date(s) :</label>
                                <div class="col-xs-4  input-group input-append " id='dsdate'style='padding-left:15px'>
                                    <input required placeholder='Start Date' class="form-control " id='sdate' name ="sdate" rows="5" cols="10"></input>
                                    <span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
                                </div>
                                <!--<label class="col-xs-2 control-label" for="description">End Date :</label>-->
                                <div class="col-xs-4  input-group input-append " id='dedate' style='padding-left:15px'>
                                    <input required placeholder='End Date' class="form-control " id='edate' name ="edate"></input>
                                    <span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="client_no">Client :</label>
                            <div class="col-xs-5 input-group " style='padding-left:15px'>
                                    <select required placeholder='Client' class="form-control" id='client_no' name ="client_no">
                                        <option value='0'>~Select a Client~</option>
                                    </select>
                                    <div class='input-group-btn' style="width:10%">
                                            <a type="" class='btn btn-default'><span class='glyphicon glyphicon-search'></span></a>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-2 control-label" for="employee_no">Project Manager :</label>
                            <div class="col-xs-5 input-group" style='padding-left:15px'>
                                    <select required placeholder='Client' class="form-control" id='employee_no' name ="employee_no">
                                        <option value='0'>~Select a Project Manager~</option>
                                    </select>
                                    <div class='input-group-btn' style="width:10%">
                                            <a type="" class='btn btn-default'><span class='glyphicon glyphicon-search'></span></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-8" id='change'>
                                <input required type="submit"id='save' name="save_project" class="btn btn-block btn-success" value="create"/>
                                <!--<input required type="submit"id='edit' name="update_program" class="btn btn-block btn-primary" value="update"/>-->
                                <!--<input required type="submit"id='delete' name="delete_program" class="btn btn-block btn-danger" value="archive"/>-->
                            </div>
                        </div>
                    </div>
            </form>
        </div>
   </div>
</div>
<script>
    $('#edate').datepicker({
        minDate:0,
		dateFormat: 'yy-mm-dd'
    }
    );
    $('#sdate').datepicker(
        {
        minDate:0,
		dateFormat: 'yy-mm-dd'
        }
    );
</script>