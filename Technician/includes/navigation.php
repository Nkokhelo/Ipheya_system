<!--<nav class="navbar navbar-default navbar-fixed-top" id="navbar-main">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle"  data-toggle="collapse" data-target="#main-menu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a style="color:#fff;"  href="index.php" class="navbar-brand text-uppercase">Ipheya</a>
  </div>
  <div class="container collapse navbar-collapse" id="main-menu">
    <ul class="nav navbar-nav">
      <li><a style="color:#fff;" href="#">View tasks</a></li>
      <li><a style="color:#fff;" href="Surveying.php">Record survey</a></li>
    </ul>
  </div>
</nav>-->
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-main" style="margin-bottom:1%;">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" style="color:#fff;" data-toggle="collapse" data-target="#main-menu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a   href="index.php" class="navbar-brand text-uppercase">Ipheya</a>
  </div>
  <div class="container collapse navbar-collapse" id="main-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Departments<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a  href="../admin/departments.php">Departments</a></li>
          <li><a  href="../admin/services.php">Services</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Employees<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a  href="../admin/employees.php">Employees</a></li>
            <li><a  href="../admin/roles.php">Roles</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Clients<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a  href="../admin/clients.php">All clients</a></li>
          <li><a  href="../admin/archives.php">Archived accounts</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Client Request<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a  href="../admin/clientRequest.php">Requests</a></li>
          <li><a href="../admin/Tickets.php">Tickets</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="">Survey<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="CreateSurvey.php">Record Survey</a></li>
          <li><a href="View.php">View survey</a></li>
        </ul>
      </li>
      <li><a href="../admin/CreateTask.php">Create Task</a></li>
      <li><a href="inventory/items.php">Inventory</a></li>
      <li><a href="../admin/targets.php">Targets</a></li>
    </ul>
  </div>
</nav>
<body id="admin-dashboard">
