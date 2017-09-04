<?php
				require('core/init.php');
				require('core/logic.php');
				require('core/controllers/target-home-controller.php');
				require('core/controllers/faq-controller.php');
				
    #include('includes/index-head.php');
 ?>
<!DOCTYPE HTML>
<html lang="en-US">

<!-- Mirrored from demo.shapedtheme.com/Ipheya-html/slider/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 May 2017 12:43:17 GMT -->
<head>
	<meta charset="UTF-8">
	<title> home page</title>

	<!-- CSS -->
	<link rel="stylesheet" href="assets/index/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/index/css/font-awesome.min.css" />
	<link rel="stylesheet" href="assets/index/css/style.css" />
 	<!-- COLORS -->
	<link rel="stylesheet" href="assets/index/css/colors/blue.css" title="blue"> <!-- DEFAULT COLOR/ CURRENTLY USING -->
	<link rel="alternate stylesheet" href="assets/index/css/colors/green.css" title="green">
	<link rel="alternate stylesheet" href="assets/index/css/colors/orange.css" title="orange">
	<link rel="alternate stylesheet" href="assets/index/css/colors/purple.css" title="purple">
	<link rel="alternate stylesheet" href="assets/index/css/colors/slate.css" title="slate">
	<link rel="alternate stylesheet" href="assets/index/css/colors/yellow.css" title="yellow">
	<link rel="alternate stylesheet" href="assets/index/css/colors/red.css" title="red">
	<link rel="alternate stylesheet" href="assets/index/css/colors/blue-munsell.css" title="blue-munsell">

	<!-- STYLE SWITCH STYLESHEET ONLY FOR DEMO -->
	<link rel="stylesheet" href="assets/index/demo/demo.css">
	<link rel="stylesheet" href="css/custom.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/index/images/favicon.gif">

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.js"></script>
    <![endif]-->
