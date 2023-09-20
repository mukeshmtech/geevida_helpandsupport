<?php
$config = (file_exists("inc/config.php"))?"inc/config.php":"../inc/config.php";
require_once($config);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class UserClass extends DBController{

	private $conn;

	public function __construct(){
		$this->conn = new DBController();
	}

	public function getStatesList(){

		$qry  = $this->conn->getArray("SELECT * FROM ghs_states WHERE status=1");
		$stateList = json_decode($qry);
		return $stateList;
	}

	public function registerUser($username,$useremail,$password,$mobile,$dob,$gender,$state,$city){
		
		$input=[
				"username"=>$username,
				"useremail"=>$useremail,
				"password"=>$password,
				"mobile"=>$mobile,
				"dob"=>$dob,
				"gender"=>$gender,
				"state"=>$state,
				"city"=>$city,
			];

		$data = $this->conn->filterPost($input); 
		$chk  = $this->conn->runQuery("SELECT COUNT(1) AS cnt FROM ghs_user WHERE UserMail='".$data['useremail']."'");
		$key  = $chk->fetch_assoc();
		$pass= md5($data['password']);

		if($key['cnt'] == 0){
			$ins = $this->conn->mysqli->prepare("INSERT INTO ghs_user (UserName, UserMail, UserPass, UserMob, UserDOB, UserGend, UserState, UserCity, UserCrDate, UserActive, UserType) VALUES (? ,? ,? ,? ,? ,? ,? ,?,now() ,'1' ,'C')");
			$ins->bind_param("ssssssss", $data['username'], $data['useremail'], $pass, $data['mobile'], $data['dob'], $data['gender'], $data['state'], $data['city']);
			
			if($ins->execute()){
				$res=1;
			}
			else{
				$res=0;
			}
		}
		else{
			$res=2;
		}
		return $res;
	}

	public function loginUser($username,$password){
		$input=["user"=>$username,"pass"=>$password];
		$data = $this->conn->filterPost($input); 
		
		$qry  = $this->conn->getRow("SELECT * FROM ghs_user WHERE UserMail='".$data['user']."' AND UserPass='".md5($data['pass'])."' AND UserActive='1'");

		$userData = json_decode($qry);
		
		if($userData){
			$res=1;
			$_SESSION['UserId']= $userData->UserId;
			$_SESSION['UserName']= $userData->UserName;
			$_SESSION['UserMob']= $userData->UserMob;
			$_SESSION['UserMail']= $userData->UserMail;
			$_SESSION['UserGend']= $userData->UserGend;
			$_SESSION['UserDOB']= $userData->UserDOB;
			$_SESSION['UserState']= $userData->UserState;
			$_SESSION['UserCity']= $userData->UserCity;
			$_SESSION['UserCrDate']= $userData->UserCrDate;
			$_SESSION['UserActive']= $userData->UserActive;
			$_SESSION['UserType']= $userData->UserType;
		}
		else
		{
			$res=0;
		}

		return $res;
	}

	public function logout(){
		$arr = array();
		session_unset();
		session_destroy();
		$arr['location']   = 'index.php';
		return $arr;		
	}

	public function getUserDetails($id){
		$data = $this->conn->getRow("SELECT * FROM usermst WHERE UserId=".$id);
		return $data;
	}

	public function updateMyInfo($id){
		$data = $this->conn->filterPost(); $arr = array();
		$chk  = $this->conn->runQuery("SELECT COUNT(1) AS cnt FROM usermst WHERE UserPass='".md5($data['opassword'])."' AND UserId =".$id);
		$key  = $chk->fetch_assoc();
		if($key['cnt'] == 1){
			if(md5($data['npassword']) == md5($data['cpassword'])){
				$chk  = $this->conn->runQuery("SELECT COUNT(1) AS cnt FROM usermst WHERE UserUName='".$data['username']."' AND UserId !=".$id);
				$key  = $chk->fetch_assoc();
				if($key['cnt'] == 0){
					$pass= md5($data['npassword']);
					$ins = $this->conn->mysqli->prepare("UPDATE usermst SET UserName=?, UserUName=? , UserPass=?, UserMob=?, UserMail=?, UserGend=?, UserDOB=?, UserState=?, UserCity=?, UserAddr=?, UserCrDate=now() WHERE UserId=".$id);
					$ins->bind_param("ssssssssss", $data['name'], $data['username'], $pass, $data['mobile'], $data['email'], $data['gender'], $data['dob'], $data['state'], $data['city'], $data['address']);
					
					if($ins->execute()){
						$_SESSION['UserName']= $data['name'];
						$_SESSION['UserUName']= $data['username'];
						$_SESSION['UserPass']= $pass;
						$_SESSION['UserMob']= $data['mobile'];
						$_SESSION['UserMail']= $data['email'];
						$_SESSION['UserGend']= $data['gender'];
						$_SESSION['UserDOB']= $data['dob'];
						$_SESSION['UserState']= $data['state'];
						$_SESSION['UserCity']= $data['city'];
						$_SESSION['UserAddr']= $data['address'];
						$_SESSION['status']= 'Success';
						$_SESSION['msg']   = 'Profil updated Successfully..';
						$arr['location']   = 'profile.php';
					}
					else{
						$_SESSION['status']= 'Failed';
						$_SESSION['msg']   = 'Something Went Wrong..';
						$arr['location']   = 'profile.php';
					}
				}
				else{
					$_SESSION['status']= 'Failed';
					$_SESSION['msg']   = 'Username Already Exist..';
					$arr['location']   = 'profile.php';
				}
			}
			else{
				$_SESSION['status']= 'Failed';
				$_SESSION['msg']   = 'New password & Confirm password not match..';
				$arr['location']   = 'profile.php';
			}
		}
		else{
			$_SESSION['status']= 'Failed';
			$_SESSION['msg']   = 'Old password is Wrong..';
			$arr['location']   = 'profile.php';
		}
		return $arr;
	}

	public function setFav($adId, $uId){
		$adId = $this->conn->filter($adId); $uId = $this->conn->filter($uId); $data = 0;
		$ins = $this->conn->mysqli->prepare("INSERT INTO userfav (favUserId, favAdId, favCrDt) VALUES (? ,? , now())");
		$ins->bind_param("ii", $uId, $adId);
		if($ins->execute()){
			$data = 1;
		}
		return $data;
	}

	public function remFav($adId, $uId){
		$adId = $this->conn->filter($adId); $uId = $this->conn->filter($uId); $data = 0;
		$ins = $this->conn->mysqli->prepare("DELETE FROM userfav WHERE favUserId=? AND favAdId=?");
		$ins->bind_param("ii", $uId, $adId);
		if($ins->execute()){
			$data = 1;
		}
		return $data;
	}

	public function removeAd($adId, $uId){
		$adId = $this->conn->filter($adId); $uId = $this->conn->filter($uId); $data = 0;
		$ins = $this->conn->mysqli->prepare("UPDATE adsmst SET adStatus='D' WHERE adPostBy=? AND adId=?");
		$ins->bind_param("ii", $uId, $adId);
		if($ins->execute()){
			$data = 1;
		}
		return $data;
	}

	public function getAllUsers(){
		$users = $this->conn->getArray("SELECT a.* , COUNT(1) AS favs FROM (SELECT  UserId, UserName, UserMob, UserMail, UserCity, UserActive, COUNT(1) AS ads FROM  usermst LEFT JOIN adsmst ON  UserId = adPostBy AND adStatus = 'A' WHERE UserType!='A' GROUP BY UserId, UserName, UserMob, UserMail, UserCity, UserActive) AS a LEFT JOIN userfav ON favUserId = UserId GROUP BY UserId, UserName, UserMob, UserMail, UserCity, UserActive ORDER BY UserId DESC");
		return $users;
	}

	public function setUserActiveD($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins = $this->conn->mysqli->prepare("UPDATE usermst SET UserActive='0' WHERE UserId=?");
		$ins->bind_param("i", $id);
		$ins1 = $this->conn->mysqli->prepare("UPDATE adsmst SET adActive='D' WHERE adStatus='A' AND adPostBy=?");
		$ins1->bind_param("i", $id);
		if($ins->execute() && $ins1->execute()){
			$data = 1;
		}
		return $data;
	}

	public function setUserActiveA($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins = $this->conn->mysqli->prepare("UPDATE usermst SET UserActive='1' WHERE UserId=?");
		$ins->bind_param("i", $id);
		$ins1 = $this->conn->mysqli->prepare("UPDATE adsmst SET adActive='A' WHERE adStatus='A' AND adPostBy=?");
		$ins1->bind_param("i", $id);
		if($ins->execute() && $ins1->execute()){
			$data = 1;
		}
		return $data;
	}
 
	public function sendFeedback($user){
		$data = $this->conn->filterPost(); $res = 0;
		$ins = $this->conn->mysqli->prepare("INSERT INTO feedback (fbUser,fbNmae,fbMail,fbSub,fbMsg,fbDtTime) VALUES (".$user.",?,?,?,?,now())");
		$ins->bind_param('ssss', $data['name'], $data['email'], $data['subject'], $data['message']);
		if($ins->execute()){
			$res = 1;
		}
		return $res;
	}

	public function getAllfbs(){
		$fbs = $this->conn->getArray("SELECT feedback.*,UserId,UserName FROM feedback LEFT JOIN usermst ON  UserId = fbUser ORDER BY fbId DESC");
		return $fbs;
	}

	public function setFbActiveP($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins = $this->conn->mysqli->prepare("UPDATE feedback SET fbStatus='P' WHERE fbId=?");
		$ins->bind_param("i", $id);
		if($ins->execute() ){
			$data = 1;
		}
		return $data;
	}

	public function setFbActiveV($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins = $this->conn->mysqli->prepare("UPDATE feedback SET fbStatus='V' WHERE fbId=?");
		$ins->bind_param("i", $id);
		if($ins->execute() ){
			$data = 1;
		}
		return $data;
	}

} 