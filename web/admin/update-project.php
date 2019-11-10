<?php $pageTitle = "Update Projects"; 

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 
?>


<?php 
 if (isset($_POST['fetchProj'])) {
      if (isset($_POST['updateProj'])) {
        extract($_POST);
       
       $_SESSION['project_id'] = $updateProj;
        $fetched_project = fetch_column4('project_id', 'projects', $updateProj);
        if ($fetched_project == true) {
        	extract($fetched_project);
          $_SESSION['prev_img_path'] = $project_img_path;
           $fetchProjMsg = true;
        }else{
          $errors['updateProj'] = true;
        }
       }else{
      $errors['updateProj'] = true;
    }   
}

              if (isset($_POST['UpdProject'])) {
                 if (isset($_POST['project_name']) and isset($_POST['project_desc']) and isset($_FILES['project_img_path'])) {
                  extract($_POST);
                  $result = update_post('projects', 'project', $_POST, $_FILES['project_img_path'], $project_name, $project_desc, $_SESSION['prev_img_path'], $_SESSION['project_id']);
                  if ($result === true) {
                   $UpdMsg = true;
                  }else{
                    $errors['Uproject'] = true;
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
                                var duration = timer * 60000;
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
                 }else{
                    $errors['Uproject1'] = true;
                  }
              }
              ?>


<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE PROJECT</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select project: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="updateProj" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php 
                        	if ($userRole !== 'Admin') {
                        		$updateProj = fetch_column4('user_id','projects', $_SESSION['user_id']);
                        	}else{
                        		$updateProj = fetch_column3('projects', 'project_name');
                        	}
                         ?>
                        <?php if (count($updateProj) === count($updateProj, COUNT_RECURSIVE)) { ?>

                        	<option   class=""  value="<?php echo $updateProj['project_id']; ?>"><?php echo ucwords($updateProj['project_name']);  ?></option>

                        <?php }else{ ?>
                        <?php foreach ($updateProj as $projects) { ?>
                            <option   class=""  value="<?php echo $projects['project_id']; ?>"><?php echo ucwords($projects['project_name']);  ?></option>
                      <?php }
                      	} ?>    
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="fetchProj" style="margin-bottom: 30px;">Fetch project</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['updateProj'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Something went wrong, ensure you choose a project to update.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>                         

              </div><!-- form-layout -->

              <?php if (isset($errors['Uproject'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Update not successful. Ensure that all field are filled and you made an update.
                    </div>
                    <!-- alert -->
                    
                <?php endif ?>

               <?php if (isset($errors['Uproject1'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Ensure all the fields are filled.
                    </div>
                    <!-- alert -->
                    
                <?php endif ?>

            <?php if (isset($UpdMsg)): ?>

	          <div class="alert alert-success" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	            <strong>Well done!</strong> project successfully Updated.
	          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

  	<?php if (isset($fetchProjMsg) ): ?>

  		<div class="form-control" style="width: 70%; margin: 40px auto" >
           <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                
                <div class="form-group">
                <label for="title">Project Title / Location</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Project Title / Location" style="margin-top: 10px;" name="project_name" id="title" value="<?php if (isset($project_name)) {
                  	echo "$project_name";
                  } ?> ">
                </div>
               
                <div class="form-group">
                <label for="body">Project Description</label>
                  <textarea name="project_desc" id="body" class="form-control"  placeholder="Enter Project Description here..." style="width: 100%;resize: none;height: 300px;" value="<?php if (isset($project_desc)) {
                  	echo "$project_desc";
                  } ?> ">
                  	<?php if (isset($project_desc)) {
                  		echo "$project_desc";
                  	} ?>
                  </textarea>
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile04" name="project_img_path" value="<?php if (isset($project_img_path)) {
                  	echo "$project_img_path";
                  } ?> ">
                    <label class="custom-file-label dripicons-paperclip" for="inputGroupFile04">Attach Project picture here</label>
                  </div>

                </div>
              
                <div class="text-center" style="margin-top: 8px;">
                    <a class="btn btn-success waves-effect waves-light" href="#content1" style="width: 100%;padding: 5px;font-size: 20px;">Update Project</a>
                </div>

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">IDEAL UPDATE.</h1><section><p>Are you sure you want to Update This Project?</p></section><div class="btnn"><button type="submit" class="btn btn-primary bd-0" name="UpdProject" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

         </form>
      
      </div><!-- /.modal-content -->
    <?php endif ?>  

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>