<?php $title = 'Create New ticket'; require_once('inc/define.php');
if(!isset($_SESSION['UserId'])){
   echo "<script>window.location.href='index.php'</script>"; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   
<head>
      <?php require_once('inc/header-link.php'); ?>
      <link rel="stylesheet" href="css/dropzone.css">
      <link href="css/jquery.tagsinput.min.css" rel="stylesheet">
   </head>
   <body>
      <!-- =-=-=-=-=-=-= Main Header =-=-=-=-=-=-= -->
      <?php require_once('inc/header.php'); ?>
      <!-- =-=-=-=-=-=-= Main Header =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Breadcrumb =-=-=-=-=-=-= -->
      <div class="page-header-area-2 gray">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="small-breadcrumb">
                     <div class="breadcrumb-link">
                        <ul>
                           <li><a href="index.html">Home Page</a></li>
                           <li><a class="active" href="#">Create New ticket</a></li>
                        </ul>
                     </div>
                     <div class="header-page">
                        <h1>Create New ticket</h1>
                        <?php if(isset($_SESSION['status'])){
                              $class = ($_SESSION['status'] == 'Success')?'success':'danger';
                              echo '<div role="alert" class="alert alert-'.$class.' alert-dismissible">
                                 <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                                 <strong>'.$_SESSION['status'].'</strong> - '.$_SESSION['msg'].' 
                              </div>';   
                              unset($_SESSION['status']); unset($_SESSION['msg']);
                        } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- =-=-=-=-=-=-= Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding no-top gray justify-content-center">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  
                  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                     <!-- end post-padding -->
                     <div class="post-ad-form postdetails">
                        
                        <form id="submit-ticket-form" class="submit-form" method="POST" enctype="multipart/form-data" action="<?php echo baseUrl; ?>create-your-ticket.php">
                           <!-- Subject  -->
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label for="tic_subject" class="control-label">Ticket Subject <span class="req">*</span></label>
                                 <input name="tic_subject" id="tic_subject" class="form-control" placeholder="Ticket Subject" type="text" required>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <label for="tic_content" class="control-label">Ticket Content <span class="req">*</span></label>
                                 <textarea name="tic_content" id="tic_content" rows="5" class="form-control" placeholder="Ticket Content" required></textarea>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <!-- File Upload  -->
                                 <label for="additonal_file" class="control-label">Additional Attachement <span class="text-danger">(* Not more than 500kb)</span></label>
                                 <input type="file" name="additonal_file" id="additonal_file" class="form-control">
                                 <p id="error-message" class="text-danger"></p>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                 <input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['UserId']; ?>">
                                 <button type="submit" id="post_ticket_btn" class="btn btn-theme" >Post ticket</button>
                              </div>
                           </div>
                        </form>

                     </div>
                     <!-- end post-ad-form-->
                  </div>
                  <!-- Sidebar Widgets End -->
               </div>
               <!-- Middle Content Area  End --><!-- end col -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
         <?php require_once('inc/footer.php'); ?>
         <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
      </div>
      <!-- Main Content Area End --> 
      <?php require_once('inc/footer-link.php'); ?>
      <!-- JS -->
   </body>

</html>

