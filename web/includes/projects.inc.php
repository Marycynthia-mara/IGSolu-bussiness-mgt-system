<!-- services -->
	<div class="services" id="services">
		<div class="container">
		<h3 class="heading">Services</h3>
			<div class="agileits-services">
				<div class="services-right-grids">
					<div class="col-sm-3 services-right-grid">
						<div class="services-icon hvr-radial-in">
							<i  class="fa fa-camera" aria-hidden="true"></i>
						</div>
						<div class="services-icon-info">
							<h5>CCTV and IP Camera</h5>
							<p>sales and installation all kinds of CCTV security cameras, like out door, indoors and spy cameras</p>
						</div>
					</div>
					<div class="col-sm-3 services-right-grid">
						<div class="services-icon hvr-radial-in">
							<i  class="fa fa-phone" aria-hidden="true"></i>
						</div>
						<div class="services-icon-info">
							<h5>Hybrid Intercom Systems</h5>
							<p>Hybrid IP PBX/PABX/VOIP Intercoms installation help enhance internal communication in your home or work place.</p>
						</div>
					</div>
					<div class="col-sm-3 services-right-grid">
						<div class="services-icon hvr-radial-in">
							<i  class="fa fa-key" aria-hidden="true"></i>
						</div>
						<div class="services-icon-info">
							<h5>Access Control System</h5>
							<p>Lorem ipsum dolor sit amet, Sedet adipiscing elit. Sed orci enim, posuere sed tincidunt et.</p>
						</div>
					</div>
					<div class="col-sm-3 services-right-grid">
						<div class="services-icon hvr-radial-in">
							<i class="fa fa-lightbulb-o" aria-hidden="true"></i>
						</div>
						<div class="services-icon-info">
							<h5>Solar and Inverter Energy</h5>
							<p>We offer solar energy installation, hybrid inverter and Charge control systems for 24/7 power supply</p>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
