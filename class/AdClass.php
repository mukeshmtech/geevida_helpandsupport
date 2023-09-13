<?php
$config = (file_exists("inc/config.php"))?"inc/config.php":"../inc/config.php";
require_once($config);
class AdClass extends DBController{

	private $conn;

	public function __construct(){
		$this->conn = new DBController();
	}

	public function postAd(){
		$photo = $_FILES['phtos']; $cnt = count($photo['name']); $filename1= date('Ymdhsi').'user'.$_SESSION['UserId']; $photos = '';
		$extension = array('jpeg' ,'jpg', 'png' ); $arr = array();

		for ($i=0; $i < $cnt; $i++) { 
			$imgName = $photo['name'][$i]; $imgTempName = $photo['tmp_name'][$i]; $imgSize = $photo['size'][$i]; $imgType = $photo['type'][$i];
			$exp = explode('.', $imgName);
			$ext = end($exp);
			$filename = $filename1.'img'.$i.'.'.$ext;
			if(in_array(strtolower($ext), $extension) === false){
				$_SESSION['status']= 'Failed';
				$_SESSION['msg']   = 'Please upload .jpg or .png file..';
				$arr['location']   = 'post-ad.php'; $i = $cnt; $photos ='0';
			} 
			elseif($imgSize > 2097152){
				$_SESSION['status']= 'Failed';
				$_SESSION['msg']   = 'Image size must be lessthen 2MB..';
				$arr['location']   = 'post-ad.php'; $i = $cnt; $photos ='0';
			} 
			else{
				move_uploaded_file($imgTempName, 'uploads/'.$filename);
				$photos .= $filename.',';
			}
		}
		$photos = rtrim($photos, ",");
		
		if($photos != '0'){
			$data = $this->conn->filterPost(); 
			$ins = $this->conn->mysqli->prepare("INSERT INTO adsmst (adTitle, adQuality, adQuantity, adUnit, adPrice, adPhotos, adDesc, adTags, adType, adCondition, adUName, adMail, adPhone, adAddr, adCrDt, adPostBy) VALUES (? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?, ?, ? ,now() ,'".$_SESSION['UserId']."')");
			$ins->bind_param("ssssisssssssss", $data['prd-title'], $data['prd-qlt'], $data['prd-qty'], $data['prd-unit'], $data['prd-price'], $photos , $data['prd-desc'], $data['tags'], $data['ad-type'], $data['prd-cond'], $data['prd-name'], $data['ctr-mail'], $data['prd-num'], $data['prd-addr']);
			

			if($ins->execute()){
				$_SESSION['status']= 'Success';
				$_SESSION['msg']   = 'Post uploaded Successfully..';
				$arr['location']   = 'home.php';
			}
			else{
				$_SESSION['status']= 'Failed';
				$_SESSION['msg']   = 'Something Went Wrong..';
				$arr['location']   = 'post-ad.php';
			}
		}

		return $arr;
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
		$ins1 = $this->conn->mysqli->prepare("UPDATE adsmst SET adActive='D' WHERE adId=?");
		$ins1->bind_param("i", $id);
		if($ins1->execute()){
			$data = 1;
		}

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