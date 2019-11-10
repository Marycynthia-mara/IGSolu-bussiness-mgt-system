<?php  
session_start();
require_once 'config.inc.php';
require_once './mail-function.inc.php'; 

function add_user($post){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = 'Enter your firstname';
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = 'Enter your lastname';
	}


	if (!empty($email)) {
		$email_tmp = sanitize($email);
		if ($email_tmp) {
			if (!check_duplicate('users', 'email', $email_tmp)) {
				$email = $email_tmp;
			} else {
				$err_flag = true;
				$errors['dup_email'] = 'Email already exist';
			}
		} else {
			$err_flag = true;
			$errors['email'] = 'Invalid Email Address';
		}
	} else {
		$err_flag = true;
		$errors['email'] = 'Enter your email address';
	}


	if (!empty($password)) {
		$password1 = sanitize($password);
	} else {
		$err_flag = true;
		$errors['password1'] = 'Enter Password';
	}


	if (!empty($password2)) {
		$password2 = sanitize($password2);
	} else {
		$err_flag = true;
		$errors['password2'] = 'Enter Confirm Password';
	}


	if (isset($password) AND isset($password2)) {
		if ($password == $password2) {
			$password = sha1($password);
		} else {
			$err_flag = true;
			$errors['mismatch'] = 'Password Mismatch';
		}
	}


	if (!empty($gender)) {
		$gender = sanitize($gender);
	} else {
		$err_flag = true;
		$errors['gender'] = 'Choose Your Gender.';
	}


	if (!empty($tel)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $tel)) {
			$tel = sanitize($tel);
		}else{
			$err_flag = true;
			$errors['invalid_tel'] = "Enter a valid phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['tel'] = "Enter Your phone no.";
	}


	if ($err_flag === false) {
		$sql = "INSERT INTO users (firstname, lastname, email, password, gender, phone) VALUES ('$firstname', '$lastname', '$email', '$password', '$gender', '$tel')";

		if (execute_iud($sql)) {
			$subject = "Welcome to Ideal Gadgets Solutions";
			$token = sha1(uniqid());
			$category = 'users';
			$body =  get_email_template('./email_template.php', $firstname, $email, $category, $token);
			$fullname = $firstname . " " . $lastname;
			$response = send_mail($email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Registeration successfull, but Something went wrong. ". "<br> "."Email not sent, ensure email exist, " ."<br> "."Ensure you have a good internet connection. ". "<br> "."ensure you update your email if it does not exist and verify your account later";
				return $errors;
			}
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}
			
	}
	return $errors;

}

function login_user($post){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);
	if (!empty($email)) {
		$email_tmp = sanitize_email($email);
		if ($email_tmp) {
			$email = $email_tmp;
		}else {
			$err_flag = true;
			$errors = "Invalid email address";
		}
	} else{
		$err_flag = true;
		$errors[] = "Enter email address";
	}


	if (!empty($password)) {
		$password = sha1(sanitize($password));
	} else {
		$err_flag = true;
		$errors[] = "Enter password";
	}

	if ($err_flag === false) {
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

		$result = execute_select($sql);
		if ($result) {
			$_SESSION['user_id'] = $result['id'];
			return true;
		} else {
			$errors[] = "Invalid login details";
		}
	}
	return $errors;
}

function update_user($post, $user_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = 'Enter Your Firstname.';
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = 'Enter Your Lastname.';
	}

	if (!empty($email)) {
		$email_tmp = sanitize_email($email);
		if ($email_tmp) {
			if (!check_duplicate('users', 'email', $email_tmp)) {
				$email = $email_tmp;
			} else {
				// $err_flag = true;
				// $errors['dup_email'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = false;
		$errors['email'] = 'Enter Your Email.';
	}

	if (!empty($gender)) {
		$gender = sanitize($gender);
	} else {
		$err_flag = true;
		$errors['gender'] = 'Choose Your Gender.';
	}

	if (!empty($phone)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $phone)) {
			$phone = sanitize($phone);
		}else{
			$err_flag = true;
			$errors['invalid_tel'] = "Enter a valid  phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['phone'] = "Enter  phone no.";
	}

	if ($err_flag === false) {
		if (!check_duplicate('reg_confirm', 'email', $email)) {
			$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', gender='$gender', status='false', phone='$phone' WHERE id = $user_id";
			// var_dump(execute_iud($sql));
			// die();
			if (execute_iud($sql)) {
				$category = "users";
				$result = verify_user($firstname, $email, $lastname, $category);
				if ($result) {
						return true;
					}
			} else {
				$errors['verify'] = 'Sending verification mail failed.';
			}
		}else{
			$sql1 = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', gender='$gender', phone='$phone' WHERE id = $user_id";

			if (execute_iud($sql1)) {
				return true;
			} else {
				$errors['DB'] = 'update not successful.';
			}
		}
	}
	return $errors;	
}

function change_user_psw($post, $user_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($user_password)) {
		$user_password = sha1(sanitize($user_password));
	} else {
		$err_flag = true;
		$errors['user_password'] = "Enter password";
	}

	if (!empty($confirm_password)) {
		$confirm_password = sha1(sanitize($confirm_password));
	} else {
		$err_flag = true;
		$errors['confirm_password'] = "Confirm password";
	}

	if($user_password == $confirm_password){
		$password = $user_password;
		}else{
			$errors['password'] = "Password Mismatch";
		}			

	if ($err_flag === false){
		$sql = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
		// var_dump($sql);
		// die();
		$result = execute_iud($sql);
			
			if ($result) {
				return true;
			}return $errors;
	}return $errors;
}