<div class="gallery" id="gallery">
	<div class="container">
		<h3 class="heading">Products</h3>
	</div>
			<ul id="flexiselDemo1">	

				<?php 
					$products = fetch_column3('products', 'add_date');
					$prodStr = 'prod';
					$counter = 1;
				 ?>

				 <?php if (count($products) === count($products, COUNT_RECURSIVE)) {
				 	extract($products);
				  ?>
				<li>
					<div class="wthree_gallery_grid">
						<a href="<?php echo 'admin/'.$product_img_path ?>" class="lsb-preview" data-lsb-group="header">
							<div class="view second-effect">
								<img src="<?php echo 'admin/'.$product_img_path ?>" alt="" class="img-responsive" />
								<div class="mask" ondblclick='showProduct(<?php echo '"'.'myModal'.$prodStr.$counter . '"'?>)'>
								<!-- onmouseover='showProduct(<?php echo '"'.'myModal'.$prodStr.$counter . '", "' . 'Productsubj'.$prodStr.$counter . '", "' . 'ProjectBody'.$prodStr.$counter . '", "' . 'Projectimg'.$prodStr.$counter . '", "' . 'prodSubj'.$prodStr.$counter . '", "' .'prodBody'. $prodStr.$counter . '", "' .'prodImg'. $prodStr.$counter . '"'; ?>);'' -->
									<h6 style="padding-top: 0px;"><?php echo $product_name ?></h6>
									
									<p><?php echo substr($product_desc, 0, 90) ?></p>
									<p><a class="btn btn-primary btn-sm mg-b-10" href="tel:+2347036596848">BUY NOW</a></p>
								</div>
							</div>	
						</a>
					</div>
				</li>

				<!-- bootstrap-modal-pop-up -->
					<div id="overlay<?php echo$prodStr.$counter ?>">
						<div class="modal fade" id="myModal<?php echo $prodStr.$counter ?>" tabindex="-1" role="dialog" aria-labelledby="myModal" style="z-index: 2000000">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										 <p id="Productsubj<?php echo$prodStr.$counter ?>"><?php echo $product_name ?></p>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
									</div>
										<div class="modal-body">
											<img id="Projectimg<?php echo$prodStr.$counter ?>" src="admin/<?php echo $product_img_path ?>" alt=" " class="img-responsive" />
											<p id="ProjectBody<?php echo$prodStr.$counter ?>" class="text-justify"><?php echo $product_desc ?><br>

												<i><b>Our Motto: Delivering quality service to a greater number...</b></i></p>
										</div>
								</div>
							</div>
						</div>
					</div>	
					<!-- //bootstrap-modal-pop-up --> 

				 <?php }else{ ?> 
				 	<?php foreach ($products as $product): 
				 	extract($product);
				 	?>
				 	<li>
						<div class="wthree_gallery_grid">
							<a href="<?php echo 'admin/'.$product_img_path ?>" class="lsb-preview" data-lsb-group="header">
								<div class="view second-effect">
									<img src="<?php echo 'admin/'.$product_img_path ?>" alt="" class="img-responsive" />
									<div class="mask" ondblclick='showProduct(<?php echo '"'.'myModal'.$prodStr.$counter . '"'?>)'>
										<h6 style="padding-top: 0px;"><?php echo $product_name ?></h6>
										
										<p><?php echo substr($product_desc, 0, 90) ?></p>
										<p><a class="btn btn-primary btn-sm mg-b-10" href="tel:+2347036596848">BUY NOW</a></p>
									</div>
								</div>	
							</a>
						</div>
					</li>

					<!-- bootstrap-modal-pop-up -->
					<div id="overlay<?php echo$prodStr.$counter ?>">
						<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModal" style="z-index: 2000000">
							<div class="modal-dialog" role="document">
								<div class="modal-content" id="myModal<?php echo $prodStr.$counter ?>">
									<div class="modal-header">
										 <p id="Productsubj<?php echo$prodStr.$counter ?>"><?php echo $product_name ?></p>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
									</div>
										<div class="modal-body">
											<img id="Projectimg<?php echo$prodStr.$counter ?>" src="admin/<?php echo $product_img_path ?>" alt=" " class="img-responsive" />
											<p id="ProjectBody<?php echo$prodStr.$counter ?>" class="text-justify"><?php echo $product_desc ?><br>

												<i><b>Our Motto: Delivering quality service to a greater number...</b></i></p>
										</div>
								</div>
							</div>
						</div>
					</div>	
					<!-- //bootstrap-modal-pop-up --> 

				 	<?php 
				 	$counter++;
				 	endforeach ?>
				 <?php } ?>

		</ul>
	</div>
<!--//gallery-->
		
