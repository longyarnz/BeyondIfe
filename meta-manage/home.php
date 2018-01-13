<!DOCTYPE html>
<html>
	<head>
		<meta lang="en">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link href="favicon.ico" rel="icon" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<title>Meta-manage</title>
	</head>
	<body>

		<header title="Click Here to Open Navigation Menu" class="no-display">
			<h4>
				<i class="fa fa-bars"></i>
				<span>Navigation Menu</span>
			</h4>
			<div class="update-bar"></div>
		</header>

		<nav>
			<ul>
				<li>
					<a class="" data-nav="start">
						<span>*</span>Start Page
					</a>
				</li>
				<li>
					<a class="" data-nav="logout">
						<span>*</span>Logout
					</a>
				</li>			
			</ul>
		</nav>

		<section class="section-top">
			<div class="block-content poster" data-id="1" data-nav="start">
				<div class="block block-backdrop-1">
					<div class="ajax-result"></div>
					<h1>Enter Access Codes</h1>
					<form class="" role="access-form" method="post" enctype="multipart/form-data" autocomplete="off">
						<div data-input="1">
							<label data-input="1">Username</label>
							<input type="text" placeholder="Enter Your Username" name="input 1" required data-input="1">
						</div>	
						<div data-input="2">
							<label data-input="2">Password</label>
							<input type="password" name="input 2" placeholder="Enter Your Password" required data-input="2">
						</div>
						<div>
							<button type="submit" role="submit">Submit</button>
						</div>
						<div class="ajax-background"><span>Request Completed</span><div class="ajax-progress"></div></div>
					</form>
					<div class="notification no-display dim-opacity">
						Click The <br><span class="notify">Navigation Menu</span> <i class="fa fa-bars"></i><br> To Access Your Content.<br>
						<span class="smiley">☺</span>
					</div>
				</div>
			</div>			
		</section>

		<script src="js/jquery.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/animate-home.js"></script>
		<script src="js/animate-nav.js"></script>
		<script src="js/animate-connect.js"></script>
		<script src="js/animate-form.js"></script>
	</body>
</html>