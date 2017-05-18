<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
	 include('../core/logic.php');
     require_once("../core/controllers/qoutation-controller.php");
?>
<div class="col-sm-12">
    <div class="col-sm-8 col-sm-offset-2 b">
        <h2>All qoutations</h2><hr class="bhr"/>
        <table class="table">
            <thead>
                <th>Qoute Name</th>
                <th>Qoute Date</th>
                <th>Qoute Status</th>
                <th> </th>
            </thead>
            <tbody>
                <?=$allQoute?>
            </tbody>
        </table>
    </div>
</div>