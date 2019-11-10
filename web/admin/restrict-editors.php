<?php 
$pageTitle = "Enter password";

require_once 'inc/config.inc.php'; 

require_once 'inc/page-header.inc.php'; 

if ($userRole !== 'Admin') {
    redirect_to("dashboard.php");
}

if (!isset($_GET['user_id'])){
  redirect_to('dashboard.php');
}else{
  $user_id = $_GET['user_id'];

  if ($userRole !== 'Admin') {
    if ($_SESSION['user_id'] !== $user_id) {
      redirect_to('dashboard.php');
    }
  }
    
    $user = fetch_user('users', 'id', $user_id);
    if($user){
      extract($user); 
      $user_id = $id;
    }else{
      redirect_to('dashboard.php');
    }

}


?>

<?php 
if (isset($_POST['submit'])) {
    // $user_id = $_GET['user_id'];
    $result = change_user_psw($_POST, $user_id);
    if ($result === true) {
        $msg = true;
        
    } else {
        $errors = $result;
?>
			<?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'SOMETHING WENT WRONG.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
            var i;
            var timer = 0;
            for(i in sweetAlert){
                sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
            timer += + 3;
            }

    function notifyWithToast(type, message, timer) {
        var duration = timer * 1000;
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
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
} ?>


<?php if ( isset($msg
        )): ?>
        <script>

        function notifyWithToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-start',
                showConfirmButton: false,
                timer: 10000
            });

            Toast.fire({
                type: type,
                title: message,
            })
        }
        notifyWithToast('success', 'Password Updated Sucessfully');
    </script> 
    <?php endif; ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?user_id='.$user_id;?>">
  <div class="section-wrapper mg-t-20">
          <label class="section-title">Reset password</label>

            <p class="mg-b-20 mg-sm-b-40">Enter a new password and confirm it.</p>

          <div class="modal-wrapper-demo">
            <div class="modal d-block pos-static">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                  <div class="modal-body pd-0">
                    <div class="row no-gutters">
                      <div class="col-lg-6 bg-primary">
                        <div class="pd-40">
                          <img src="img/model.jpg" />
                        </div>
                      </div><!-- col-6 -->
                      <div class="col-lg-6 bg-white">
                        <div class="pd-y-30 pd-xl-x-30">
                          <div class="pd-x-30 pd-y-10">

                            <h3 class="tx-gray-800 tx-normal mg-b-5">Change User's Password!</h3>
                            <p>Enter a new password and confirm password below</p>
                            <br>

                                <div class="form-group">
                              <input type="password" name="user_password" class="form-control pd-y-12" placeholder="Enter password">
                            </div><!-- form-group -->

                                <div class="form-group">
                              <input type="password" name="confirm_password" class="form-control pd-y-12" placeholder="confirm password">
                            </div><!-- form-group -->

                            <a class="btn btn-primary bd-0" href="#content1">Reset</a>
                            
                            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Reset Password?</p></section><div class="btnn"><button class="btn btn-primary bd-0" type="submit" name="submit">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
                            
                          </div>
                        </div><!-- pd-20 -->
                      </div><!-- col-6 -->
                    </div><!-- row -->
                  </div><!-- modal-body -->
                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div><!-- modal -->
          </div><!-- modal-wrapper-demo -->
        </div><!-- section-wrapper -->
</form>

    <?php require_once 'inc/page-footer.inc.php'; ?>