<!-- blog -->
	<div class="blog" id="blog">
		<div class="container">
			<h3 class="heading" id="ourProjects">Our Projects</h3>
			<div class="agile_inner_w3ls-grids">
				
					<?php
						$total_rows = fetch_column7('projects');
						$row_count = 0;
						foreach ($total_rows as $total_row) {
							$row_count++;
						}
						$total_rows = $row_count;

				        if (isset($_GET['pageno'])) {
				            $pageno = $_GET['pageno'];
				        } else {
				            $pageno = 1;
				        }
				        $no_of_records_per_page = 2;
				        $offset = ($pageno-1) * $no_of_records_per_page;

				        global $conn;
				        $total_pages_sql = "SELECT COUNT(*) FROM projects";
				        $total_pages = ceil($total_rows / $no_of_records_per_page);

				        $sql = "SELECT * FROM projects ORDER BY add_date DESC LIMIT $offset, $no_of_records_per_page ";

				        $res_data = mysqli_query($conn,$sql);
				        // while($row = mysqli_fetch_array($res_data)){
				         ?>
				            <?php 
					$projects = fetch_column12('projects', 'users', 'add_date', $offset, $no_of_records_per_page);
					$counter = 1;
				 ?>

				 <?php if (count($projects) === count($projects, COUNT_RECURSIVE)) {
				 	extract($projects);
				  ?>
				 	<div class="col-sm-6 w3-agile-post-grids">
						<div class="w3-agile-post-img w3-agile-post-img2">
							<a href="#" data-toggle="modal" data-target="#myModal<?php echo $counter ?>"> 
							<img src="<?php echo 'admin/'.$project_img_path ?>" class="img-responsive">
							</a>
						</div>
						<div class="w3-agile-post-info">
							<h4><a href="#" data-toggle="modal" data-target="#myModal<?php echo $counter ?>"><?php echo $project_name ?></a></h4>
							<p><?php echo $project_desc ?></p>
							<ul>
								<li style="margin-right: 20px;">By <a href="#"><?php echo ucfirst($firstname).' '.ucfirst($lastname); ?></a></li>
								<li>
									<?php $date = format_date($add_date) ?>
									<?php echo $date ?></li>
							</ul>
						</div>
					</div>

					<!-- bootstrap-modal-pop-up -->
						<div class="modal video-modal fade" id="myModal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										 <?php echo $project_name ?>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
									</div>
										<div class="modal-body">
											<img src="admin/<?php echo $project_img_path ?>" alt=" " class="img-responsive" />
											<p class="text-justify"><?php echo $project_desc ?><br>

												<i><b>Our Motto: Delivering quality service to a greater number...</b></i></p>
										</div>
								</div>
							</div>
						</div>
					<!-- //bootstrap-modal-pop-up --> 

				 <?php }else{ ?> 
				 	<?php foreach ($projects as $project): 
				 	extract($project);
				 	?>
				 		<div class="col-sm-6 w3-agile-post-grids" style="margin-top: 50px;">
							<div class="w3-agile-post-img w3-agile-post-img2">
								<a href="#" data-toggle="modal" data-target="#myModal<?php echo $counter ?>"> 
								<img src="<?php echo 'admin/'.$project_img_path ?>" class="img-responsive">
								</a>
							</div>
							<div class="w3-agile-post-info">
								<h4><a href="#" data-toggle="modal" data-target="#myModal<?php echo $counter ?>"><?php echo $project_name ?></a></h4>
								<p><?php echo $project_desc ?></p>
								<ul>
									<li style="margin-right: 20px;">By <a href="#"><?php echo ucfirst($firstname).' '.ucfirst($lastname); ?></a></li>
									<li>
									<?php $date = format_date($add_date) ?>
									<?php echo $date ?></li>
								</ul>
							</div>
						</div>


						<!-- bootstrap-modal-pop-up -->
							<div class="modal video-modal fade" id="myModal<?php echo $counter ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											 <?php echo $project_name ?>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
										</div>
											<div class="modal-body">
												<img src="admin/<?php echo $project_img_path ?>" alt=" " class="img-responsive" />
												<p class="text-justify"><?php echo $project_desc ?><br>

													<i><b>Our Motto: Delivering quality service to a greater number...</b></i></p>
											</div>
									</div>
								</div>
							</div>
						<!-- //bootstrap-modal-pop-up --> 

				 	<?php 
				 	$counter++;
				 	endforeach ?>
				 <?php } ?>
				       <?php
				        // }
				        // mysqli_close($conn);
				    ?>
				    
				<div class="clearfix"> </div>
			</div>

					<ul class="pagination">
				        <li><a href="?pageno=1">First</a></li>
				        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
				            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
				        </li>
				        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
				            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
				        </li>
				        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
				    </ul>

		</div>
	</div>
<!-- //blog -->

<!-- contact -->