</head>
<body>
	<div id="st-preloader">
		<div id="pre-status">
			<div class="preload-placeholder"></div>
		</div>
	</div><!-- /#st-preloader -->

	<section id="home-page">
		<div class="container-fluid home-bg" style="padding-top:10px;">

			<div class="row">
				<div class="col-md-12 text-center home-page">
					 <div class="navbar-collapse collapse">
						<div class="col-lg-offset-2 col-md-8">
							<ul class="nav navbar-nav">
								<li><a class="active"  href="#home-page" target="_top">Home</a></li>
								<li><a  href="#service-page" target="_top">Services</a></li>
								<li><a  href="#about-page" target="_top">About-us</a></li>
								<li><a  href="#contact-page" target="_top">Contact-us</a></li>
								<li><a  href="events.php" target="_top">Events</a></li>
								<li><a  href="supports.php" target="_top">Support</a></li>
							</ul>
						</div>
            		</div>
					<div class="main-logo">
						<a href="#"><img src="assets/index/images/logo.gif" alt="" /></a>
					</div>
					<h1>Welcome to</h1>
					<h2>Ipheya IT Solutions</h2>
					<div class="container">

					</div>
					<div class="contact-form">
						<a class="btn btn-primary btn-lg submit-button" href="login.php"  style="font-size:14px; text-transform: capitalize" target="_top"><i class="fa fa-sign-in"></i> Sign-in</a>
						<a class="btn btn-primary btn-lg submit-button" href="client/register.php"  style="font-size:14px; text-transform: capitalize" target="_top"><i class="fa fa-user"></i> Sign-Up </a>
					</div>
					<br/>
					<!-- <p>Subscribe on newsletter Learn first about the launch</p>
					<form id="subscribe" class="form-group subscribe-area">
						<input type="email" name="subscribe-email" id="st-email" class="form-control subscribe-box" placeholder="Enter your email...">
						<button type="submit" name="subscribe-submit" class="btn btn-primary btn-lg submit-bt" >Subscribe</button>
						<br>
						<label for="st-email" class="st-subscribe-message"></label>
					</form> --> 
					<div class="col-sm-12 social-shear text-center">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div><!-- /.social-shear -->
				</div>
			</div>
		</div>
	</section><!-- /#home-page -->

	<section id="service-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="service-title">Who are we?</h1>
					<div class="service-aro-icon">
						<div class="service-aro-left"></div>
							<i class="fa fa-gift"></i>
						<div class="service-aro-right"></div>
					</div>
					<h2>Ipheya IT solution </h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
				</div>
				<div class="col-md-3 col-sm-6 text-center service">
					<i class="fa fa-laptop"></i>
					<h3>Web Projects</h3>
					<p>Lorem ipsum dolor sit amet ectetur sicing elit, sed do eiusmod tempor incididunt ut labore.</p>
				</div>
				<div class="col-md-3 col-sm-6 text-center service">
					<i class="fa fa-picture-o"></i>
					<h3>Graphic Project</h3>
					<p>Lorem ipsum dolor sit amet ectetur sicing elit, sed do eiusmod tempor incididunt ut labore.</p>
				</div>
				<div class="col-md-3 col-sm-6 text-center service">
					<i class="fa fa-rocket"></i>
					<h3>Marketing</h3>
					<p>Lorem ipsum dolor sit amet ectetur sicing elit, sed do eiusmod tempor incididunt ut labore.</p>
				</div>
				<div class="col-md-3 col-sm-6 text-center service">
					<i class="fa fa-shopping-cart"></i>
					<h3>E-Commerce</h3>
					<p>Lorem ipsum dolor sit amet ectetur sicing elit, sed do eiusmod tempor incididunt ut labore.</p>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /#service-page -->

	<section id="about-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="about-title">About Us</h1>
					<div class="service-aro-icon">
						<div class="service-aro-left"></div>
							<i class="fa fa-group"></i>
						<div class="service-aro-right"></div>
					</div>
					<h2>We are creative and young</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
				</div>
				<div class="col-md-4 text-center member">
					<div class="member-img">
						<img src="assets/index/images/slider.png" alt="" />
						<div class="member-social">
							<a class="facebook-icon" href="#"><i class="fa fa-facebook"></i></a>
							<a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a>
							<a class="linkedin-icon" href="#"><i class="fa fa-linkedin"></i></a>
							<a class="google-plus-icon" href="#"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
					<h3>Rubel Miah</h3>
					<span>Lead Developer</span>
				</div>
				<div class="col-md-4 text-center member">
					<div class="member-img">
						<img src="assets/index/images/slider2.png" alt="" />
						<div class="member-social">
							<a class="facebook-icon" href="#"><i class="fa fa-facebook"></i></a>
							<a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a>
							<a class="linkedin-icon" href="#"><i class="fa fa-linkedin"></i></a>
							<a class="google-plus-icon" href="#"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
					<h3>Khalil Uddin</h3>
					<span>Designer</span>
				</div>
				<div class="col-md-4 text-center member">
					<div class="member-img">
						<img src="assets/index/images/slider3.png" alt="" />
						<div class="member-social">
							<a class="facebook-icon" href="#"><i class="fa fa-facebook"></i></a>
							<a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a>
							<a class="linkedin-icon" href="#"><i class="fa fa-linkedin"></i></a>
							<a class="google-plus-icon" href="#"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
					<h3>Shamim Mia</h3>
					<span>Developer</span>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /#about-page -->

	<section id="contact-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form id="main-contact-form" class="contact-form-area text-center" name="contact-form" method="post" action="">
						<h1 class="contact-title">Get in touch</h1>
						<div class="service-aro-icon">
							<div class="service-aro-left"></div>
								<i class="fa fa-envelope"></i>
							<div class="service-aro-right"></div>
						</div>
						<h2>Feel free to contact any query</h2>
						<div class="contact-form">
							<div class="col-sm-5 your-name col-sm-offset-1">
								<div class="form-group">
									<input type="text" name="name" required="required" class="form-control" placeholder="Enter your name...">
								</div>
							</div>
							<div class="col-sm-5 your-email">
								<div class="form-group">
									<input type="email" name="email" class="form-control" required="required" placeholder="Enter your email...">
								</div>
							</div>
							<div class="col-sm-10 your-message col-sm-offset-1">
								<div class="form-group">
									<textarea name="message" id="message" required="required" class="form-control" rows="10" placeholder="Enter your question..."></textarea>
								</div>
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-lg submit-button" >Send</button>
								</div>
							</div>
						</div>
					</form>
					<div class="col-xs-10 col-xs-offset-1">
					<div id="disqus_thread"></div>
					</div>
						
				</div>
			</div><!--/.row-->
		</div><!-- /.container -->
	</section><!-- /#contact-page -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="col-md-12">
						<div class="col-md-12" id="foot">
							<div class="col-md-4">
								<ul>
									<li>Cloud IT Solution</li>
									<li>UPN Solution</li>
									<li>Computing</li>
									<li>IT Support</li>
									<li>IP VNP</li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul>
									<li>Business Uncapped ADSL</li>
									<li>E-Learning</li>
									<li>IT Support</li>
									<li>Sales</li>
									<li>WIFI</li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul>
									<li>Hardware and Software Maintanance</li>
									<li>Internet Solution</li>
									<li>Lease Equipment</li>
									<li>IT Solution</li>
									<li>Confrence</li>
								</ul>
							</div>
						</div>
						<p>&copy; <?=date('Y');?> <strong><a href="#">Ipheya IT Solution</a></strong>. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- /.footer -->

	<!-- JS -->
	<script type="text/javascript" src="assets/index/js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="assets/index/js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="assets/index/js/countdown.js"></script><!-- Countdown -->
	<script type="text/javascript" src="assets/index/js/jquery.backstretch.min.js"></script><!-- Backstretch -->
	<script type="text/javascript" src="assets/index/js/jquery.ajaxchimp.js"></script><!-- ajaxchimp -->
	<script type="text/javascript" src="assets/index/js/scripts.js"></script><!-- Scripts -->

	<!-- =========================================================
	     STYLE SWITCHER | ONLY FOR DEMO NOT INCLUDED IN MAIN FILES
	============================================================== -->
	<script type="text/javascript" src="assets/index/demo/styleswitcher.js"></script>
	<script type="text/javascript" src="assets/index/demo/demo.js"></script>

	<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://ipheya.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                           
</body>
</html>
