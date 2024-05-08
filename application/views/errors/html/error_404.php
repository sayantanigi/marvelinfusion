<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
	<title>404 Page Not Found</title>
	<style type="text/css">
		body {
			margin: 0;
		}

		.page_404 {
			height: 100vh;
			background: #fff;
			font-family: 'Arvo', serif;
		}

		.page_404 img {
			width: 100%;
		}

		.four_zero_four_bg {
			background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
			height: 400px;
			background-position: center;
			background-repeat: no-repeat;
		}

		.four_zero_four_bg h3 {
			font-size: 80px;
		}

		.link_404 {
			color: #fff !important;
			padding: 10px 20px;
			background: #39ac31;
			margin: 20px 0;
			display: inline-block;
		}

		.contant_box_404 {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.contant_box_404 h3 {
			margin: 0;
			font-family: "Open Sans";
		}

		.contant_box_404 p {
			margin: 10px 0;
			font-family: "Open Sans";
		}

		.contant_box_404 .link_404 {
			margin: 10px 0;
			border-radius: 50px;
			background: linear-gradient(180deg, rgba(249, 80, 30, 1) 0%, rgba(252, 119, 33, 1) 100%);
			border: 0;
			text-decoration: none;
		}

		.Data_Block {
			height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.Data_Block .Data_Container {
			width: 100%;
		}
	</style>
</head>

<body>
	<section class="page_404">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 ">
					<div class="col-sm-10 col-sm-offset-1 text-center Data_Block">
						<div class="Data_Container">
							<div class="four_zero_four_bg"></div>
							<div class="contant_box_404">
								<h3 class="h2">
									Look like you're lost
								</h3>
								<p>The page you are looking for not avaible!</p>
								<a href="<?php echo config_item('base_url'); ?>" class="link_404">Go to Home</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>