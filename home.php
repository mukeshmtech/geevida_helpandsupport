<?php 
$title = 'Home'; 
require_once('inc/define.php');
if(!isset($_SESSION['UserId'])){
   echo "<script>window.location.href='index.php'</script>"; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php require_once('inc/header-link.php'); ?>
      <style type="text/css">
         .ad-listing .content-area .ad-stats span.price{
            color:#dc832a ;
         }
         .no-padding{
            padding: 0px
         }
         .fav-btn{
            font-size:24px;
         }
      </style>
   </head>
   <body>
      <!-- =-=-=-=-=-=-= Main Header =-=-=-=-=-=-= -->
      <?php require_once('inc/header.php'); ?>
      <!-- =-=-=-=-=-=-= Main Header =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Background Rotator =-=-=-=-=-=-= -->
      <?php require_once('inc/slider.php'); ?>
      <!-- =-=-=-=-=-=-= Background Rotator End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="white" style="padding: 30px 0;">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
          <!-- =-=-=-=-=-=-= Call to Action =-=-=-=-=-=-= -->
         <div class="parallex bg-img-3 section-padding">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 col-sm-12">
                     <div class="call-action">
                        <i class="flaticon-like-1"></i>
                        <h4>Post featured ad and get great exposure </h4>
                        <p>Feel free to post your featured ad and get great exposure.</p>
                     </div>
                     <!-- end subsection-text -->
                  </div>
                  <!-- end col-md-8 -->
                  <div class="col-md-4 col-sm-12">
                     <div class="parallex-button"> <a href="post-ad.php" class="btn btn-theme">Post Free Ad <i class="fa fa-angle-double-right "></i></a> </div>
                     <!-- end parallex-button -->
                  </div>
                  <!-- end col-md-4 -->
               </div>
               <!-- end row -->
            </div>
            <!-- end container -->
         </div>
         <!-- =-=-=-=-=-=-= Call to Action =-=-=-=-=-=-= -->
         <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
         <?php require_once('inc/footer.php'); ?>
         <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
      </div>
      <?php require_once('inc/quick-view-model.php'); ?>
      <?php require_once('inc/footer-link.php'); ?>
   </body>
</html>