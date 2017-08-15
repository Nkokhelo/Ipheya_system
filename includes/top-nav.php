<body id="client-dashboard" style="background-color:#fff;">
<div class="col-lg-12" id="page-header">
  <div class="logo col-md-9">
    <a href="home.php" class="navbar navbar-brand text-uppercase">Ipheya</a>
  </div>
  <div class="col-md-3">
    <div class="logo pull-right">
      <div class="dropdown"  style="margin-top:15px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['Client'];?> <span class="caret"></span>
          <ul class="dropdown-menu dropdown-menu-right" style="color:black" id="#clientOptions">
            <li><a href="../client/profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="../client/CreateTicket.php"><span class="glyphicon glyphicon-alert"></span> Report Faults</a></li>
            <li><a href="../login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
      </div>
      </div>

      </a>
    </div>
  </div>
</div>
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-main">
  <div class="container-fluid">
     <div class="navbar-header">
          <button type="button" class="navbar-toggle" style="color:#fff;" data-toggle="collapse" data-target="#main-menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand text-uppercase">Ipheya</a>
      </div>
      <div class="container collapse navbar-collapse" id="main-menu">
        <div class="navbar-header">
            
        </div>
        <div class="navbar-header navbar-right">
            <ul class="nav navbar-nav">
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['Client'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-right" style="color:black" id="#clientOptions">
                  <li><a href="../client/profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                  <li><a href="../client/CreateTicket.php"><span class="glyphicon glyphicon-alert"></span> Report Faults</a></li>
                  <li><a href="../login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
              </li>
            </ul>
        </div>
        

      </div>
  </div>
</nav>
<body id="admin-dashboard">
<div class="notification-container hide-not"style="color:white">
  <div class="col-lg-12">
    <div class="col-lg-12" style="boder-bottom:1px white solid;">
      <h2 style="color:#fff"><p class="glyphicon glyphicon-bell" style="font-size:20px"></p> Notifications<p class="badge" style="background-color:red; font-size: 20px;left:80%; top:3%">6</p> </h2>
    </div>
    <hr class="bhr"/>
    <div class="col-lg-12">
          <h5>4 unread client request</h>
      <hr />
    </div>
    <div class="col-lg-12">
          <h5>3 clients has been regesterd</h>
      <hr />
    </div>
    <div class="col-lg-12">
          <h5>Would you like to assign task??</h5>
      <hr />
    </div>
  </div>
</div>
<p class="badge not-num" id="not" style="">6</p>
<div class="notification" onclick="show">
  <p class="not-bell glyphicon glyphicon-bell" ></p>
</div>

<script>
  $(document).ready(function(){
    $(".notification").click(function(){
            $(".notification").toggleClass("move");
            // $(".notification-container").toggleClass("show-not");
            // $(".notification-container").toggleClass("hide-not");
            // $("#not").toggleClass("hide-not");
            $("#not").toggle(300);
            $(".notification-container").toggle(300);
    });
  });
</script>
