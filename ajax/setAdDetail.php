<?php 
require_once("../class/AdClass.php");
$data = '';
if(isset($_POST['adId'])){
	$AdClass = new AdClass();
	$detail = $AdClass->getAdDetailById($_POST['adId']);
	$detail = json_decode($detail);

	foreach ($detail as $ad) { 
		$postDate = strtotime($ad->adCrDt); $photos = explode(",", $ad->adPhotos); $ctPhotos = count($photos);
        $frontImage = (isset($photos[0]))?$photos[0]:'NoImg.jpg'; $tags = explode(",", $ad->adTags);

?>
		<div class="diblock">
         <div class="col-lg-7 col-sm-12 col-xs-12">
            <div class="clearfix"></div>
            <div id="single-slider" class="flexslider">
               <ul class="slides">
                  <?php foreach ($photos as $key => $value) {
                     echo '<li><img alt="img" src="uploads/'.$value.'" /></li>';
                  } ?>
               </ul>
            </div>
         </div>
         <div class=" col-sm-12 col-lg-5 col-xs-12">
            <div class="summary entry-summary">
               <div class="ad-preview-details">
                  <a href="#">
                     <h4><?php echo $ad->adTitle; ?></h4>
                  </a>
                  <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6 no-padding">
                     <strong>
                        <i class="fa fa-user"></i> 
                        <a style="color: #333;text-transform: capitalize;" href="profile.php?id=<?php echo $ad->UserId; ?>"><?php echo $ad->UserName; ?></a>
                     </strong>
                  </div>
                  <div class="col-md- col-sm-3 col-lg-3 col-xs-3 no-padding">
                     <?php echo date('d-M-Y',$postDate) ?></div><div class="col-md-3 col-sm-3 col-lg-3 col-xs-3 no-padding"><?php echo date('h:i a',$postDate) ?></div>
                  <div class="overview-price">
                     <span><i style="font-size: 19px;" class="fa fa-inr" aria-hidden="true"></i><?php echo $ad->adPrice; ?></span>
                  </div>
                  <div class="clearfix"></div>
                  <p><?php echo $ad->adDesc; ?> <br>
                     <?php foreach ($tags as $key => $value) {
                           echo '<a href="javascript:void(0);"> #'.$value.'</a>';
                     } ?>
                  </p>
                  <ul class="ad-preview-info col-md-6 col-sm-6">
                     <li>
                        <span>Condition :</span>
                        <p><?php echo ($ad->adCondition == 'U')?'USED':'NEW'; ?></p>
                     </li>
                     <li>
                        <span>AdType :</span>
                        <p><?php echo ($ad->adType == 'S')?'Sale':'Buy'; ?></p>
                     </li>
                     <li>
                        <span>Quality :</span>
                        <p><?php echo $ad->adQuality; ?></p>
                     </li>
                     <li>
                        <span>Quantity :</span>
                        <p><?php echo $ad->adQuantity.' '.$ad->adUnit; ?></p>
                     </li>
                  </ul>
                  <ul class="ad-preview-info col-md-6 col-sm-6">
                     <li>
                        <span>Name :</span>
                        <p><?php echo $ad->adUName; ?></p>
                     </li>
                     <li>
                        <span>Mail :</span>
                        <p><?php echo $ad->adMail; ?></p>
                     </li>
                     <li>
                        <span>Phone :</span>
                        <p><?php echo $ad->adPhone; ?></p>
                     </li>
                     <li>
                        <span>Address :</span>
                        <p><?php echo $ad->adAddr; ?></p>
                     </li>
                  </ul>
                  <a href="profile.php?id=<?php echo $ad->UserId; ?>"><button class="btn btn-theme btn-block">Contact Dealer</button></a>
               </div>
            </div>
            <!-- .summary -->
         </div>
      </div>
<?php
	}

}
