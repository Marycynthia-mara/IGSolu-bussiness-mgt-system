<?php  
session_start();
require_once 'config.inc.php';
require_once './mail-function.inc.php'; 

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
			$errors['email_err'] = "Invalid email address";
		}
	} else{
		$err_flag = true;
		$errors['email_err'] = "Enter email address";
	}


	if (!empty($password)) {
		$password = sha1(sanitize($password));
	} else {
		$err_flag = true;
		$errors['password_err'] = "Enter password";
	}

	if ($err_flag === false) {
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

		$result = execute_select($sql);
		if ($result) {
			$_SESSION['user_id'] = $result['id'];
			return true;
		} else {
			$errors['login_err'] = "Invalid login details";
		}
	}
	return $errors;
}

function forgot_password($post){
	$err_flag = false;
	$errors = [];

	extract($post);
	if (!empty($user_logger)) {
		$user_logger = sanitize($user_logger);
	} else{
		$err_flag = true;
		$errors['user_logger'] = "Enter Your username/Reg-no";
	}


	if (!empty($email)) {
		$email_tmp = sanitize_email($email);
		if($email_tmp){
			$email = $email_tmp;
		}else{
			$errors['invalid_email'] = "Enter a valid email";
		}
	} else {
		$err_flag = true;
		$errors['email'] = "Enter Your email";
	}

	if (!empty($login_category)) {
		$login_category = sanitize($login_category);
	} else{
		$err_flag = true;
		$errors['login_category'] = "Choose Category";
	}
	if ($err_flag === false) {
		if ($login_category == 'student') {
			$sql = "SELECT * FROM students WHERE email = '$email' AND reg_no = '$user_logger'";
		}

		if ($login_category == 'staff') {
			$sql = "SELECT email, username FROM teachers WHERE email = '$email' AND username = '$user_logger'";
		}

		if ($login_category == 'admin') {
			$sql = "SELECT email, username FROM administrators WHERE email = '$email' AND username = '$user_logger'";
		}
		$result = execute_select($sql);

		if ($result) {
			if ($login_category == 'student') {


				if( ($result['status'] === '1')){
					$msg1 = true;
				}else {
					$errors['authentication'] = "You have not yet verified your account";
				}

				if(($result['fees_paid'] === 'true')){
					$msg2 = true;
				}else {
					$errors['fees_paid'] = "You have not Paid your school fees";
				}

				if( (isset($msg1)) AND (isset($msg2))){
					$category = 'students';
					$token = sha1(uniqid());
					$subject = "You Requested a change of password";
					$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
					$response = send_mail($email, 'Hello', $subject, $body);
					
					if($response){
						if (save_token2($email, $token)) {
							return true;
						}
					}
					$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
					return $errors;
				}
				
				if( (isset($errors['authentication'])) or (isset($errors['fees_paid']))){
					return $errors;
				}

			}

			if ($login_category == 'staff') {
				$category = 'teachers';
				$token = sha1(uniqid());
				$subject = "You Requested a change of password";
				$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
				$response = send_mail($email, 'Hello', $subject, $body);
				
				if($response){
					if (save_token2($email, $token)) {
						return true;
					}
				}
				$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
				return $errors;
			}

			if ($login_category == 'admin') {
				$category = 'administrators';
				$token = sha1(uniqid());
				$subject = "You Requested a change of password";
				$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
				$response = send_mail($email, 'Hello', $subject, $body);
				
				if($response){
					if (save_token2($email, $token)) {
						return true;
					}
				}
				$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
				return $errors;
			}
			
		} else {
			$errors[] = "Incorrect details entered";
		}
	}
	return $errors;
}

function Reset_password($post, $category, $email, $logger){
	$err_flag = false;
	$errors = [];
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
	if ($category == 'students') {
		$sql = "UPDATE $category SET password = '$password' WHERE reg_no = '$logger' AND email = '$email'";
	}else{
		$sql = "UPDATE $category SET password = '$password' WHERE username = '$logger' AND email = '$email'";
	}

		$result = execute_iud($sql);
		if($result){
			echo "<script>alert('Password Reset Successful');</script>";
			redirect_to('signin.php');
		}else {
			$errors['psw'] = 'Password not sucessfully updated.';
		}
		
	}return $errors;
}

function fetch_column($column, $table){
	$sql = "SELECT * FROM $table";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function send_us_a_mail($post)
{
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($email)) {
		$email_tmp = sanitize_email($email);
		if ($email_tmp) {
			$email = $email_tmp;
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid email address.';
		}
	} else {
		$err_flag = true;
		$errors['email'] = 'Enter Your Email.';

	}

	if (!empty($name)) {
		$name = sanitize($name);
	} else {
		$err_flag = true;
		$errors['name'] = 'Enter Your Fullname.';
	}

	if (!empty($subject)) {
		$subject = sanitize($subject);
	} else {
		$err_flag = true;
		$errors['subject'] = 'Enter Your Subject.';
	}

	if (!empty($message)) {
		$message = sanitize($message);
	} else {
		$err_flag = true;
		$errors['message'] = 'Enter Your Message.';
	}

	if (!empty($phone)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $phone)) {
			$phone = sanitize($phone);
		}else{
			$err_flag = true;
			$errors['invalid_phone'] = "Enter a valid phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['phone'] = "Enter Your phone no.";
	}
	
	if ($err_flag === false) {
		$sql = "INSERT INTO contact (contact_email,contact_name,contact_body,contact_subject,contact_phone) VALUES ('$email','$name','$message','$subject','$phone')";

		$email = $email;
		$subject = "Thank you for contacting us";
		$subject = ucfirst($subject);
		$message = ucfirst($message);
		$body = get_email_template2('./email_template3.php', $name, $email, $subject, $message);

		if (!check_duplicate_mail('contact', 'contact_name', 'contact_email', 'contact_phone', 'contact_subject', 'contact_body', $name, $email, $phone, $subject, $message)) {
			$response = send_mail($email, $name, $subject, $body);
			if ($response) {
				if (execute_iud($sql)) {
					return true;
				} else {
					$errors['DB'] = 'Insert not successful.';
				}	
			}else{
			  $errors['mail_sent'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " . "<br> "." Ensure you have a good internet connection and try again. " ;
			  return $errors;
			}
			$errors['mail_already_sent'] = "Mail already sent" ;
			  return $errors;
		}
		

	} return $errors;
	
}

function fetch_all_students_pin_number(){
	$sql = "SELECT students.`student_id`, `reg_no`, `firstname`, `lastname`, `surname`, `class`, `fees_paid`, `pin`, classroom.classroom_name FROM `students` INNER JOIN classroom ON students.class = classroom.classroom_id WHERE students.pin != 'NULL' ORDER BY classroom.classroom_id ASC"; 
	$result = execute_select($sql);

   if ($result) {
   return $result;
   } return false;
 }

?>