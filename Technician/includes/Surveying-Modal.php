<?= session_start();?>
<div id="Smodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bhr">
                <button type="button" class="close" data-dismiss="modal">&times</button>
                <h2>Edit Surveying information</h2>
            </div>
             <form class="form" action="View.php" id="result" method="GET">
                  <div class='modal-body bhr'>
                             <input type='text' id='edit' name='edit'/>
                            <div class='form-group'>
                                <label for='reqID'>Request id</label>
                                <select class='form-control' name='reqID' id='reqID' required>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='discr'>Description</label>
                                <textarea name='discr' id='discr' class='form-control' rows='5' cols='40' placeholder='Enter Discription' required><?=$_SESSION['desc']?></textarea>
                            </div>
                            <div class='form-group'>
                                <label for='image'>Photos</label>
                                <input type='file' name='image' id='image'  required value=''/>
                            </div>
                    </div>
                    <div class='modal-footer'>
                        <input type='submit' class='btn btn-success' name='submit' value='Add Record'/>
                    </div>
            </form>
        </div>
    </div>
</div>

<div id="Dmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bhr">
                <button type="button" class="close" data-dismiss="modal">&times</button>
                <h2>Remove Survey information</h2>
            </div>
             <form class="form" action="View.php" method="GET">
                    <div class="modal-body bhr">
                            <h3>Are you sure you want to remove this information</h3>
                            <input type="hidden" id='delete' name="delete"/>
                    </div>
                    <div class="modal-footer">
                                <input type="submit" class="btn btn-success" name="submit" value="Remove"/>
                    </div>
            </form>
        </div>
    </div>
</div>