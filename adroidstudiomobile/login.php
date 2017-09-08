<?php
 #21539288 POLELA AL
 include('includes/header.php');
 require_once('components/processes/init.php');
 include('components/processes/login-handler.php')
 ?>
  <body id="login-main">
    <div class="container-fluid" id="login-wrap">
      <div class="col-sm-12" id="login-html">
        <label for="tab-1" class="tab">Sign In</label>
        <form class="form" id="sign-in-htm" action="" method="post">
          <div class="form-group">
            <input type="email" class="form-control" id="text-box" name="email" value="" placeholder="email....">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="text-box" name="password" value="" placeholder="password....">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-info" id="button" name="Login" value="sign in">
          </div>
        </form>
        <div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">&copy; IPHEYA 2017</a>
				</div>
      </div>
    </div>
  </body>
</html>
