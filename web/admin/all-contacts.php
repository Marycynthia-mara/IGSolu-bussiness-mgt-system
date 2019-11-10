<?php $pageTitle = "All contacts"; 

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
$counter = 0;
?>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">Manage Contacts</label>
       <p class="mg-b-20 mg-sm-b-40">View contacts here.</p>
       
       <?php 
       
       $results = fetch_column10('contact', 'contact_date');
       
       ?>

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                <th class="wd-15p">#</th>
                <th class="wd-15p">Contact Name</th>
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Phone</th>
                <!-- <th class="wd-15p">subject</th> -->
                <th class="wd-15p">view contact</th>
                <th class="wd-15p">Mark as read</th>
               </tr>
           </thead>
           <tbody>

           <?php 
           if($results !== false){
           if(count($results) === count($results, COUNT_RECURSIVE)){ 
               extract($results);
               ?>
           <tr>
              <td><?php echo ++$counter; ?></td>
              <td><a href="profile.php?user_id=<?php echo $id; ?>"><?php echo ucfirst($contact_name)?></a></td>
              <td><a href="mailto:<?php if(isset($contact_email)){
                        echo $contact_email;
                      } ?>"><?php echo $contact_email; ?></a></td>
              
              <td><?php echo $contact_phone; ?></td>
              <!-- <td><?php echo $gender; ?></td> -->
              <td> <td><a class="manageCont" id="manageCont<?php echo $counter?>" href="#" onclick='showContact(<?php echo '"'.'overlay' . '", "' . 'Mailsubj' . '", "' . 'MailBody' . '", "' . 'contactSubj'.$counter . '", "' .'contactBody'. $counter . '"'; ?>)'><i class="fa fa-eye" title="View contact"></i> </a> </td>
              <p class="MailCont" id="contactSubj<?php echo $counter?>"><?php echo $contact_subject ?></p>
              <p class="MailCont" id="contactBody<?php echo $counter?>"><?php echo $contact_body ?></p>

              <td><a class="manageCont <?php if ($status === 'read') {
              	echo "read";
              } ?>" id="markCont<?php echo $counter?>" href="#" ><i class="fa fa-check-square-o" title="Mark as read"></i> </a> 

              <input class="btn btn-primary btn-sm mg-b-10" name="mark<?php echo $counter?>" type="submit" value="<?php if ($status == 'read') {
                 		echo 'mark as unread';
                 	}else{echo 'mark as read';} ?>"></input>
                 	<?php if (isset($_POST['mark1'])) {
                 		if ($status == 'read') {
                 			$result = update_contact('unread', $contact_id);
                 		}else{
                 			$result = update_contact('read', $contact_id);
                 		} ?>

                 		<?php if ($result === true) {?>
                 			<!-- <script>alert('success')</script> -->
                 		<?php } ?>
                 		
                 <?php	} ?>
              </td>
           </tr>
       <?php }else{?>
               
           <?php
           foreach($results as $result):
               extract($result);
               ?>
               <tr>
                  <td><?php echo ++$counter; ?></td>
                  <td><a href="profile.php?user_id=<?php echo $id; ?>"><?php echo ucfirst($contact_name)?></a></td>
                  <td><a href="mailto:<?php if(isset($contact_email)){
                        echo $contact_email;
                      } ?>"><?php echo $contact_email; ?></a></td>
                  <td><a href="tel:<?php if(isset($contact_phone)){
                      echo $contact_phone;
                   } ?>"><?php echo $contact_phone; ?></a></td>
                  <!-- <td><?php echo $gender; ?></td> -->                  
                  <td><a class="manageCont" id="manageCont<?php echo $counter?>" href="#"  
                  onclick='showContact(<?php echo '"'.'overlay' . '", "' . 'Mailsubj' . '", "' . 'MailBody' . '", "' . 'contactSubj'.$counter . '", "' .'contactBody'. $counter . '"'; ?>)'>
                    <div class="media" style"margin-bottom:20px;"><i class="fa fa-eye" title="View contact"></i> </a> </td>
                  <p class="MailCont" id="contactSubj<?php echo $counter?>"><?php echo $contact_subject ?></p>
                  <p class="MailCont" id="contactBody<?php echo $counter?>"><?php echo $contact_body ?></p>
                  <td><a class="manageCont <?php if ($status === 'read') {
                  	echo "read";
                  } ?>" id="markCont<?php echo $counter?>" href="#" ><i class="fa fa-check-square-o" title="Mark as read"></i> </a> 
                 	<!-- onclick="markContact(<?php echo $contact_id .', '. $status?>)" -->
                 	<input class="btn btn-primary btn-sm mg-b-10" name="mark<?php echo $counter?>" type="submit" value="<?php if ($status == 'read') {
                 		echo 'mark as unread';
                 	}else{echo 'mark as read';} ?>"></input>
                 	<?php if (isset($_POST['mark1'])) {
                 		if ($status == 'read') {
                 			$result = update_contact('unread', $contact_id);
                 		}else{
                 			$result = update_contact('read', $contact_id);
                 		} ?>

                 		<?php if ($result === true) {?>
                 			<!-- <script>alert('success')</script> -->
                 		<?php } ?>
                 		
                 <?php	} ?>
                  </td>
             </tr>

           <?php endforeach; }
          }?>

           </tbody>
           </table>
       </div><!-- table-wrapper -->
   </div><!-- section-wrapper -->     

</form> 
	<div id="overlay" class="section-wrapper">
	<p id="closeOverlay" onclick="closeOverlay()"><i class="fa fa-close"></i></p>
		<div class="form-control" style="width: 70%; margin: 0px auto;" >
           <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                <div class="form-group">
                 <label>Subject</label>
                  <input type="text" class="form-control" id="Mailsubj" placeholder="Subject" style="margin-top: 10px;" value="<?php if(isset($_POST['subject'])){echo $_POST['subject'];} ?>" name="subject">
                </div>

                <label>Body</label>
                <div class="form-group">
                  <textarea id="MailBody" value="<?php if(isset($_POST['message'])){echo $_POST['message'];} ?>" name="message"  class="form-control"  placeholder="Enter body of Mail here..." style="width: 100%;resize: none;height: 300px;"></textarea>
                </div>
         	</form>
      
      	</div><!-- /.modal-content -->
    </div>  	

       <script>
     $(function(){
       'use strict';

       $('#datatable1').DataTable({
         responsive: true,
         language: {
           searchPlaceholder: 'Search...',
           sSearch: '',
           lengthMenu: '_MENU_ items/page',
         }
       });

       $('#datatable2').DataTable({
         bLengthChange: false,
         searching: false,
         responsive: true
       });

       // Select2
       $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

     });
   </script>
      
   <?php require_once 'inc/page-footer.inc.php'; ?>
