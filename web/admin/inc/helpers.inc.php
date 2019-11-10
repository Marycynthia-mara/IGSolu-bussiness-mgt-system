<?php  
require_once 'config.inc.php';
function check_duplicate($table, $column, $data){

	$sql = "SELECT $column FROM $table WHERE $column = '$data'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}


function redirect_to($url){
	// $url = urlencode($url);
	// header("Location: $url");
	// exit();
	echo '<script language="javascript">window.location.href="'.$url.'"</script>';
}

function format_date($date){
	$date = date('F j, Y', $date);
	return $date;
}

function userRole($roleValue){
	if ($roleValue == 0) {
		return "Editor";
	} else if ($roleValue == 1 or $roleValue == 2) {
		return "Admin";
	}
	 // return "Administrator";
}

function get_image_path($file){
	$err_flag = false;
	extract($file);
	if ($size > 1022976) {
		$err_flag = true;
		return false;
	}

	$allowed_extensions = ['png', 'jpg', 'jpeg', 'svg', 'gif'];
	$split = explode('/', $type);
	$endofarray = end($split);
	$image_ext = strtolower($endofarray);

	// in_array(needle, haystack)
	if (!in_array($image_ext, $allowed_extensions)) {
	$err_flag = true;
	return false;		
	}

	$file_destn = 'uploads/';
	$image_name = $file_destn. 'IGTECH_' .sha1(uniqid()).'.'.$image_ext;

		// move_uploaded_file(filename, destination)
	if (move_uploaded_file($tmp_name, $image_name)) {
		return $image_name;
	}return false;
}

function fetch_column2($column, $table, $value){
	$sql = "SELECT * FROM $table WHERE NOT $column = '$value'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column4($column, $table, $value){
	$sql = "SELECT * FROM $table WHERE $column = '$value'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column5($data, $table, $column, $user_id){
	$sql = "SELECT $data FROM $table WHERE $column = $user_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column3($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column10($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order DESC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column7($table){
	$sql = "SELECT * FROM $table";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column9($table, $column1, $value, $Order){
	$sql = "SELECT * FROM $table WHERE $column1 = '$value'  ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function update_table($table, $column1, $value, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column1 = '$value' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_contact($value, $table_id)
{

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageContact === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	$sql = "UPDATE contact SET status = '$value' WHERE contact_id = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table2($table, $column, $value, $column1, $value1, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table3($table, $column, $value, $column1, $value1, $column3, $value3, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1', $column3 = '$value3' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table4($table, $column, $value, $column1, $value1, $column3, $value3, $column4, $value4, $column5, $value5, $column6, $value6, $column7, $value7, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1', $column3 = '$value3' , $column4 = '$value4' , $column4 = '$value4' , $column5 = '$value5' , $column6 = '$value6' , $column7 = '$value7' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function delete_table($table, $column, $table_id)
{

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageProject === 'deactivated' or $ManageProduct === 'deactivated' or $ManageContact === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	$sql = "DELETE FROM $table WHERE $column = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		$errors['delete(oid)'] = 'Delete not successful';
	  return $errors;
	}
}

function delete_all_records($table)
{

	$sql = "DELETE FROM $table";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function find_search_result($post, $table, $column)
{
	extract($post);
	$sql = "SELECT *  FROM $table WHERE $column LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result($post)
{
	extract($post);
	// SELECT students.*, classroom.classroom_name FROM students INNER JOIN classroom ON students.class = classroom.classroom_name WHERE student_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or reg_no LIKE '%$SearchString%' or class LIKE '%$SearchString%'
	$sql = "SELECT * FROM students WHERE student_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or reg_no LIKE '%$SearchString%' or class LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result2($post)
{
	extract($post);
	$sql = "SELECT * FROM teachers WHERE teachers_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or gender LIKE '%$SearchString%' or username LIKE '%$SearchString%' or form_class LIKE '%$SearchString%' or phone LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result3($post)
{
	extract($post);
	$sql = "SELECT * FROM administrators WHERE admin_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or gender LIKE '%$SearchString%' or username LIKE '%$SearchString%' or phone LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_limited_user($column, $table, $limit, $offset)
{
	$sql = "SELECT * FROM $table ORDER BY $column ASC limit $limit, $offset";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function get_total($table, $column)
{
		$sql = "SELECT $column FROM $table";
		$results = execute_select($sql);
		$counter = 0;
		if ($results) {
			foreach ($results as $result) {
				$counter += 1;
			}return $counter;
		}else{
			return false;
		}
}

function add_post($table_name, $table, $post_array, $file_array = null)
{
	$error_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageProject === 'deactivated' or $ManageProduct === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post_array);

	if (!empty($title)) {
		$title = sanitize($title);
	}else{
		$error_flag = true;
		$errors['title'] = "Event title required";
	}

	if (!empty($body)) {
		$body = sanitize($body);
	}else{
		$error_flag = true;
		$errors['post'] = "Event body cannot be empty";
	}

	if ($file_array['name'] != "") {
		$image_path = get_image_path($file_array);
		if ($image_path === false) {
			$error_flag = true;
			$errors['file_size'] = "File size of selected image might be too large";
			$errors['file_ext'] = "File extension of selected image might not be supported";
		}
	}else{
		$error_flag = true;
		$errors['img'] = "Attach an image for this product";
		// $image_path = null;
	}

	$user = $_SESSION['user_id'];
	$postName = $table.'_name';
	$postdesc = $table.'_desc';
	$postImg = $table.'_img_path';

	if ($error_flag === false) {
		$post_date = time();
		$sql = "INSERT INTO $table_name (user_id, $postName, $postdesc, $postImg) VALUES ('$user', '$title', '$body', '$image_path')";

		$result = execute_iud($sql);

		if ($result) {
		 	return true;
		 } 
	} return $errors;
}


function update_post($table_name, $table, $post_array, $file_array = null, $value1, $value2, $value3, $post_id)
{
	$error_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageProject === 'deactivated' or $ManageProduct === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}
		
	$user = $_SESSION['user_id'];
	$postId = $table.'_id';
	$postName = $table.'_name';
	$postdesc = $table.'_desc';
	$postImg = $table.'_img_path';					
	extract($post_array);

	if (!empty($postName)) {
		$postName = sanitize($postName);
	}else{
		$error_flag = true;
		$errors['postName'] = "Event title required";
	}

	if (!empty($postdesc)) {
		$postdesc = sanitize($postdesc);
	}else{
		$error_flag = true;
		$errors['post'] = "Event body cannot be empty";
	}

	if ($file_array['name'] != "") {
		$postImgVal = get_image_path($file_array);
		if ($postImgVal === false) {
			$error_flag = true;
			$errors['file_size'] = "File size of selected image might be too large";
			$errors['file_ext'] = "File extension of selected image might not be supported";
		}
	}else{
		$postImgVal = $value3;
		// $error_flag = true;
		$errors['img'] = "Attach an image for this product";
		// $postImgVal = null;
	}

	

	if ($error_flag === false) {
		$post_date = time();

		$sql = "UPDATE $table_name SET $postName = '$value1', $postdesc = '$value2', $postImg = '$postImgVal' WHERE $postId = $post_id";

		$result = execute_iud($sql);

		if ($result) {
		 	return true;
		 } 
	} return $errors;
}

function update_table4post($post_array, $file_array = null)
{
	$error_flag = false;
	$errors = [];

	extract($post_array);

	if (!empty($title)) {
		$title = sanitize($title);
	}else{
		$error_flag = true;
		$errors['title'] = "Event title required";
	}

	if (!empty($body)) {
		$body = sanitize($body);
	}else{
		$error_flag = true;
		$errors['post'] = "Event body cannot be empty";
	}

	if ($file_array['name'] != "") {
		$image_path = get_image_path($file_array);
		if ($image_path === false) {
			$error_flag = true;
			$errors['file_size'] = "File size of selected image might be too large";
			$errors['file_ext'] = "File extension of selected image might not be supported";
		}
	}else{
		$image_path = null;
	}

	if ($error_flag === false) {
		$post_date = time();
		$event_id = $_SESSION['event_id'];

		if ($file_array['name'] != "") {
			$sql = "UPDATE events SET event_title = '$title', event_desc = '$body', event_image = '$image_path' WHERE event_id = $event_id";
		}else{
			$sql = "UPDATE events SET event_title = '$title', event_desc = '$body' WHERE event_id = $event_id";
		}
		
		$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return $errors;
	}
 }
}

function get_email_template($file_path, $name, $email, $category, $token){
	$body = file_get_contents($file_path);
	$body = str_replace('#firstname#', $name, $body);
	$body = str_replace("#email#", $email, $body);
	$body = str_replace("#category#", $category, $body);
	$body = str_replace("#token#", $token, $body);
	return $body;
}

function get_email_template2($file_path, $subject, $message){
	$body = file_get_contents($file_path);
	$body = str_replace("#Subject#", $subject, $body);
	$body = str_replace("#Message#", $message, $body);
	return $body;
}


function save_token($email, $token){
	global $conn;
	$sql = "INSERT INTO  reg_confirm (token, email) VALUES ('$token', '$email')";
	$query = mysqli_query($conn, $sql);
	if ($query) {
	return true;
	}return false;
}


function generate_pin($no_of_pins){
	$result = false;
	$no_of_pins = intval($no_of_pins);
	for ($x = 0; $x < $no_of_pins; $x++) {
		$rand1 = rand(1000000, 9999999); 
		$rand2 = rand(1000000, 9999999);
		$pin = $rand1.$rand2;
		$serial_no  = FLOOR(RAND(100000, 999999));
		// uniqid(rand(0,100));

		if(check_duplicate('all_pin_code', 'pin_code', $pin) || check_duplicate('all_pin_code', 'serial_number', $serial_no)){
			$x-=1; 
		}else{
		$sql = "INSERT INTO all_pin_code (pin_code, serial_number) VALUES ('$pin', '$serial_no')";
		$result = execute_iud($sql);
		
		}
	}

	if($result){
		return true;
	}else{
		return false;
	}
}