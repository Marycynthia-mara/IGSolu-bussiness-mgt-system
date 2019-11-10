<?php 
$pageTitle = "Manage Users";

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
       <label class="section-title">Manage Users</label>
       <p class="mg-b-20 mg-sm-b-40">View Users profile edit and restrict teauserschers from here.</p>
       
       <?php 
       
       $results = fetch_column4('role', 'users', '0');
       
       ?>

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                <th class="wd-15p">#</th>
                <th class="wd-15p">Users Name</th>
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Gender</th>
                <th class="wd-15p">Phone</th>
                <th class="wd-15p">Restrict</th>
                <th class="wd-15p">Edit</th>
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
              <td><a href="profile.php?user_id=<?php echo $id; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname)?></a></td>
              <td><a href="mailto:<?php if(isset($email)){
                        echo $email;
                      } ?>"><?php echo $email; ?></a></td>
              <td><?php echo $gender; ?></td>
              <td><?php echo $phone; ?></td>
              <td> <td><a href="restrict-editors.php?user_id=<?php echo $id; ?>"><i class="fa fa-edit" title="Restrict User"></i> </a> </td>
              <td><a href="update-editors.php?user_id=<?php echo $id; ?>"><i class="fa fa-edit" title="Edit User"></i> </a> </td>
           </tr>
       <?php }else{?>
               
           <?php
           foreach($results as $result):
               extract($result);
               ?>
               <tr>
                  <td><?php echo ++$counter; ?></td>
                  <td><a href="profile.php?user_id=<?php echo $id; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname)?></a></td>
                  <td><a href="mailto:<?php if(isset($email)){
                        echo $email;
                      } ?>"><?php echo $email; ?></a></td>
                  <td><?php echo $gender; ?></td>
                  <td><a href="tel:<?php if(isset($phone)){
                        echo $phone;
                      } ?>"><?php echo $phone; ?></a></td>
                  <td><a href="restrict-editors.php?user_id=<?php echo $id; ?>"><i class="fa fa-edit" title="Restrict User"></i> </a> </td>
                  <td><a href="update-editors.php?user_id=<?php echo $id; ?>"><i class="fa fa-edit" title="Edit User"></i> </a> </td>
             </tr>

           <?php endforeach; }
          }?>

           </tbody>
           </table>
       </div><!-- table-wrapper -->
   </div><!-- section-wrapper -->     

</form> 

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