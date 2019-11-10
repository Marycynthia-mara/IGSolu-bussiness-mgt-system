<?php 
$pageTitle = "Add Editors";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 

if ($userRole !== 'Admin') {
    redirect_to("dashboard.php");
}
?>


<?php 

  if (isset($_POST['submit'])) {
                $result = add_user($_POST);
                  extract($_POST);
                  if ($result === true) {
                      $msg = true;
                  }else {
                      $errors = $result;
                    ?>
                    <?php if ($errors) { ?>
                      <script type="text/javascript">
                        var err_heading = 'SIGN UP ERROR.';
                            var sub_heading_err = '<h4>' + 'Read the below stated issue(s).' + '</h4>'
                            var sweetAlert = <?php echo json_encode($errors); ?>;
                             var allAlerts = '<p style="color:#F27474;text-align:center; font-size:200px;"><b>' + '<h2 style="text-align:center;color:#F27474;">' + err_heading + '</h2>'  + '<br>' + sub_heading_err + '</b></p>';
                            var i;
                            var timer = 0;
                                for(i in sweetAlert){
                                    sweetAlert[i] = '<h4 style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</h4>';
                                    allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
                                    timer += + 3;
                                    }      

                            function notifyWithToast(type, message, timer) {
                                var duration = timer * 2000;
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'center',
                                    showConfirmButton: true,
                                    timer: duration
                                });

                                Toast.fire({
                                    type: type,
                                    // title: 'Something went wrong',
                                    html: '<p>' + message + '</p>'
                                })
                            }
                            notifyWithToast('error', allAlerts, timer);
                        </script>    

              <?php } ?>
              <?php
                  }
              }

            ?>            


<?php if ( isset($msg
	)): ?>
    <script type="text/javascript">
      var success_msg = 'Sign Up successful.';
      function notifyWithToast(type, message) {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'center',
                  showConfirmButton: false,
                  timer: 10000
              });

              Toast.fire({
                  type: type,
                  title: message,
              })
          }
          notifyWithToast('success', success_msg);
      </script>     
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	 <div class="section-wrapper mg-t-20">
          <label class="section-title">Editor Sign Up Form</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4 <?php if (isset($errors['firstname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group">
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" value="<?php if (isset($firstname)) {
									              echo $firstname;
									          } ?>" name="firstname" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['lastname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="lastname" value="<?php if (isset($lastname)) {
									              echo $lastname;
									          } ?>" placeholder="Enter lastname">
                </div>   
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['password'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="password" value="" placeholder="Enter Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['password2'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Confirm Password : <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="password2" value="<?php if (isset($password2)) {
									              echo $password2;
									          } ?>" placeholder="Confirm Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['email']) OR isset($errors['dup_email_studt']) OR isset($errors['email_sanitize'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email : <span class="tx-danger">*</span></label>
                  <input class="form-control " type="email" value="<?php if (isset($email)) {
									              echo $email;
									          } ?>" name="email" placeholder=" Email">
                </div>
              </div><!-- col-4 -->
            	 <div class="col-md-4 mg-t--1 mg-md-t-0 gender <?php if (isset($errors['gender'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gender :<span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="form-check">
					<div class="gender" style="float: left;">
						<input type="radio" name="gender" class="form-check-input" id="Smale" value="male">
						<label class="form-check-label" for="Smale">Male</label>
					</div> 
					<div class="gender" style="float: right;">
						<input type="radio" name="gender" class="form-check-input" id="Sfemale" value="female">
						<label class="form-check-label" for="Sfemale">Female</label>
					</div> 				
				</div>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['tel'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Enter Phone No : <span class="tx-danger">*</span></label>
                  <input class="form-control tel" type="number" name="tel" value="<?php if (isset($tel)) {
									              echo $tel;
									          } ?>" placeholder="Phone No">
                </div>
              </div><!-- col-4 -->
          </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
            <a class="btn btn-primary bd-0" href="#content1">Sign Up</a>  
            </div><!-- form-group -->

            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">IDEAL SIGN UP.</h1><section><p>Are you sure you want to sign up this Editor?</p></section><div class="btnn"><input class="btn btn-primary bd-0 popUp" type="submit" name="submit" value="Proceed"><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>                                  

          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>