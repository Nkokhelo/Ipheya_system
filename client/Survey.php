<?php
#21408789 Zulu NP
     require_once('../core/init.php');
     include('../admin/includes/head.php');
     include('../admin/includes/navigation.php');
     include('../core/logic.php');
     require_once('../core/controllers/surveying-controller.php');
?>

<body>
    <form action="ObservingForm.php" method="POST">
    <h1>Record Observing Details</h1>
    <table border="0">
                
        <tr>
            <td>Client Name</td>
            <td><select name="name">
                <?= $clientOptions?>
            </select>
            </td>
        </tr>
        <tr>
            <td>Category Observed</td>
            <td><input name="cat" type="text" value=''></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="discr" rows="5" cols="40"value='<?php echo $dis?>'/><?php if($dis_err) echo "Enter Discription"?></textarea></td>
        </tr>
        <tr>
            <td>Request Date</td>
            <td><input name="req" type="text" value="<?php echo $date ?>" readonly /></td>
        </tr>
        <tr>
            <td>Request Status</td>
            <td><input name="status" type="text" value='<?php echo $status?>'/><?php if($status_err) echo "Status"?></td>
        </tr>
        <tr>
            <td>Company Type</td>
            <td><input name="company" type="radio" value="Public"/>Public Company<br/>
            <input name="company" type="radio" value="Private"/>Private Company<td/>
            <?php if($type_err) echo "Select company type"?>
        </tr>
        <tr>
            <td>Classification</td>
            <td><select name="class">
            <option>select one</option>
            <option>Hospital</option>
            <option>Malls</option>
            <option>School</option>
            <option>House</option>
            <option>University</option>
            <option>Company</option>
            </select><?php if($class_err) echo "Select classification"?></td>
        </tr>
        <tr>
        <td>Quantity</td>
        <td><input name="quantity" type="text" value='<?php echo $quantity?>'/><?php if($quantity_err) echo "Quantity"?></td>
        </tr>
        <tr>
        <td><input name="submit" type="submit" value="Save Record"/></td>
        </tr>
    </table>
    </form>
</body>