<?php
	
	if(isset($_POST['contact'])){
		$result = send_us_a_mail($_POST);
		extract($_POST);
			if($result === true){
				$msg = true;
			} else {
				$errors = $result;
		?>
			<?php if ($errors) { ?>
				<script type="text/javascript">
					var err_heading = 'CONTACT ERROR.';
					<?php require_once 'sweet-alert-err.inc.php' ?>
				</script>


		<?php } ?>
		<?php
			}
		}	
		?>


		<?php if ( isset($msg
			)): ?>

		<script type="text/javascript">
			var success_msg = 'Mail Sent.';
			<?php require_once 'sweet-alert-succ.inc.php' ?>
		</script> 

		<?php endif; ?>

<div class="contact" id="contact">
	<div class="container">
		<h3 class="heading">contact us</h3>
	</div>
	<div class="contactright1">
		<p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>26 One-Day Road, Off Agbani Road, Enugu Nigeria.</p>
		<p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span><a class="media" href="tel:+2347036596848">+2347036596848</a></p>
		<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:idealgadgetsolutions@gmail.com">idealgadgetsolutions@gmail.com</a></p>
	</div>
</div>	
<div class="contactform">
		<div class="container">
		<h3 class="heading">Mail us</h3>
			<div class="agileits_agile_about_mail" id="contact">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col-md-6 agileits_agile_about_mail_left">
						<label>Full Name</label>
                                <input required style="border-right:5px solid <?php if(isset($name_err)){echo 'red';}else{ echo 'green';} ?>;" class="form-control" type="text" name="name" value="<?php if(isset($_POST['name']))echo $_POST['name'] ?>">
                                <?php if (isset($name_err)) { ?>
                                <p style="color: red; margin-bottom: 7px;"><?php echo $name_err; ?></p>
                                <?php  }?>
					<div class="clearfix"> </div>
					</div>
					<div class="col-md-6 agileits_agile_about_mail_left">
						<label>Email</label>
                                <input required style="border-right:5px solid <?php if(isset($email_err)){echo 'red';}else{ echo 'green';} ?>;" class="form-control" type="text" name="email" value="<?php if(isset($_POST['email']))echo $_POST['email'] ?>">
                                <?php if (isset($email_err)) { ?>
                                <p style="color: red; margin-bottom: 7px;"><?php echo $email_err; ?></p>
                                <?php  }?>
					<div class="clearfix"> </div>
					</div>
					<div class="col-md-6 agileits_agile_about_mail_left">
						<label>Phone Number</label>
                                <input required style="border-right:5px solid <?php if(isset($phone_err)){echo 'red';}else{ echo 'green';} ?>;" class="form-control" type="text" name="phone" value="<?php if(isset($_POST['phone']))echo $_POST['phone'] ?>">
                                <?php if (isset($phone_err)) { ?>
                                <p style="color: red; margin-bottom: 7px;"><?php echo $phone_err; ?></p>
                                <?php  }?>
					<div class="clearfix"> </div>
					</div>
					<div class="col-md-6 agileits_agile_about_mail_left">
						<label>Subject</label>
                                <input required style="border-right:5px solid <?php if(isset($subject_err)){echo 'red';}else{ echo 'green';} ?>;" class="form-control <?php if(isset($subject_err)){echo 'error';}else{ echo 'green';} ?>" type="text" name="subject" value="<?php if(isset($_POST['subject']))echo $_POST['subject'] ?>">
                                <?php if (isset($subject_err)) { ?>
                                <p style="color: red; margin-bottom: 7px;"><?php echo $subject_err; ?></p>
                                <?php  }?>
					<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
					<div class="col-md-12 agileits_agile_about_mail_left">
						<label>Write Message</label>
                            <textarea required style="height: 200px; resize: none; border-right:5px solid <?php if(isset($message_err)){echo 'red';}else{ echo 'green';} ?>" class="form-control" name="message"><?php if(isset($_POST['message']))echo $_POST['message'] ?></textarea>
                            <?php if (isset($message_err)) { ?>
                                <p style="color: red; margin-bottom: 7px;"><?php echo $message_err; ?></p>
                                <?php  }?>
					<div class="clearfix"> </div>
					</div>
					 
					<div class="submit">
						<input type="submit" value="Submit" name="contact">
					</div>
				</form>
			</div>
		</div>
