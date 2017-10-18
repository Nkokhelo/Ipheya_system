<!-- Sidebar Holder -->
<nav id="sidebar">
<div class="sidebar-header">
    <h3 style='font-weight:900'>IPHEYA</h3>
</div>
<!-- -My new side bar-->
<ul class="list-unstyled components">
  <li>
    <a href="dashboard.php" >
      <i class="fa fa-dashboard"></i>
      Dashboard
    </a>
  <li>
    <a href="#companyMenu" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">
      <i class='fa fa-building-o'></i>
      Departments
    </a>
      <ul class="collapse list-unstyled" id="companyMenu">
        <li><a id="ddepa" href="departments.php">Departments</a></li>
        <li><a id="dsup" href="allservices.php">Services</a></li>
    </ul>
  </li>
  <li  >
    <a href="#stakeholders" data-toggle="collapse" aria-expanded="false">
      <i class='fa fa-vcard-o'></i>
      HR Management
    </a>
    <ul class="collapse list-unstyled" id="stakeholders">
        <li><a  href="allemployees.php">Employees</a></li>
        <li><a  href="allsuppliers.php">Suppliers</a></li>
        <li><a id="Eve" href="create_events.php">Events</a></li>
        <li><a  href="roles.php">Roles</a></li>
        <li><a  href="alltrainer.php">Trainers</a></li>
    </ul>
  </li>
  <li>
    <a href="#clientMenu" data-toggle="collapse" aria-expanded="false">
      <i class='fa fa-group'/></i>
      Clients
    </a>
    <ul class="collapse list-unstyled" id="clientMenu">
      <li><a  href="clients.php">All clients</a></li>
      <li><a  href="archives.php">Archived accounts</a></li>
    </ul>
  </li>
  <li  >
    <a href="#requestsMenu" data-toggle="collapse" aria-expanded="false">
        <i class='fa fa-copy'></i>
      Request & Tickets
    </a>
    <ul class="collapse list-unstyled" id="requestsMenu">
      <li><a  href="clientRequest.php">Requests</a></li>
      <li><a href="Tickets.php">Tickets</a></li>
      <li><a href="allfaqs.php">FAQ</a></li>
    </ul>
  </li>
  <li>
  <a href="#Inventory" data-toggle="collapse" aria-expanded="false">
      <i class='fa fa-cubes'></i>
      Equipment
    </a>
    <ul class="collapse list-unstyled" id="Inventory">
      <li><a  href="brand.php">Brand</a></li>
      <li><a  href="category.php">Category</a></li>
      <li><a  href="manageproducts.php">Products</a></li>
      <li><a href="orders.php">Orders</a></li>
      <li><a href="inventories.php">Inventory</a></li>
      <li><a href="sales.php">Sales</a></li>
      <li><a href="rentals.php">Rentals</a></li>
    </ul>
  </li>
  <li>
    <a href="targets.php">
        <i class='fa fa-bullseye'></i>
      Targets
    </a>
  </li>
  <li>
    <a href="../login.php">
      <i class="fa fa-sign-out"></i>
      Logout
    </a>
  </li>
</ul>
</nav>
<!-- The bell -->
  <div class="">
    <b id="count" class="count notcount"></b>
    <p class="fa fa-bell-o thebell" style="padding-top:5px;" onclick="show()"></p>
  </div>
<!-- The notifications panel -->
<div class="notification-container hide-not">
<div class="col-lg-12" style="padding-right:0; padding-left:0;">
  <h4 class="text-center" style="line-height:30%"><b><p class="notcount" style="display:inline"></p></b><p class="fa fa-bell" style="font-size:20px"></p> Notifications</h4>
  <hr class="bhr" style="margin-bottom:0;">
  <div class="body-con">
    <ul class="notif">

    </ul>
  </div>
  <hr class="bhr" style="margin-top:0;">
  <div class="col-xs-12 text-center">
    <a href="clearall"><i class="fa fa-okay"></i>Mark all as read</a>
  </div>
</div>
</div>


<script>
function show()
{
  $(".notification-container").toggle();
  $(".notif").load("/ipheya/core/sub/notifications.php?load=<?php echo($_SESSION['Employee']) ?>");
}

$(function(){
  setInterval(() => {
    getno();
    console.log("Notification action");
  }, 5000);
});

function getno()
{
  $.ajax({
          type: "get",
          url: "/ipheya/core/sub/notifications.php",
          data: "count=<?php echo($_SESSION['Employee']);?>",
          success: function(data) {
            data = JSON.parse(data);
              if(data>0)
              {
                $('.notcount').text(data);
                $('.notcount').show();
              }
              else
              {
                $('#count').hide();
              }
            },
          error:function(error){
              console.log(error);
              }
            });
}
function updatenot(id,link)
{
  $.ajax({
    type: "get",
    url: "/ipheya/core/sub/notifications.php",
    data: "updatenot="+id,
    success: function(data) {
      data = JSON.parse(data);
        if(data>0)
        {
          window.location.href = link;
        }
        else
        {
          console.log("Error");
        }
      },
    error:function(error){
        console.log("The error"+error);
        }
      });
}

$("#sidebar .components li").click(function() {
  $("#sidebar .components li.active a").removeClass("active");
  $(this).addClass("active");
});
$('#sidebar .components li a').click(function(){
  $(this).parent().addClass('active').siblings().removeClass('active');
});


$(function()
{
$('#sidebar .components li a').filter(function()
{return this.href==location.href}).parent().addClass('active').css('border-left','3px rgb(169, 176, 187) solid').siblings().removeClass('active').attr("aria-expanded","flase");

$('#sidebar .components li ul li a').filter(function()
{return this.href==location.href}).parents('ul').addClass('in').siblings('a').attr("aria-expanded","true").parent().addClass('active').siblings().removeClass('active').attr("aria-expanded","flase");

});
</script>
