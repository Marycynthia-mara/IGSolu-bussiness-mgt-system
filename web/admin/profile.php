<?php 
$pageTitle = "Profile";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php 
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
        <div class="row row-sm">
          <div class="col-lg-8">
            <div class="card card-profile">
              <div class="card-body">
                <div class="media">
                  <img style="background: url(<?php echo $profile_img_path; ?>); background-size: cover; width: 150px; height: 150px; border-radius: 100%; background-position-x: 57.667%" src="<?php if(isset($profile_img_path)){
                    echo "$profile_img_path";
                    }else{
                      echo "http://via.placeholder.com/500x500";
                    } ?>" alt="">
                  <div class="media-body">
                    <h3 class="card-profile-name"><?php echo ucfirst($firstname) ." ". ucfirst($lastname);  ?></h3>
                    <p class="card-profile-position">

                      <?php if ($role === '1') {
                      echo "The Administrator of ideal gadgets solution.";
                    }else{
                      echo "An Editor of ideal gadgets solution.";
                      } ?>

                    </p>

                    <p class="mg-b-0">
                      
                    </p>
                  </div><!-- media-body -->
                </div><!-- media -->
              </div><!-- card-body -->
              <div class="card-footer">
                <div>
                  <a href="edit-profile.php?user_id=<?php echo $user_id; ?>">Edit Profile</a>
                </div>
              </div><!-- card-footer -->
            </div><!-- card -->

          <form method="post" action="upload.php" enctype="multipart/form-data">
            <ul class="nav nav-activity-profile mg-t-20">
              <li class="nav-item">
                <label for="upload" class="nav-link"><i class="icon ion-ios-redo tx-purple"></i>Browse Picture</label><input id="upload" type="file" name="profile_img" style="display: none;"><input type="hidden" name="userid" value="<?php echo "$user_id"?>">
              </li>
              <li class="nav-item"><a href="" class="nav-link">
                <input type="submit" name="submit" value="Upload Profile Picture" class="form-control button"></a>
              </li>
            </ul><!-- nav -->
          </form>

           <?php if (isset($_SESSION['err_msg'])): ?>
                    
                   <?php if ($_SESSION['err_msg'] === true):  ?>
                    <?php $_SESSION['err_msg'] = false; ?>
                      <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Ensure you browse a picture before you upload
                    </div><!-- alert -->
                   <?php 
                   endif; ?>
                    
                  <?php endif ?>

            <div class="card card-latest-activity mg-t-20">
              <div class="card-body">

                <div class="row no-gutters">
                  <div class="col-md-4">
                    <a href=""><img src="img/glad.png" class="img-fit-cover" alt=""></a>
                  </div><!-- col-4 -->

                  <?php if($role === '1'):?>
                    <div class="col-md-8">
                        <div class="post-wrapper">
                          <a href="" class="activity-title">Basic Information You Need To Know</a>
                          <p>As a administrator You manage the whole system.</p>
                          <p>An administrator does the Adding, Updating and deleting function of the system, Basically all the major operation is performed by the administrators</p>
                        </div><!-- post-wrapper -->
                      </div><!-- col-8 -->
                  <?php endif; ?>

                  <?php if($role === '0'):?>
                    <div class="col-md-8">
                        <div class="post-wrapper">
                          <a href="" class="activity-title">Basic Information You Need To Know</a>
                          <p>As a Editor You manage the specified part system.</p>
                          <p>An Editor does the Editing, Updating and some other functions and priviledges granted by the administrator</p>
                        </div><!-- post-wrapper -->
                      </div><!-- col-8 -->
                  <?php endif; ?>

                </div><!-- row -->

              </div><!-- card-body -->
            </div><!-- card -->

          </div><!-- col-8 -->

          <div class="col-lg-4 mg-t-20 mg-lg-t-0">

          <?php if ($role === '1' or $role === '2'){ ?> 

            <div class="card card-people-list mg-t-20" style="max-height: 450px; overflow: scroll; margin-top: 0;">

              <div class="slim-card-title">Your Contacts</div>
            
              <div class="media-list">

                <?php $Contacts = fetch_column3('contact', 'contact_name'); 
                ?>

                <?php if (is_array($Contacts)) { ?>
                    <?php if ($userRole === 'Admin'): ?>
                     <?php foreach ($Contacts as $Contact): ?>
                      <?php extract($Contact); ?>
                      <div class="media">
                      
                      <div class="media-body">
                        <a><?php echo ucfirst($contact_name) ?></a>
                      </div><!-- media-body -->
                      <a href="mailto:<?php if(isset($contact_email)){
                        echo $contact_email;
                      } ?>"><i class="icon ion-ios-email-outline tx-20" style="padding-right: 15px;"></i></a>
                      <a href="tel:<?php if(isset($contact_phone)){
                        echo $contact_phone;
                      } ?>"><i class="icon ion-ios-telephone-outline tx-20"></i></a>
                    </div><!-- media -->      
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php } ?> 

                          
              </div><!-- media-list -->
            </div><!-- card -->
            <?php }
            ?>

            <div class="card pd-25 mg-t-20">
              <div class="slim-card-title">My Contact</div>

              <div class="media-list mg-t-25">
                
                <div class="media mg-t-25">
                  <div><i class="icon ion-ios-telephone-outline tx-24 lh-0"></i></div>
                  <div class="media-body mg-l-15 mg-t-4">
                    <h6 class="tx-14 tx-gray-700">Phone Number</h6>
                    <?php if ($userRole === 'Admin'): ?>
                      <a href="tel:<?php if(isset($phone)){
                          echo $user['phone'];
                        } ?>"><?php if(isset($phone)){
                          echo $user['phone'];
                        } ?></a>
                    <?php endif ?>

                    
                  </div><!-- media-body -->
                </div><!-- media -->
                <div class="media mg-t-25">
                  <div><i class="icon ion-ios-email-outline tx-24 lh-0"></i></div>
                  <div class="media-body mg-l-15 mg-t-4">
                    <h6 class="tx-14 tx-gray-700">Email Address</h6>
                    <a href="mailto:<?php if(isset($email)){
                    echo $user['email'];
                  } ?>"><?php if(isset($email)){
                    echo $user['email'];
                  } ?></a>
                  </div><!-- media-body -->
                </div><!-- media -->
                
              </div><!-- media-list -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div><!-- row -->

      </div><!-- container -->
    </div><!-- slim-mainpanel -->

    <?php require_once 'inc/page-footer.inc.php'; ?>
  </body>
</html>
