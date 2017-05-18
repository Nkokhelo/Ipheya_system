<?php
if(isset($_POST['submit']))
{   session_start();
    $_SESSION['message']="Your Qoutation total price is bellow";
    $_SESSION['amount']=$_POST['amount'];
    $_SESSION['payament-status'] ="Qoutation Deposit";
    header('Location:indexes.php');
}
?>
<div class="">
    <form method="POST" action="qoutationView.php">
        amount <input name="amount" type="text"/>
        <input name="submit" type="submit" value="pay!"/>
    </form>
</div>