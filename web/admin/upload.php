<?php 
require_once 'inc/config.inc.php';
if (isset($_POST['submit']) && isset($_FILES['profile_img'])) {
$user_id = $_POST['userid'];

	$result = upload_profile_image($_FILES['profile_img'], $_POST, 'users', $user_id);
	
	$url = "profile.php?user_id=$user_id";

	if ($result) {
		redirect_to($url);
	}else{
		$_SESSION['err_msg'] = true;
		redirect_to($url);
	}
}else{
	$_SESSION['err_msg'] = true;
	redirect_to($url);
}
 ?>
