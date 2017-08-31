<!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3 style='font-weight:900'>IPHEYA</h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-user-circle-o"></i>
                            Account
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="home.php">dashboard</a></li>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="CreateTicket.php">Report Faults</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li><a href="meeting-booking.php">Book a meeting</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-money"></i>
                            Make Payaments
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-clipboard"></i>
                            Request
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="request.php#MaintananceR">Maintanance</a></li>
                            <li><a href="request.php#ServiceR">Service</a></li>
                            <li><a href="request.php#SurvetyR">Survey</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="history.php">
                            <i class="fa fa-history"></i>
                            My history
                        </a>
                    </li>
                    <li>
                        <a href="service-ratings.php">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            Services blog
                        <a href="#faq.php">
                            <i class="fa fa-send-o"></i>
                            FAQ
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
                  <button class="btn btn-primary" onclick="on();">Start chat <span class="glyphicon glyphicon-comment"></span></button>
                </div>
            </nav>
            </nav>
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

</script>
