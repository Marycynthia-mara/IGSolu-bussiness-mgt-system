<?php 
$pageTitle = "Dashboard";
require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 

?>

        <?php   
         
          $totalUsers = fetch_column2('role', 'users', '2');
          // fetch_column3('users', 'id');
          $totalProjects = fetch_column3('projects', 'project_id');
          $totalProducts = fetch_column3('products', 'product_id');
          $totalContacts = fetch_column3('contact', 'contact_id');

         ?>
        <div class="row row-xs">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                  <?php 
                     $counter1 = 0;
                     if (!(is_array($totalUsers))) { ?>

                      <h1><?php echo $counter1; ?></h1>

                  <?php }elseif (count($totalUsers) === count($totalUsers, COUNT_RECURSIVE)) { ?>

                      <h1>1</h1>

                  <?php }else{
                  foreach ($totalUsers as $totalUser) {
                    $counter1++;
                    }?>
                    <h1><?php echo $counter1; ?></h1>
                 <?php } ?>
                  
                  <p>Total Users</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                   <?php 
                     $counter2 = 0;
                     if (!(is_array($totalProjects))) { ?>

                      <h1><?php echo $counter2; ?></h1>

                  <?php }elseif (count($totalProjects) === count($totalProjects, COUNT_RECURSIVE)) { ?>

                      <h1>1</h1>

                  <?php }else{
                   foreach ($totalProjects as $totalProject) {
                    $counter2++;
                    }?>
                    <h1><?php echo $counter2; ?></h1>
                 <?php } ?>
                  <p>Total Projects</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                   <?php 
                    $counter3 = 0;
                    if (!(is_array($totalContacts))) { ?>

                      <h1><?php echo $counter3; ?></h1>

                  <?php }elseif (count($totalContacts) === count($totalContacts, COUNT_RECURSIVE)) { ?>

                      <h1>1</h1>

                  <?php }else{
                   foreach ($totalContacts as $totalContact) {
                    $counter3++;
                  } ?>
                    <h1><?php echo $counter3; ?></h1>
                 <?php } ?>
                  <p>Total Contacts</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">

                   <?php 
                     $counter4 = 0;
                     if (!(is_array($totalProducts))) { ?>

                      <h1><?php echo $counter4; ?></h1>

                  <?php }elseif (count($totalProducts) === count($totalProducts, COUNT_RECURSIVE)) { ?>

                      <h1>1</h1>

                  <?php }else{
                   foreach ($totalProducts as $totalProduct) {
                    $counter4++;
                  } ?>
                    <h1><?php echo $counter4; ?></h1>
                 <?php } ?>
                  <p>Total Products</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

        <?php 
              
          $results = fetch_column10('projects', 'add_date');
          if($results){
            $msg = true;
          }else{
            $errors['events'] = true;
          }

        ?>          
                  
        <div class="row row-xs mg-t-10">
          
        <div class="col-lg-8 col-xl-9">
            <div class="row row-xs">
              <div class="col-md-5 col-lg-6 col-xl-5" >
                <div class="card card-activities pd-20" style="min-height: 480px; overflow: scroll; margin-top:0">
                

                <?php if(isset($msg)){ 
                  $pattern = array('\r\n', '\f', '\s', '\n', '\r', '\v', '\t', '[\b]');
                  $replace = '';
                  $project_name = trim($results[0]['project_name']);
                  $project_name = str_replace($pattern, $replace, $project_name);                      
                  ?>
                  <h6 class="slim-pagetitle" id="project_name" ><?php echo $project_name;?></h6>
                <?php }else{ ?>
                  <h6 class="slim-pagetitle" id="project_name" >No events yet</h6>
                <?php }?>

                  <div class="media-list" style="margin-top:30px;" id="project_desc">
                    <?php
                      $pattern = '/\s{2,}||\n||\r||\t||\0||\x0B||\f||\v||\r\n/';
                      // '/\r||\n||\s||\r\n/';
                      // $pattern = array('\r\n', '\f', '\s', '\n', '\r', '\v', '\t');
                      $replace = '';
                      
                      $event_detail = trim($results[0]['project_desc']);
                      $event_detail = preg_replace($pattern, $replace, $event_detail);                      
                      echo $event_detail;
                     ?>
                     
                  </div><!-- media-list -->
                </div><!-- card -->
              </div><!-- col-5 -->
              <div class="col-md-7 col-lg-6 col-xl-7 mg-t-10 mg-md-t-0" style="background-size:contain">
              <div style=width"100%; max-height:480px;" >
                <img src="<?php echo $results[0]['project_img_path']?>" alt="EVENT IMAGE APPEARS HERE"  id="project_img_path">
              </div>
                
                
              </div><!-- col-7 -->
            </div><!-- row -->
          </div><!-- col-9 -->        

          <div class="col-lg-4 col-xl-3 mg-t-10 mg-lg-t-0">
            <div class="card card-activities pd-20" style="min-height: 480px; overflow: scroll; margin-top:0">
            <?php if(isset($msg)){ ?>
                <h6 class="slim-card-title">Projects</h6>
              
              <!-- <p>Last event was added on <?php echo substr($results[0]['event_reg_date'], 0 , 11)?></p> -->
              <div class="media-list">
                
                <?php if(count($results) === count($results, COUNT_RECURSIVE)){ 
                  extract($results);
                  ?>
                  <a href="Javascript:Void()" class="media">
                  <div class="media" style"margin-bottom:20px;">
                    <div class="activity-icon bg-primary">
                      <i class="icon ion-image"></i>
                    </div><!-- activity-icon -->
                    <div class="media-body">
                      <h6><?php echo $project_name?></h6>
                      <p><?php echo substr($project_desc, 0, 30)?></p>
                      <!-- <span><?php echo substr($event_reg_date, 0, 11)?></span> -->
                    </div><!-- media-body -->
                  </div><!-- media -->
                  </a>
                <?php }else{?>
                    
                <?php foreach($results as $result):
                    extract($result);
                    ?>
                    <a  class="media" onclick='displayComment(<?php echo '"'.$project_name . '", "' . $project_img_path . '", "' . $project_desc . '"'; ?>)'>
                    <div class="media" style"margin-bottom:20px;"  onclick='displayComment(<?php echo '"'.$project_name . '", "' . $project_img_path . '", "' . $project_desc . '"'; ?>)'>
                      <div class="activity-icon bg-primary">
                        <i class="icon ion-image"></i>
                      </div><!-- activity-icon -->
                      <div class="media-body">
                        <h6><?php echo $project_name?></h6>
                        <p><?php echo substr($project_desc, 0, 30)?></p>
                        <!-- <span><?php echo substr($event_reg_date, 0, 11)?></span> -->
                      </div><!-- media-body -->
                    </div><!-- media -->
                    </a>
                <?php endforeach; }?>

              </div><!-- media-list -->
                <?php }else{ ?>
                  <h6 class="slim-pagetitle">No events Yet</h6>
                <?php }?>     
            </div>
            <!-- card -->       
          </div>  
          
      </div><!-- container -->
    </div><!-- slim-mainpanel -->


  <script>
  
    function displayComment(project_name, project_img_path, project_desc, commentId) {
        let nameEle = document.getElementById('project_name');
        let imageEle = document.getElementById('project_img_path');
        let commentEle = document.getElementById('project_desc');
        // let commentIdEle = document.getElementById('commentId');

        nameEle.innerHTML = project_name;
        imageEle.src = project_img_path;
        commentEle.innerHTML = project_desc;
        // commentIdEle.innerHTML = commentId;
    }              
  
  </script>                

    <?php require_once 'inc/page-footer.inc.php'; ?>