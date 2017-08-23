<!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    
                    <h3 style='font-weight:900'>IPHEYA</h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i>
                            Account
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="CreateTicket.php">Report Faults</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li><a href="meeting-booking.php">Book a meeting</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Make Payaments
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-duplicate"></i>
                            Request
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="request.php#MR" data-toggle="tab">Maintanance</a></li>
                            <li><a href="request.php#SR" data-toggle="tab">Service</a></li>
                            <li><a href="request.php#MR">Survey</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-link"></i>
                            History
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="contact.php">
                            <i class="glyphicon glyphicon-send"></i>
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href='../login.php'>
                            <i class='glyphicon glyphicon-log-out'></i>
                            Logout
                        </a>
                    </li>
                </ul>
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