function change_psw($post, $category, $user_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($curr_password)) {
		$curr_password = sha1(sanitize($curr_password));
	} else {
		$err_flag = true;
		$errors['curr_password'] = "Enter password";
	}


	if ($err_flag === false){

		if($category === 'users'){
			$sql = "SELECT password FROM users WHERE id = '$user_id'";
		}
		
		
		$result = execute_select($sql);
			
			if ($result) {
				extract($result);
				if($curr_password == $password){
					return true;
				}else{
					$errors['password'] = "Incorrect password";
					return $errors;
				}
			}
			$errors['psw'] = "something went wrong!";
			 return $errors;
	}return $errors;
}

function Reset_password($post, $category, $user_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($password)) {
		$password = sanitize($password);
	} else {
		$err_flag = true;
		$errors['password'] = 'Enter a password.';
	}


	if (!empty($confirm_password)) {
		$confirm_password = sanitize($confirm_password);
	} else {
		$err_flag = true;
		$errors['confirm_password'] = 'Confirm Your password.';
	}

	if (isset($password) AND isset($confirm_password)) {
		if ($password == $confirm_password) {
			$password = sha1($password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}

	if ($err_flag === false) {

		$sql = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
	

		$result = execute_iud($sql);
		if($result){
			return true;
		}else {
			$errors['psw'] = 'Password not sucessfully updated.';
		}
		
	}return $errors;
}

function fetch_user($table, $column, $userID){
	$sql = "SELECT * FROM $table WHERE $column = '$userID'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function upload_profile_image($file, $post, $column, $id)
{
	$err_flag = false;
	$user_id = $post['userid'];
	$result = get_image_path($file);
	if ($result) {
		$image_path = $result;
	}else{
		$err_flag = true;
	}

	if ($err_flag === false) {
		$sql = "UPDATE $column SET profile_img_path = '$image_path' WHERE id = '$user_id'";

		if (execute_iud($sql)) {
			return true;
		}return false;
	}
}

function compose_mail($post)
{
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($subject)) {
		$subject = sanitize($subject);
	} else {
		$err_flag = true;
		$errors['subject'] = 'Enter Your subject.';
	}

	if (!empty($message)) {
		$message = sanitize($message);
	} else {
		$err_flag = true;
		$errors['message'] = 'Enter Your message.';
	}
	
	if ($err_flag === false) {
		$sql = "SELECT contact_email FROM contact";
		$result = execute_select($sql);
		if($result){
			if(count($result) === count($result, COUNT_RECURSIVE)){ 
				extract($result);
				$name = 'Hello dear';
				$body = get_email_template2('./email_template3.php',$subject, $message);
				$response = send_mail($contact_email, $name, $subject, $body);
				if ($response) {
						return true;
				}else{
				  $errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, Ensure you have a good internet connection and  try again. ";
				  return $errors;
				}
			 }else{
				  
			  foreach($result as $mail){
				extract($mail);
				$name = 'Hello dear';
				$subject = ucfirst($subject);
				$message = ucfirst($message);
				$body = get_email_template2('./email_template3.php',$subject, $message);
				$response = send_mail($contact_email, $name, $subject, $body);
			  }
			  if ($response) {
				return true;
				}else{
					$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, Ensure you have a good internet connection and try again. ";
					return $errors;
				}
			} 
	  
		} else {
			$errors['mail'] = 'Mail(s) could not be fetched.';
		}

	} return $errors;
	
}

function verify_user($firstname, $email, $lastname,$category)
{

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($VerifyUser === 'deactivated') {
	  $errors['VerifyUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

		$subject = "Welcome to Ideal Gadgets Solutions";
		$token = sha1(uniqid());
		$body =  get_email_template('./email_template.php', $firstname, $email, $category, $token);
		$fullname = $firstname . " " . $lastname;
		if(!check_duplicate('reg_confirm', 'email', $email)){
			$response = send_mail($email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."Ensure you have a good internet connection  and  try again.";
				return $errors;
			}
	}else {
		$err_flag = true;
		$errors['dup_email'] = 'Email already sent to this mail earlier, check your mail for verification.';
		return $errors;
	}	
}

function fetch_all_students_pin_number(){
	$sql = "SELECT students.`student_id`, `reg_no`, `firstname`, `lastname`, `surname`, `class`, `fees_paid`, `serial_no`, `pin`, classroom.classroom_name FROM `students` INNER JOIN classroom ON students.class = classroom.classroom_id WHERE students.pin != 'NULL' AND students.pin != '' ORDER BY classroom.classroom_id ASC"; 
	$result = execute_select($sql);

   if ($result) {
   return $result;
   } return false;
}

function  update_student_password($post, $stud_id){
	$category = "students";
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($SignUp === 'deactivated') {
		$err_flag = true;
		$errors['signup_operation'] = 'This Operation is not available to You, port 587 blocked';
		return $errors;
	}

	extract($post);


	if (!empty($student_password)) {
		$student_password = sanitize($student_password);
	} else {
		$err_flag = true;
		$errors['student_password'] = 'Enter a password.';
	}


	if (!empty($student_password2)) {
		$student_password2 = sanitize($student_password2);
	} else {
		$err_flag = true;
		$errors['student_password2'] = 'Confirm Your password.';
	}


	if (isset($student_password) AND isset($student_password2)) {
		if ($student_password == $student_password2) {
			$password = sha1($student_password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}


	if ($err_flag === false) {
		$sql1 = "UPDATE students SET password = '$password' WHERE student_id = '$stud_id'";
		if (execute_iud($sql1)) {
					return true;
			}		
		} else {
			$errors['DB'] = 'password not changed successfully.';
			return $errors;
		}
	return $errors;	
}
?>