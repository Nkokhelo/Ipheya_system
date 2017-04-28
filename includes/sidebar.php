<div class="col-lg-3" id="sidebar">
  <div class="row">
    <div class="col-md-12" id="sidebar-header">
      <span class="glyphicon glyphicon-th-list"></span> <span class="text-center ">Navigation</span>
    </div>
    <div class="clear-fix"></div>
  </div>
  <ul>
    <li class="<?=((isset($home_page))?'selected':'');?>"><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    <li class="<?=((isset($profile_page))?'selected':'');?>"><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
    <li class="<?=((isset($request_page))?'selected':'');?>"><a href="request.php"><span class="glyphicon glyphicon-plus"></span> Requests</a></li>
    <li class="<?=((isset($account_page))?'selected':'');?>"><a href="#"><span class="glyphicon glyphicon-comment"></span> Help</a></li>
    <li class="<?=((isset($account_page))?'selected':'');?>"><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
  </ul>
</div>
