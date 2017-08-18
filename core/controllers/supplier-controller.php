<?php
#retrive list
$sql = "SELECT * FROM suppliers";
$query = mysqli_query($db, $sql);
$all_suppliers = '';
while($suppliers = mysqli_fetch_assoc($query)):
      $all_suppliers .= "<tr>
                      <td>".$suppliers['supplier_no']."</td>
                      <td>".$suppliers['company_name']."</td>
                      <td>".$suppliers['telephone']."</td>
                      <td>".$suppliers['email']."</td>
                      <td>
                        <a href='viewsupplier.php?edit=".$suppliers['supplier_no']."' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil text-primary'></span></a>
                        <a href='viewsupplier.php?delete=".$suppliers['supplier_no']."' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-trash text-danger'></span></a>
                        <a href='viewsupplier.php?view=".$suppliers['supplier_no']."' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-eye-open text-danger'></span></a>
                      </td>
                    </tr>";
endwhile;
#add new supplier...
    if(isset($_POST['savesupplier']))
    {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $name = sanitize($name);

        $address = mysqli_real_escape_string($db, $_POST['address']);
        $address = sanitize($address);

        $line2 = mysqli_real_escape_string($db, $_POST['line2']);
        $line2 = sanitize($line2);

        $line3 = mysqli_real_escape_string($db, $_POST['line3']);
        $line3 = sanitize($line3);

        $line4 = mysqli_real_escape_string($db, $_POST['line4']);
        $line4 = sanitize($line4);

        $postal = mysqli_real_escape_string($db, $_POST['postal']);
        $postal = sanitize($postal);

        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $fullname = sanitize($fullname);

        $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
        $telephone = sanitize($telephone);

        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
        $mobile = sanitize($mobile);

        $fax = mysqli_real_escape_string($db, $_POST['fax']);
        $fax = sanitize($fax);

        $email = mysqli_real_escape_string($db, $_POST['email']);
        $email = sanitize($email);

        $web = mysqli_real_escape_string($db, $_POST['web']);
        $web = sanitize($web);

        #generating unique supplier number
        $date = date('Y-m-d');//we take a date
        $client_unique = uniqid();//generate unique id
        $sup_no ="S".substr($date,2,2).substr($date,0,2).strtoupper(substr($client_unique,4,4));//create new supplier no by date and unique values of miniseconds
        
        $ins_supplier = "INSERT INTO suppliers(supplier_no,company_name, address ,line2,line3, line4, post_code , contact_name , telephone , mobile, fax, email,web)
         VALUES('{$sup_no}','{$name}','{$address}','{$line2}','{$line3}','{$line4}','{$postal}','{$fullname}','{$telephone}','{$mobile}','{$fax}','{$email}','{$web}')";
         if(mysqli_query($db,$ins_supplier))
         {
            header('Location: allsuppliers.php');
         }
         else
         {
             die(mysqli_error($db));
         }

    }

    if(!empty($_GET['edit']))
    {
        $sup_no = $_GET['edit'];
        $supplier_query = "SELECT * FROM suppliers WHERE supplier_no = '{$sup_no}'";
        if(mysqli_query($db,$supplier_query))
        {
            $getsupplier = mysqli_query($db,$supplier_query);
            $supplier = mysqli_fetch_assoc($getsupplier);
            if(mysqli_num_rows($getsupplier)>0)
            {
                $name = $supplier['company_name'];
                $address = $supplier['address'];
                $line2 = $supplier['line2'];
                $line3 = $supplier['line3'];
                $line4 = $supplier['line4'];
                $postal = $supplier['post_code'];
                $fullname = $supplier['contact_name'];
                $telephone = $supplier['telephone'];
                $mobile = $supplier['mobile'];
                $fax = $supplier['fax'];
                $web = $supplier['web'];
                $email = $supplier['email'];
            }
            else
            {
                die("error");
            }
        }
        else
        {
            die("error".mysqli_error($db));
        }
    }
    if(isset($_POST['update']))
    {
        $sup_no = $_POST['sup_no'];
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $name = sanitize($name);

        $address = mysqli_real_escape_string($db, $_POST['address']);
        $address = sanitize($address);

        $line2 = mysqli_real_escape_string($db, $_POST['line2']);
        $line2 = sanitize($line2);

        $line3 = mysqli_real_escape_string($db, $_POST['line3']);
        $line3 = sanitize($line3);

        $line4 = mysqli_real_escape_string($db, $_POST['line4']);
        $line4 = sanitize($line4);

        $postal = mysqli_real_escape_string($db, $_POST['postal']);
        $postal = sanitize($postal);

        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $fullname = sanitize($fullname);

        $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
        $telephone = sanitize($telephone);

        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
        $mobile = sanitize($mobile);

        $fax = mysqli_real_escape_string($db, $_POST['fax']);
        $fax = sanitize($fax);

        $email = mysqli_real_escape_string($db, $_POST['email']);
        $email = sanitize($email);

        $web = mysqli_real_escape_string($db, $_POST['web']);
        $web = sanitize($web);

        $supplier_query = "SELECT * FROM suppliers WHERE supplier_no = '{$sup_no}'";
        $edit_query =mysqli_query($db,$supplier_query);
        if(mysqli_num_rows(mysqli_query($db,$supplier_query))>0)
        {
            $edit_query = "UPDATE suppliers SET company_name = '$name', address = '$address', line2='$line2', line3='$line3', line4='$line4',
            post_code='$postal',contact_name='$fullname',telephone = '$telephone', mobile='$mobile',fax='$fax',web='$web',email ='$email' WHERE supplier_no = '{$sup_no}'";
            $upadte = mysqli_query($db, $edit_query);
            header('Location: viewsupplier.php?view='.$sup_no);
        }
        else
        {
            die($supplier_query);
        }
    }
    if(isset($_GET['view']))
    {
        $sup_no = $_GET['view'];
        $supplier_query = "SELECT * FROM suppliers WHERE supplier_no = '{$sup_no}'";
        if(mysqli_query($db,$supplier_query))
        {
            $getsupplier = mysqli_query($db,$supplier_query);
            $supplier = mysqli_fetch_assoc($getsupplier);
            if(mysqli_num_rows($getsupplier)>0)
            {
                $name = $supplier['company_name'];
                $address = $supplier['address'];
                $line2 = $supplier['line2'];
                $line3 = $supplier['line3'];
                $line4 = $supplier['line4'];
                $postal = $supplier['post_code'];
                $fullname = $supplier['contact_name'];
                $telephone = $supplier['telephone'];
                $mobile = $supplier['mobile'];
                $fax = $supplier['fax'];
                $web = $supplier['web'];
                $email = $supplier['email'];
            }
            else
            {
                die("error");
            }
        }
    }
    if(isset($_GET['delete']))
    {
        die('write the delete process');
    }
?>