<!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                <h3 style='font-weight:900'>IPHEYA</h3>
                </div>
                <!-- <!---My new side bar-->
                <ul class="list-unstyled components">
                  <li>
                      <a href="dashboard.php">
                          <i class='glyphicon glyphicon-dashboard'></i>
                        Dashboard
                      </a>
                    </li>
                  <li>
                      <a href="allincome.php">
                          <i class='fa fa-line-chart'></i>
                        Income
                      </a>
                    </li>
                  <!-- <li>
                      <a href="employee_training.php">
                          <i class='fa fa-line-chart'></i>
                      Trainees
                      </a>
                    </li> -->
                  <li>
                      <a href="allexpence.php">
                          <i class='fa fa-money'></i>
                        Expense
                      </a>
                    </li>

                  <li>
                      <a href="programs.php">
                          <i class='fa fa-folder-o'></i>
                        Programs
                      </a>
                    </li>
                  <li>
                      <a href="allprojects.php">
                          <i class='fa fa-folder-open-o'></i>
                        Projects
                      </a>
                    </li>
                   <li>
                    <a href="#companyMenu" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">
                      <i class='fa fa-bar-chart-o'></i>
                      Reports
                    </a>
                      <ul class="collapse list-unstyled" id="companyMenu">
                      <li><a  href="financialreports.php">Finacial Reports</a></li>
                      <li><a  href="projectreports.php">Projects Reports</a></li>
                      <li><a  href=".php">Clients Reports</a></li>
                      <li><a  href=".php">Inventory Reports</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="targets.php">
                        <i class='fa fa-arrow-circle-o-down'></i>
                      Targets
                    </a>
                  </li>
                  <li>
                    <a href="../login.php">
                        <i class='fa fa-sign-out'></i>
                      Logout
                    </a>
                  </li>
                </ul>
            </nav>
<!-- Notification Panel Hidden
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
-->
<script>
  $(document).ready(function(){
    //  $(".notification").click(function(){
    //         $(".notification").toggleClass("move");
    //         // $(".notification-container").toggleClass("show-not");
    //         // $(".notification-container").toggleClass("hide-not");
    //         // $("#not").toggleClass("hide-not");
    //         $("#not").toggle(300);
    //         $(".notification-container").toggle(300);
    // });
    $(function()
    {
      $('#sidebar .components li a').filter(function()
      {return this.href==location.href}).parent().addClass('active').css('border-left','3px rgb(169, 176, 187) solid').siblings().removeClass('active').attr("aria-expanded","flase");

      $('#sidebar .components li ul li a').filter(function()
      {return this.href==location.href}).parents('ul').addClass('in').siblings('a').attr("aria-expanded","true").parent().addClass('active').siblings().removeClass('active').attr("aria-expanded","flase");

    });
  });
</script>
