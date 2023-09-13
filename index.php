<?php
$title = 'Login'; 
require_once('inc/define.php');
if(isset($_SESSION['UserId'])){
   echo "<script>window.location.href='home.php'</script>"; 
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php require_once('inc/header-link.php'); ?>
      <style type="text/css">
         .btn-block{
            color: #333;
         }
        
      </style>
   </head>
   <body>
      <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
      <div class="preloader"></div>
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding no-top gray frm-abs">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                     <!--  Form -->
                     <div class="text-center">
                        <img src="img/geevida-logo.png" alt="logo" id="lgn-logo">
                     </div>
                     <div class="form-grid">
                        <form id="ghs_loginForm" method="post" action="<?php echo baseUrl; ?>index.php">
                          <h2 class="no-span"><b>LOGIN</b></h2>
                              
                           <div role="alert" class="alert alert-danger alert-dismissible" id="alertmsg" style="display:none;">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Failed</strong> - Invalid user name  and password
                           </div>

                           <div class="form-group">
                              <label for="user">Usermail <span class="req">*</span></label>
                              <input type="text" name="usermail" id="usermail" class="form-control" placeholder="Usermail"  required>
                           </div>
                           <div class="form-group">
                              <label for="pass">Password <span class="req">*</span></label>
                              <input type="password" name="userpass" id="userpass" class="form-control"  placeholder="Password" required>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <div class="skin-minimal text-left">
                                       <a data-target="#myModal" data-toggle="modal" class="text-success">Forgot Password..?</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                                    <button type="submit" class="btn btn-success" id="ghs_login_btn">Login</button> (OR)
                                    <button type="button" class="btn btn-info" id="ghs_register_btn">Create New Account</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                     <!-- Form -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
      </div>
      <!-- Forget Password -->
      <?php require_once('inc/forgot-pass-model.php'); ?>
      <!-- Main Content Area End --> 
      <?php require_once('inc/footer-link.php'); ?>
   </body>
</html>
