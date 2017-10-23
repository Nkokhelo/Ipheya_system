<!-- Sidebar Holder -->
<nav id="sidebar">
<div class="sidebar-header">
    <h3 style='font-weight:900'>IPHEYA</h3>
</div>

                <ul class="list-unstyled components">
                    <li class="active"><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-user-circle-o"></i>
                            Account
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="profile.php">My profile</a></li>
                            <li><a href="security.php">Security</a></li>
                            <li><a href="my_order.php">My Order</a></li>
                            <li><a href="CreateTicket.php">Report Faults</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li><a href="meeting-booking.php">Book a meeting</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="payments.php"><i class="fa fa-money"></i> Payments </a>
                    </li>
                    <li>
                        <a href="request.php"><i class="fa fa-clipboard"></i> Request</a>
                    </li>
                    <li>
                        <a href="history.php">
                            <i class="fa fa-history"></i>
                            History
                        </a>
                    </li>
                    <li>
                        <a href="rateus.php">
                            <i class="fa fa-star-o"></i>
                            Rate Us
                        </a>
                    </li>
                    <li>
                        <a href="events.php">
                            <i class="fa fa-calendar-check-o"></i>
                            Events
                        </a>
                    </li>
                    <li>
                        <a href='../login.php'>
                            <i class="fa fa-sign-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
                <div class="" align="center">
                  <button class="btn btn-primary" onclick="on();">Chat <span class="glyphicon glyphicon-comment"></span></button>
                </div>
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
$(document).ready(function(){
$(function()
{
$('#sidebar .components li a').filter(function()
{return this.href==location.href}).parent().addClass('active').css('border-left','3px rgb(169, 176, 187) solid').siblings().removeClass('active').attr("aria-expanded","flase");

$('#sidebar .components li ul li a').filter(function()
{return this.href==location.href}).parents('ul').addClass('in').siblings('a').attr("aria-expanded","true").parent().addClass('active').siblings().removeClass('active').attr("aria-expanded","flase");

});
});
function show()
{
$(".notification-container").toggle();
$(".notif").load("/ipheya/core/sub/notifications.php?load=<?php echo($_SESSION['Client']) ?>");
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
              data: "count=<?php echo($_SESSION['Client']);?>",
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
</script>
