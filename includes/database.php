<?php
session_start();
ini_set("memory_limit", "800M");
ini_set("max_execution_time", "800");
error_reporting(error_reporting() & ~E_NOTICE);
set_time_limit(0);
require_once('PHPMailerAutoload.php');
class MySQLiDatabase{
	public $link;
	public $lastquery; 
	function __construct(){
		$this->open_connection();
	}
	public function open_connection(){
		$this->link = mysqli_connect("localhost","root","");
		if(mysqli_connect_errno()){
			echo "Failed To Connect To Mysql Server: ".mysqli_connect_errno();
		}else{
			mysqli_select_db($this->link,"foodiemart") or die ("no database"); 
		}
		date_default_timezone_set("Africa/Lagos");
	}
	public function fuckpbnl($string){
		$string = strtolower($string);
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	public function appName(){
		return "Foodie Mart Shop";
	}
	public function query($sql){
		$this->lastquery = $sql;
		$query = mysqli_query($this->link, $sql);
		$this->confirm_query($query);
		return $query;
	}
	public function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		$str = mysqli_real_escape_string($this->link,$str);
		return $str;
	}
	public function fetch_array($result){
		return mysqli_fetch_array($result);
	}
	public function num_rows($query){
		return mysqli_num_rows($query);
	}
	public function last_id(){
		return mysqli_insert_id($this->link);
	}
	public function affected_rows(){
		return mysqli_affected_rows($this->link);
	}
	public function confirm_query($result){
		if(!$result){
			/*$output = "Datase Query Failed! ".mysqli_error($this->link)."<br>";
			$output .= "Last SQL Query: ".$this->lastquery;
			die($output);*/
			return $result = false;
		}
	}
	public function dlink(){
		return "https://localhost/foodiemart";
	}
	public function attachmentLink(){
		return $this->dlink()."/admin";
	}
	public function elink(){
		return "foodiemart.biz";
	}
	public function cur($var){
		
	}
	public function notification(){
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	public function getVar($var){
		return $this->clean($_REQUEST[$var]);
	}
	public function checkEmail($email, $table, $location){
		$query = $this->query("SELECT * FROM {$table} WHERE email=\"$email\"");
		if($this->num_rows($query)>0){
			$response['status'] = 1;
			$response['message'] = "Email exists!";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function checkUsername($email, $table, $location){
		$query = $this->query("SELECT * FROM login WHERE username=\"$email\"");
		if($this->num_rows($query)>0){
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Username Exists!</div>";
			header("location: $location");
			exit;
		}
	}
	public function checkPhone($email, $table, $location){
		$query = $this->query("SELECT * FROM {$table} WHERE phone=\"$email\"");
		if($this->num_rows($query)>0){
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Phone number already in use!</div>";
			header("location: $location");
			exit;
		}
	}
	public function emptyVar($var, $location){
		if((empty($var)) || (strlen($var)< 2)){
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">All fields are required and must not contain less than two(2) characters</div>";
			header("location: $location");
			exit;
		}
	}
	public function uploadImage($img){
		$upload = $img["pix"];
		$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"]);
		//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
		$ar = explode('.', $img['pix']['name']);
		$fileExt = end($ar);
		$filename = md5(date('Ymd').time().'-').".".$fileExt;
		$target = "../uploads/".$filename;
		if(move_uploaded_file($img["pix"]['tmp_name'], $target)){
			return $filename;
		}else{
			return "Upload Failed";
		}
	}
	public function SVFXMailRobotv1($subject, $toemail, $toname, $body){
		$mail = new PHPMailer();
		$mail->isSMTP();                                       // Set mailer to use SMTP
		$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
		$mail->Port = 587;                                   // TCP port to connect to
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'SmurfVillageFX';                 // SMTP username
		$mail->Password = 'ApyH4w7SNFd48OsNS7JQ0Q';                           // SMTP password
//         $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
// 		$mail->Port = 587;                                   // TCP port to connect to
// 		$mail->SMTPAuth = true;                               // Enable SMTP authentication
// 		$mail->Username = 'apikey';                 // SMTP username
// 		$mail->Password = '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';                           // SMTP password
 		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		
		$message = "";
		$email = "no-reply@".$this->elink();
		$name = $this->appName();
		$subject = isset($subject) ? $subject : 'New Message From '.$this->appName();

        $botcheck = $_POST['form_botcheck'];

        if( $botcheck == '' ) {
            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;
			$mail->MsgHTML( $body );
            $sendEmail = $mail->Send();
            /*if(!$mail->send()){
            	echo "Message could not be sent";
            	echo "Mailer error: ".$mail->ErrorInfo;
            }exit;*/
        } else {
            $message = 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
            $status = "false";
        }
	}
	public function paging($pages, $page, $per_page, $dlink, $tbname){
		$url = $dlink."/".$pages."?page";
		$query = "SELECT COUNT(*) as `num` FROM {$tbname}";
		$row = $this->fetch_array($this->query($query));
		$total = $row['num'];
		$adjacents = "2"; 
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;								
		$prev = $page - 1;							
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
		$lpm1 = $lastpage - 1;
		if($page > 1){
		$pagination = "<li><a href='".$url."=$prev'>prev</a></li>";
		}
		if($lastpage > 1)
		{	
			$pagination .= "";
					$pagination .= "";
			if ($lastpage < 7 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='disabled'><a>$counter</a></li>";
					else
						$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class='disabled'><a>$counter</a></li>";
						else
							$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='disabled'><a>...</a></li>";
					$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li><a href='".$url."=1'>1</a></li>";
					$pagination.= "<li><a href='".$url."=2'>2</a></li>";
					$pagination.= "<li class='disabled'><a>...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class='disabled'><a>$counter</a></li>";
						else
					 $pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='disabled'><a>...</a></li>";
					$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
				}
				else
				{
					$pagination.= "<li><a href='".$url."=1'>1</a></li>";
					$pagination.= "<li><a href='".$url."=2'>2</a></li>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class='disabled'><a>$counter</a></li>";
						else
							$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
					}
				}
			}
			
			if ($page < $counter - 1){ 
				$pagination.= "<li><a href='".$url."=$next'>Next</a></li>";
				$pagination.= "<li><a href='".$url."=$lastpage'>Last</a></li>";
			}else{
				$pagination.= "<li class='disabled'><a>Next</a></li>";
				$pagination.= "<li class='disabled'><a>Last</a></li>";
			}
			$pagination.= "\n";		
		}
		 return $pagination;
	}
	public function pagingx($pages, $page, $per_page, $dlink, $tbname){
		$url = $dlink."/".$pages."&page";
		$query = "SELECT COUNT(*) as `num` FROM {$tbname}";
		$row = $this->fetch_array($this->query($query));
		$total = $row['num'];
		$adjacents = "2"; 

		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;								
		
		$prev = $page - 1;							
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
		$lpm1 = $lastpage - 1;
		if($page > 1){
		$pagination = "<li><a href='".$url."=$prev'><i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i> Previous</a></li>";
		}
		if($lastpage > 1){	
			$pagination .= "";
					$pagination .= "";
			if ($lastpage < 7 + ($adjacents * 2)){	
				for ($counter = 1; $counter <= $lastpage; $counter++){
					if ($counter == $page){
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					}else{
						$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
					}
				}
			}elseif($lastpage > 5 + ($adjacents * 2)){
				if($page < 1 + ($adjacents * 2)){
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
						if ($counter == $page){
							$pagination.= "<li class=\"disabled\"><a href=\"#\">$counter</a></li>";
						}else{
							$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
						}
					}
					$pagination.= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
					$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
				}elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
					$pagination.= "<li><a href='".$url."=1'>1</a></li>";
					$pagination.= "<li><a href='".$url."=2'>2</a></li>";
					$pagination.= "<li><a href='#'>...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
						if ($counter == $page){
							$pagination.= "<li class=\"active\"><a>$counter</a></li>";
						}else{
						 	$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";
						}
					}
					$pagination.= "<li><a>...</a></li>";
					$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
				}else{
					$pagination.= "<li><a href='".$url."=1'>1</a></li>";
					$pagination.= "<li><a href='".$url."=2'>2</a></li>";
					$pagination.= "<li><a>...</a></li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
						if ($counter == $page){
							$pagination.= "<li class='active'><a class='current'>$counter</a></li>";
						}else{
							$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
						}
					}
				}
			}
			
			if ($page < $counter - 1){
				$pagination.= "<li><a href='".$url."=$next'>Next</a></li>";
				$pagination.= "<li><a href='".$url."=$lastpage'>Last</a></li>";
			}else{
				$pagination.= "<li class='active'><a class='current'>Next</a></li>";
				$pagination.= "<li class='active'><a class='current'>Last</a></li>";
			}
			$pagination.= "\n";		
		}
		 return $pagination;
	}

	/*	#################################################	ADMIN 	##################################	*/
	public function newAdmin($name, $email, $password, $type){
		$pwd = sha1($password);
		$reg = date("d D M Y h:iA");
		$this->checkEmail($email, "admins", "register");
		$hash = sha1(time());
		$query = $this->query("INSERT INTO admins(name, email, password, registered, type, hash)VALUES(\"$name\", \"$email\", \"$pwd\", \"$reg\", \"$type\", \"$hash\")");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Account created successfully.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Unable to create account at this time, please try again later.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function approveRegistration($hash, $email){
		$query = $this->query("SELECT * FROM login WHERE email=\"$email\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			if($row['status']==1){
				$_SESSION['msg'] = "<div class=\"alert alert-warning\">Account already activated, please login.</div>";
				header("location: login");
				exit;
			}
			$this->query("UPDATE login SET status=1 WHERE email=\"$email\"");
			$_SESSION['userID'] = $row['id'];
			$pid = $_SESSION['userID'];
			$this->query("INSERT INTO wallet(owner)VALUES(\"$pid\")");
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Account fully activated.</div>";
			header("location: dashboard");
			exit;
		}
	}
	public function loginAdmin($username, $password){
		$pwd = sha1($password);
		$query = $this->query("SELECT * FROM admins WHERE email=\"$username\" && password =\"$pwd\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			$_SESSION['adminID'] = $row['id'];
			$response['status'] = 1;
			$response['message'] = "Login successful, hold while we load your back office.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Login failed, please check credentials and try again.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function isLoggedAdmin(){
		if(!isset($_SESSION['adminID'])){
			header('location: login');
			exit;
		}
	}
	public function continueLogin($uid, $otp){
		$query = $this->query("SELECT * FROM login WHERE id=\"$uid\" && otp=\"$otp\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			$year = time() + 60 * 60 * 24 * 7;
			setcookie('username', $uid, $year);
			$cks = $this->uniqueKey();
			$this->query("UPDATE login SET otp=\"974608\" WHERE id=\"$uid\"");
			$this->query("UPDATE login SET checki=\"$cks\" WHERE id=\"$uid\"");
			$year = time() + 60 * 60 * 24 * 365;
			setcookie('loginCheck', $cks, $year);
			if($row['pmz'] == 0){
				$_SESSION['userID'] = $row['id'];
				header("location: dashboard");
				exit;
			}else{
				$_SESSION['userID'] = $row['id'];
				$_SESSION['adminID'] = $row['id'];
				header("location: ../admin/dashboard");
				exit;
			}
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Invalid OTP.</div>";
			$_SESSION['userID'] = $uid;
			header("location: checks");
			exit;
		}
	}
	public function forgotPassword($email){
		$query = $this->query("SELECT * FROM login WHERE email=\"$email\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			if($row['status'] != 1){
			    $_SESSION['msg'] = "<div class=\"alert alert-warning\">Invalid request!</div>";
    			header("location: login");
    			exit;
			}
			$name = $row['username'];
			$hash = md5(sha1(time()));
			$body = "Hello $name,<br><br>Password reset was requested for the account associated with this email.<br><br>If this is you, please follow the link below to complete your password reset:";
			$body .= "<div style='padding:15px;font-weight:bold;'><a href='".$this->dlink()."/users/mint?hash=$hash&action=minipass&email=$email'>Reset Password</a></div><br><br>";
			$body .= "If this was not you, <a href=\"".$this->dlink()."/users/mint?action=freeze&email=$email\" style=\"font-weight:bold;color:blue;\">click here</a> to freeze your account and prevent unauthorized access.<br><br><strong>~Smurf Village FX</strong><br><br>";
			$this->SVFXMailRobotv1("Password Reset", $email, $name, $body);
			$this->query("UPDATE login SET hash=\"$hash\" WHERE email=\"$email\"");
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Request sent to your registered email.</div>";
			header("location: login");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Email not found!</div>";
			header("location: login");
			exit;
		}
	}
	public function forgotPasswordAdmin($email){
		$query = $this->query("SELECT * FROM admins WHERE email=\"$email\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			$name = $row['name'];
			$hash = md5(sha1(time()));
			$body = "Hello $name,<br><br>Password reset was requested for the account associated with this email.<br><br>If this is you, please follow the link below to complete your password reset:";
			$body .= "<div style='padding:15px;font-weight:bold;'><a href='".$this->dlink()."/admin/mint?hash=$hash&action=minipass&email=$email'>Reset Password</a></div><br><br>";
			$body .= "If this was not you, you can ignore this message.<br><br><strong>~".$this->appName()."</strong><br><br>";
			$this->SVFXMailRobotv1("Password Reset", $email, $name, $body);
			$this->query("UPDATE admins SET hash=\"$hash\" WHERE email=\"$email\"");
			$response['status'] = 1;
			$response['message'] = "Password reset mail sent. Follow the link sent to your mail to reset your password.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Email not found!";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function miniPass($hash, $email){
		$query = $this->query("SELECT * FROM login WHERE email=\"$email\" && hash=\"$hash\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			$_SESSION['userID'] = $row['id'];
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Create new password now!</div>";
			header("location: minipass");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Reset link expired!</div>";
			header("location: login");
			exit;
		}
	}
	public function updatePass($password){
		$uid = $_SESSION['userID'];
		$password = sha1($password);
		$hash = md5(sha1(time()));
		$query = $this->query("UPDATE login SET password=\"$password\" WHERE id=\"$uid\"");
		if($query){
			$this->query("UPDATE login SET hash=\"$hash\" WHERE id=\"$uid\"");
		    $date = date("d D M Y h:iA");
			$actionz = "Updated account password on ".$date;
			$this->userLog($uid, $actionz);
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Account updated.</div>";
			header("location: dashboard");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Error updating password, please try again.</div>";
			header("location: minipass");
			exit;
		}
	}
	public function profile($id){
		$query = $this->query("SELECT * FROM login WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function admin($id){
		$query = $this->query("SELECT * FROM admins WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function admins(){
		$query = $this->query("SELECT * FROM admins");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function restrictAdmin($id){
		$query = $this->query("UPDATE admins SET status=1 WHERE id=\"$id\"");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Account restricted.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function releaseAdmin($id){
		$query = $this->query("UPDATE admins SET status=0 WHERE id=\"$id\"");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Account restored.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function updateAdmin($name, $password, $id){
		if(!empty($password)){
			$pwd = sha1($password);
			$this->query("UPDATE admins SET password=\"$pwd\" WHERE id=\"$id\"");
			$msg = " and password";
		}
		$query = $this->query("UPDATE admins SET name=\"$name\" WHERE id=\"$id\"");
		if($query){
			$msgz = "Successfully updated your name";
			$msgx = $msgz.$msg;
			$response['status'] = 1;
			$response['message'] = $msgx.".";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function deleteAdmin($id){
		$query = $this->query("DELETE FROM admins WHERE id=\"$id\"");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Account deleted successfully.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function uniqueKey(){
		return strtoupper(bin2hex(random_bytes(6)));
	}
	public function newProduct($title, $price, $discount, $details, $cat, $stock, $img, $feats, $feat, $specs, $spec){
		$productCode = sha1($this->uniqueKey().time());
		$date = date("d D M Y h:iA");
		$slug = $this->fuckpbnl($title).$productCode;
		for($i=0;$i<count($img['name']);$i++){
			$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"][$i]);
			//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
			$ar = explode('.', $img['name'][$i]);
			$fileExt = end($ar);
			$filename = md5($img['name'][$i].date('Ymd').time().'-').".".$fileExt;
			$target = "../media/".$filename;
			if(move_uploaded_file($img['tmp_name'][$i], $target)){
				$fem = $this->dlink()."/media/".$filename;
				$this->query("INSERT INTO images(product_code, imgurl)VALUES(\"$productCode\", \"$fem\")");
			}
		}
		for($i=0;$i<count($specs);$i++){
			$vlu = $spec[$i];
			$ttl = $specs[$i];
			$this->query("INSERT INTO specs(product_code, title, value)VALUES(\"$productCode\",\"$ttl\",\"$vlu\")");
		}
		for($i=0;$i<count($feats);$i++){
			$vlu = $feat[$i];
			$ttl = $feats[$i];
			$this->query("INSERT INTO feature(product_code, title, value)VALUES(\"$productCode\",\"$ttl\",\"$vlu\")");
		}
		$query = $this->query("INSERT INTO products(title, price, discount, category, product_code, details, stock, slug, uploaded)VALUES(\"$title\", \"$price\", \"$discount\", \"$cat\", \"$productCode\", \"$details\", \"$stock\", \"$slug\", \"$date\")");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Product added successfully";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed, please try again later.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function checkCat($slug){
		$query = $this->query("SELECT * FROM categories WHERE slug=\"$slug\"");
		return $this->num_rows($query);
	}
	public function newCategory($title, $parent, $img){
		$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"][$i]);
		//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
		$ar = explode('.', $img['name']);
		$fileExt = end($ar);
		$filename = md5($img['name'].date('Ymd').time().'-').".".$fileExt;
		$target = "../media/".$filename;
		if($parent > 0){
			$slug = $parent."-".$this->fuckpbnl($title);
		}else{
			$slug = $this->fuckpbnl($title);
		}
		if($this->checkCat($slug)>0){
			$response['status'] = 0;
			$response['message'] = "Category exists!";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
		if(move_uploaded_file($img['tmp_name'], $target)){
			$fem = $this->dlink()."/media/".$filename;
			$this->query("INSERT INTO images(product_code, imgurl)VALUES(\"$title\", \"$fem\")");
		}else{
			$response['status'] = 0;
			$response['message'] = "Unable to add category, image upload failed";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
		$query = $this->query("INSERT INTO categories(title, img, parent, slug)VALUES(\"$title\", \"$fem\", \"$parent\", \"$slug\")");
		if($query){
			$response['status'] = 1;
			$response['message'] = "Category created successfully";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function getCategories(){
		$query = $this->query("SELECT * FROM categories WHERE parent=0");
		while($rows = $this->fetch_array($query)){
			$data[] = $rows;
		}
		return $data;
	}
	public function getParentCategory($id){
		$query = $this->query("SELECT * FROM categories WHERE parent=\"$id\"");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function products($page, $limit){
		$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	    if($page == ""){
	        $page = 1;
	    }
	    $startpoint = ($page * $limit) - $limit;
		$query = $this->query("SELECT * FROM products ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
		while($row = $this->fetch_array($query)){
	    	$data[] = $row;
	    }
	    return $data;
	}
	public function getProduct($productCode){
		$query = $this->query("SELECT * FROM products WHERE product_code=\"$productCode\"");
		return $this->fetch_array($query);
	}
	public function getImages($code){
		$query = $this->query("SELECT * FROM images WHERE product_code=\"$code\"");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function getFeatures($code){
		$query = $this->query("SELECT * FROM feature WHERE product_code=\"$code\"");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function getSpecs($code){
		$query = $this->query("SELECT * FROM specs WHERE product_code=\"$code\"");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function inStock($page, $limit){
		$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	    if($page == ""){
	        $page = 1;
	    }
	    $startpoint = ($page * $limit) - $limit;
		$query = $this->query("SELECT * FROM products WHERE status=0 ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
		while($row = $this->fetch_array($query)){
	    	$data[] = $row;
	    }
	    return $data;
	}
	public function outStock($page, $limit){
		$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	    if($page == ""){
	        $page = 1;
	    }
	    $startpoint = ($page * $limit) - $limit;
		$query = $this->query("SELECT * FROM products WHERE status=1 ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
		while($row = $this->fetch_array($query)){
	    	$data[] = $row;
	    }
	    return $data;
	}
	public function deleteProduct($id){
		$query = $this->query("DELETE FROM products WHERE product_code=\"$id\"");
		if($query){
			$this->query("DELETE FROM feature WHERE product_code=\"$id\"");
			$this->query("DELETE FROM specs WHERE product_code=\"$id\"");
			$this->deleteImage($id);
			$response['status'] = 1;
			$response['message'] = "Product deleted successfully";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['message'] = "Product deletion failed, please try again";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function deleteImage($code){
		$query = $this->query("SELECT * FROM images WHERE product_code=\"$code\"");
		while($row = $this->fetch_array($query)){
			$imgUrl = $row['imgurl'];
			$epa = str_replace($this->dlink()."/", "", $imgUrl);
			unlink("../".$epa);
		}
		$this->query("DELETE FROM images WHERE product_code=\"$code\"");
	}
	public function editProduct($title, $price, $discount, $details, $cat, $stock, $img, $feats, $feat, $specs, $spec, $deleteImg, $deleteft, $deletesp, $productCode){
		$delImg = substr($deleteImg, 0, -1);
		$delTft = substr($deleteft, 0, -1);
		$delSp = substr($deletesp, 0, -1);
		$imgAr = explode(',', $delImg);
		$ftAr = explode(',', $delTft);
		$spAr = explode(',', $delSp);
		for($i=0;$i<count(array($img['name']));$i++){
			$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"][$i]);
			//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
			$ar = explode('.', $img['name'][$i]);
			$fileExt = end($ar);
			$filename = md5($img['name'][$i].date('Ymd').time().'-').".".$fileExt;
			$target = "../media/".$filename;
			if(move_uploaded_file($img['tmp_name'][$i], $target)){
				$fem = $this->dlink()."/media/".$filename;
				$this->query("INSERT INTO images(product_code, imgurl)VALUES(\"$productCode\", \"$fem\")");
			}
		}
		for($i=0;$i<count(array($specs));$i++){
			$vlu = $spec[$i];
			$ttl = $specs[$i];
			if(!empty($ttl)){
			$this->query("INSERT INTO specs(product_code, title, value)VALUES(\"$productCode\",\"$ttl\",\"$vlu\")");
			}
		}
		for($i=0;$i<count(array($feats));$i++){
			$vlu = $feat[$i];
			$ttl = $feats[$i];
			if(!empty($ttl)){
			$this->query("INSERT INTO feature(product_code, title, value)VALUES(\"$productCode\",\"$ttl\",\"$vlu\")");
			}
		}
		$query = $this->query("UPDATE products SET title=\"$title\", price=\"$price\", discount=\"$discount\", category=\"$cat\", details=\"$details\", stock=\"$stock\" WHERE product_code=\"$productCode\"");
		if($query){
			for($i=0;$i<count(array($imgAr));$i++){
				$id = $imgAr[$i];
				$qx = $this->query("SELECT * FROM images WHERE id=\"$id\"");
				$rx = $this->fetch_array($qx);
				$imgUrl = $rx['imgurl'];
				$epa = str_replace($this->dlink()."/", "", $imgUrl);
				$this->query("DELETE FROM images WHERE id=\"$id\"");
				if(!empty($epa)){
					unlink("../".$epa);
				}
			}
			for($i=0;$i<count(array($ftAr));$i++){
				$id = $ftAr[$i];
				$this->query("DELETE FROM feature WHERE id=\"$id\"");
			}
			for($i=0;$i<count(array($spAr));$i++){
				$id = $spAr[$i];
				$this->query("DELETE FROM specs WHERE id=\"$id\"");
			}
			$response['status'] = 1;
			$response['message'] = "Product updated successfully.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}else{
			$response['status'] = 0;
			$response['message'] = "Operation failed, please try again later.";
			header('Content-Type: application/json');
			echo json_encode($response, true);
			exit;
		}
	}
	public function updatePassword($password){
		$uid = $_SESSION['userID'];
		$password = sha1($password);
		$query = $this->query("UPDATE login SET password=\"$password\" WHERE id=\"$uid\"");
		if($query){
		    $date = date("d D M Y h:iA");
			$actionz = "Updated account password on ".$date;
			$this->userLog($uid, $actionz);
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Password updated successfully!</div>";
			header("location: settings");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Operation failed!</div>";
			header("location: settings");
			exit;
		}
	}
	public function updateUser($firstname, $lastname, $phone, $country, $city, $telegram){
		$uid = $_SESSION['userID'];
		$query = $this->query("UPDATE login SET firstname=\"$firstname\", lastname=\"$lastname\", phone=\"$phone\", country=\"$country\", city=\"$city\", telegram=\"$telegram\" WHERE id=\"$uid\"");
		if($this->affected_rows($query)>0){
		    $date = date("d D M Y h:iA");
			$actionz = "Updated account information on ".$date;
			$this->userLog($uid, $actionz);
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Account updated successfully!</div>";
			header("location: settings");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Operation failed!</div>";
			header("location: settings");
			exit;
		}
	}
	public function adminLogout(){
		unset($_SESSION['adminID']);
		unset($_SESSION['userID']);
		$past = time() - 100;
		setcookie('username', 'gone', $past);
		header("location: ../");
	}
	public function userLogout(){
		unset($_SESSION['adminID']);
		unset($_SESSION['userID']);
		$past = time() - 100;
		setcookie('username', 'gone', $past);
		header("location: ../");
	}
	public function catHasChild($id){
		$query = $this->query("SELECT * FROM categories WHERE parent=\"$id\"");
		return $this->num_rows($query);
	}
}
$db = new MySQLiDatabase();
?>