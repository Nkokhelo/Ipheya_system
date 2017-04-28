<?php
    #add client to database
    if(isset($_POST['Register'])){
      session_start();
      $name = mysqli_real_escape_string($db, $_POST['name']);
      $name = sanitize($name);
      $surname = mysqli_real_escape_string($db, $_POST['surname']);
      $surname = sanitize($surname);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $email = sanitize($email);
      $postal = mysqli_real_escape_string($db, $_POST['postal']);
      $postal = sanitize($postal);
      $number = mysqli_real_escape_string($db, $_POST['number']);
      $number = sanitize($postal);
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $password = sanitize($password);
      $province = $account = $token = 'default';

      $check_existing_user = "SELECT * FROM clients WHERE email = '$email'";
      $check_existing_exe = mysqli_query($db,$check_existing_user);
      $count = mysqli_num_rows($check_existing_exe);
      #check if any required fields are empty
      if(empty($name)){
        $errors[] .= 'Name is required.';
      }
      if(empty($surname)){
        $errors[] .= 'Surname is required.';
      }
      if(empty($email)){
        $errors[] .= 'Email is required.';
      }
      if(empty($postal)){
        $errors[] .= 'Postal is required.';
      }
      if(empty($number)){
        $errors[] .= 'Number is required.';
      }
      if(empty($password)){
        $errors[] .= 'Password is required.';
      }
      if($count>0){
        $errors[] .= 'The email you entered already belongs to a user.';
      }
      if(!empty($errors)){
        $display = display_errors($errors);
      }
      else{
        echo $insert_c = "INSERT INTO clients(name,surname,email,password,postal_address,contact_number,province,account,archived,token)
        VALUES('{$name}','{$surname}','{$email}','{$password}','{$postal}','{$number}','{$province}','{$account}',0,'{$token}')";
        mysqli_query($db,$insert_c);
        header('Location: login.php?success=1');
      }
    }
?>
