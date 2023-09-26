<?php
$config = (file_exists("inc/config.php"))?"inc/config.php":"../inc/config.php";
require_once($config);
class AdClass extends DBController{

	private $conn;

	public function __construct(){
		$this->conn = new DBController();
	}

	public function creatTicket($user_id,$tic_subject,$tic_content,$additonal_file=""){
		
		$input=[
			"user_id"=>$user_id,
			"tic_subject"=>$tic_subject,
			"tic_content"=>$tic_content,
			"additonal_file"=>$additonal_file
		];

		$data = $this->conn->filterPost($input); 

		$ins = $this->conn->mysqli->prepare("INSERT INTO ghs_user_tickets (ghs_ticket_user_id, ghs_ticket_subject, ghs_ticket_content, ghs_ticket_attachement) VALUES (? ,? ,? ,? )");
		$ins->bind_param("ssss", $data['user_id'], $data['tic_subject'], $data['tic_content'], $data['additonal_file']);
		
		if($ins->execute()){
			$res=1;
		}
		else{
			$res=0;
		}

		return $res;
	}

	public function adList($uId){
		$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId, ifnull(uf.favId, 0) AS favId FROM adsmst AS ad INNER JOIN usermst AS user ON user.UserId=ad.adPostBy LEFT JOIN userfav AS uf ON uf.favUserId=".$uId." AND uf.favAdId=ad.adId WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' ORDER BY ad.adCrDt DESC");
		return $data;
	}

	public function filterAdList($uId, $fltr){
		$fltr = $this->conn->filter($fltr);
		if(substr($fltr, 0, 1) == '#'){
			$fltr = ltrim($fltr, '#');
			$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId, ifnull(uf.favId, 0) AS favId FROM adsmst AS ad INNER JOIN usermst AS user ON user.UserId=ad.adPostBy LEFT JOIN userfav AS uf ON uf.favUserId=".$uId." AND uf.favAdId=ad.adId WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' AND ad.adTags LIKE '%".$fltr."%' ORDER BY ad.adCrDt DESC");
		}
		else{
			$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId, ifnull(uf.favId, 0) AS favId FROM adsmst AS ad INNER JOIN usermst AS user ON user.UserId=ad.adPostBy LEFT JOIN userfav AS uf ON uf.favUserId=".$uId." AND uf.favAdId=ad.adId WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' AND ad.adTitle LIKE '%".$fltr."%' ORDER BY ad.adCrDt DESC");
		}
		return $data;
	}

	public function adFavList($uId){
		$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId, uf.favId FROM userfav AS uf INNER JOIN adsmst AS ad ON uf.favUserId=".$uId." AND uf.favAdId=ad.adId INNER JOIN usermst AS user ON user.UserId=ad.adPostBy WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' ORDER BY uf.favCrDt DESC");
		return $data;		
	}

	public function myAds($uId){
		$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId FROM adsmst AS ad INNER JOIN usermst AS user ON user.UserId=ad.adPostBy WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' AND ad.adPostBy=".$uId." ORDER BY ad.adCrDt DESC");
		return $data;
	}

	public function getAdDetailById($adId){
		$id = $this->conn->filter($adId); $data ="";
		if(is_numeric($adId)){

			$data = $this->conn->getArray("SELECT ad.*,user.UserName,user.UserId FROM adsmst AS ad INNER JOIN usermst AS user ON user.UserId=ad.adPostBy WHERE user.UserActive=1 AND ad.adActive='A' AND ad.adStatus='A' AND ad.adId=".$adId);

		}
		return $data;
	}

	public function getTotAdCount(){
		$data = $this->conn->getRow("SELECT COUNT(1) AS totAdd FROM adsmst WHERE adActive='A' AND adStatus='A'");
		$data = json_decode($data);
		return $data->totAdd;
	}

	public function getAllAds(){
		$ads = $this->conn->getArray("SELECT *, UserName, UserId FROM adsmst LEFT JOIN usermst ON UserId = adPostBy WHERE adStatus = 'A' ORDER BY adId DESC");
		return $ads;
	}

	public function setAddActiveD($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins1->bind_param("i", $id);
		if($ins1->execute()){
			$data = 1;
		}
		$ins1 = $this->conn->mysqli->prepare("UPDATE adsmst SET adActive='D' WHERE adId=?");

		return $data;
	}

	public function setAddActiveA($id){
		$id = $this->conn->filter($id); $data = 0;
		$ins1 = $this->conn->mysqli->prepare("UPDATE adsmst SET adActive='A' WHERE adId=?");
		$ins1->bind_param("i", $id);
		if($ins1->execute()){
			$data = 1;
		}

		return $data;
	}

	


} 