</div>
<!-- //contact -->

<!-- login -->
	<div class="modal video-modal fade" id="loginPop" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					 Ideal Login
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>

						<?php 

							if (isset($_POST['login'])) {
								$result = login_user($_POST);
							    extract($_POST);
							    if ($result === true) {
							        redirect_to('admin/dashboard.php');
							    }else {
							        $errors = $result;
										?>
							      <?php if ($errors) { ?>
								      <script type="text/javascript">
								      	var err_heading = 'SIGN IN ERROR.';
								        <?php require_once 'sweet-alert-err.inc.php' ?>
								      </script>  

							<?php } ?>
							<?php
							    }
							}

						?>


					<!-- bootstrap-modal-pop-up -->
							<!-- <div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											 Ideal Gadget Solutions
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
										</div>
											<div class="modal-body">
												<img src="images/header.jpg" alt=" " class="img-responsive" />
												<p class="text-justify">Ideal Gadgets Solutions is a duly registered and recognized Security and Communication Technology firm that manufactures, supply, install Solar panels, Inverters, IP CCTV, Electronic locks (access control), Hybrid Intercom, Wi-Fi, Fire Alarms, Laptops sales, Printers, Copiers for hotels, banks, offices, schools, supermarkets, fuel stations, and public places, among others. We are able to carry out the business of information technology, security systems, allied technologies, data analysis and forecasting. The drive to achieve excellence motivates us to constantly strive to offer world class solutions. Our success in the industry is essentially due to our understanding of client’s objectives and from this base implement elegant and cost effective solution. We stand for Durability, Affordability and Security.<br>

													<i><b>Motto: Delivering quality service to a greater number...</b></i></p>
											</div>
									</div>
								</div>
							</div> -->
						<!-- //bootstrap-modal-pop-up --> 	

					<div class="modal-body">
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<div class="col-md-12 agileits_agile_about_mail_left">
								<label>Email</label>
		                                <input style=" margin-bottom: 20px; border-right:5px solid <?php if(isset($errors['email_err'])){echo 'red';}else{ echo 'green';} ?>;" class="form-control" type="text" name="email" value="<?php if (isset($email)) {
                    									echo $email;
               										} ?>">
		                                <?php if (isset($errors['email_err'])) { ?>
		                                <p style="color: red; margin-bottom: 7px;"><?php echo $errors['email_err']; ?></p>
		                                <?php  }?>
							<div class="clearfix"> </div>
							</div>					 
							<div class="col-md-12 agileits_agile_about_mail_left">
								<label>Password </label>
		                                <input style="margin-bottom: 20px; border-right:5px solid <?php if(isset($errors['password_err'])){echo 'red';}else{ echo 'green';} ?>;" class="form-control" type="password" name="password" value="">
		                                <?php if (isset($errors['password_err'])) { ?>
		                                <p style="color: red; margin-bottom: 7px;"><?php echo $errors['password_err']; ?></p>
		                                <?php  }?>

		                                <?php if (isset($errors['login_err'])) { ?>
		                                <p style="color: red; margin-bottom: 7px;"><?php echo $errors['login_err']; ?></p>
		                                <?php  }?>

							<div class="clearfix"> </div>
							</div>
							<div class="submit">
								<input class="btn btn-primary" type="submit" value="Login" name="login">
							</div>
						</form>

					</div>
			</div>
		</div>
	</div>
<!-- login end -->

<!-- copyright -->
<div class="wthree_copy_right">
	<div class="container">
		<p>&copy; 2019 <?php if (intval(date('Y')) > 2019) {
        echo  " - " . date('Y'); } ?> IG-SOLUTIONS. All rights reserved | Design by <a href="tel:+2349063399674">Marycynhia Amarachi Ugwu</a></p>
			
	</div>
</div>
<!-- //copyright -->


</body>
</html>

