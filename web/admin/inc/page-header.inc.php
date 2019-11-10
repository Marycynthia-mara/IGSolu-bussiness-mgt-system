<?php require_once 'inc/config.inc.php'; ?>

<?php 
if ($_SESSION['user_id']) {
  $user = fetch_column4('id', 'users', $_SESSION['user_id']);
  extract($user);
  $userRole = userRole($role); 
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title><?php echo "$userRole" ?> Dashboard</title>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="/lib/datatables/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/lib/select2/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="icon" href="../images/logo_name2.png">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link href="css/special_action_confirm_style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/slim.js"></script>    
    <script src="lib/jquery/js/jquery.js"></script>
    <script src="js/custom.js"></script>

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/slim.css">
    

  </head>
  <body class="dashboard-3" id="siteBody">
    <div class="slim-header">
      <div class="container">
        <div class="slim-header-left">
          <h2 class="slim-logo"><a href="index.php">IG-Solutions<span>.</span></a></h2>
        </div><!-- slim-header-left -->

        <div class="slim-header-right">
          <div class="dropdown dropdown-c">
            <a href="#" class="logged-user" data-toggle="dropdown">
              <img src="<?php if(isset($profile_img_path)){
                echo "$profile_img_path";
              }else{
                echo "http://via.placeholder.com/500x500";
              } ?>" alt="">
              <span><?php echo ucfirst($firstname); ?></span>
              <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <nav class="nav">
                <a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link"><i class="icon ion-person"></i> View Profile</a>
                <a href="change_password.php" class="nav-link"><i class="icon ion-person"></i>Change Pasword</a>

                <?php if($role == '2'){ ?>
                  <a href="all-operations.php" class="nav-link"><i class="icon ion-ios-email-outline"></i>All Operations</a>
                <?php } ?>
               
                <a href="signout.php" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
              </nav>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </div><!-- header-right -->
      </div><!-- container -->
    </div><!-- slim-header -->

    <div class="slim-navbar">
      <div class="container">
        <ul class="nav">
          <?php if ($userRole === 'Admin'): ?>
           
          <?php endif ?>
           <li class="nav-item <?php if($pageTitle === "Dashboard"){
            echo "active";
           } ?>">
              <a class="nav-link" href="dashboard.php">
                <i class="icon ion-ios-home-outline"></i>
                <span>Dashboard</span>
              </a>
              <!-- <div class="sub-item">
                <ul>
                  <li><a href="index.html">Dashboard 01</a></li>
                </ul>
              </div> -->
              <!-- sub-item -->
           </li>
          
          <li class="nav-item <?php if($pageTitle === "Profile" or $pageTitle === "edit-profile"){
        echo "active";
         } ?> with-sub">
            <a class="nav-link" href="#">
            <i class="icon ion-person"></i>
            <span>Profile</span>
          </a>
            <div class="sub-item">
              <ul>
                <li><a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">View Profile</a></li>
                <li><a href="edit-profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">Edit Profile</a></li> 
              </ul>
            </div>
            <!-- dropdown-menu -->
          </li>
          
          <?php if ($userRole === 'Admin'): ?>
            <li class="nav-item <?php if($pageTitle === "Add Editors" or $pageTitle === "Update Editors" or $pageTitle === "Manage Users" or $pageTitle === "Delete Editors"){
              echo "active";
              } ?> with-sub">
              <a class="nav-link" href="#" data-toggle="dropdown">
                <i class="icon ion-ios-gear-outline"></i>
                <span>Users</span>
              </a>
              <div class="sub-item">
                <ul>
                  <li><a href="add_editors.php">Creat Editors</a></li>
                  <li><a href="manage-users.php">Manage Users</a></li>
                  <!-- <li><a href="update-editors.php">Update Editors</a></li> -->
                  <!-- <li><a href="delete-editors.php">Delete Editors</a></li> -->
                </ul>
              </div><!-- dropdown-menu -->
          </li>
          <?php endif ?>
            

          <?php if ($userRole === 'Admin' or $userRole === 'Editor'): ?>
            <li class="nav-item <?php if($pageTitle === "Creat Projects" or $pageTitle === "Delete Projects" or $pageTitle === "Update Projects"){
            echo "active";
           } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-book-outline"></i>
              <span>Projects</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="add_project.php">Creat Projects</a></li>
                <li><a href="update-project.php">Update Projects</a></li>
                <?php if ($userRole === 'Admin'): ?>
                    <li><a href="delete-project.php">Delete Projects</a></li>
                <?php endif ?>
              </ul>
            </div><!-- dropdown-menu -->
          </li>

          <?php endif ?>

          <?php if ($userRole === 'Admin' or $userRole === 'Editor'): ?>
            <li class="nav-item <?php if($pageTitle === "Creat Products" or $pageTitle === "Delete Products" or $pageTitle === "Update Products"){
            echo "active";
           } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-book-outline"></i>
              <span>Products</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="add_products.php">Creat Products</a></li>
                <li><a href="update-products.php">Update Products</a></li>
                <?php if ($userRole === 'Admin'): ?>
                    <li><a href="delete-products.php">Delete Products</a></li>
                <?php endif ?>
              </ul>
            </div><!-- dropdown-menu -->
          </li>

          <?php endif ?>


          <?php if ($userRole === 'Admin'): ?>
            <li class="nav-item <?php if($pageTitle === "All contacts" or $pageTitle === "Mail All contacts" or $pageTitle === "Delete contacts"){
            echo "active";
          } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-filing-outline"></i>
              <span>contacts</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="all-contacts.php">All contacts</a></li>
                <li><a href="compose_mail.php">Mail All contacts</a></li>
                <!-- <li><a href="delete-contacts.php">Delete contacts</a></li> -->
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          <?php endif ?>
          
        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->

    <div class="slim-mainpanel">
      <div class="container">
        <div class="slim-pageheader">
          <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php if (isset($pageTitle)) {
              echo ucfirst($pageTitle);
            } ?></li>
          </ol>
          <h6 class="slim-pagetitle">Welcome back, <?php echo ucfirst($firstname); ?></h6>
        </div><!-- slim-pageheader -->
