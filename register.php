<?php $title = 'Register'; require_once('inc/define.php'); 
if(isset($_SESSION['UserId'])){
   echo "<script>window.location.href='home.php'</script>"; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php require_once('inc/header-link.php'); ?>
   </head>
   <body>
      <!-- =-=-=-=-=-=-= Preloader =-=-=-=-=-=-= -->
      <div class="preloader"></div>
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Registration Form =-=-=-=-=-=-= -->
         <section class="section-padding no-top gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <div class="col-md-12 col-sm-12">
                     <!--  Form -->
                     <div class="form-grid">
                        <form id="reg-frm" method="POST" action="<?php echo baseUrl; ?>register.php">
                           <div class="text-center">
                              <img src="img/geevida-logo.png" alt="logo" id="lgn-logo">
                           </div>
                           <div role="alert" class="alert alert-danger' alert-dismissible" id="alertMsgReg" style="display:none;">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                                 <span aria-hidden="true">×</span>
                              </button>
                              <strong>Failur</strong> Something wrong..! 
                           </div>
                           <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                              <h2 class="no-span"><b>Register</b></h2>
                           </div>
                           <div class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1">
                              <div class="form-group">
                                 <label for="name">Name <span class="req">*</span></label>
                                 <input placeholder="Your Name" class="form-control" type="text" id="name" name="name" required>
                              </div>
                              <div class="form-group">
                                 <label for="email">Email <span class="req">*</span></label>
                                 <input placeholder="Your Email" class="form-control" type="email" name="usermail" id="usermail">
                              </div>
                              <div for="password" class="form-group">
                                 <label for="password">Password <span class="req">*</span></label>
                                 <input placeholder="Your Password" name="password" id="password" class="form-control" type="password" required>
                              </div>
                              <div class="col-12" id="password-match" style="display:none;">
                                 <h6 class="pt-3 pb-0">Password must contain:</h6>
                                 <ul class="reg-pinfo mb-2">
                                    <li id="p-length" class="text-danger">password length should be between 6-15 characters <i class="fa fa-times"></i></li>
                                    <li id="p-lowercase" class="text-danger">a minimum of 1 lower case letter [a-z] <i class="fa fa-times"></i></li>
                                    <!-- <li>a minimum of 1 upper case letter [A-Z] and</li> -->
                                    <li id="p-number" class="text-danger">a minimum of 1 numeric character [0-9] <i class="fa fa-times"></i></li>
                                    <!-- <li>a minimum of 1 special character: !@#$&*</li> -->
                                    <!-- <li>a minimum of 1 special character: ~`!@#$%^&*()-_+={}[]|\;:"<>,./?</li> -->
                                 </ul>
                              </div>

                              <div class="form-group">
                                 <label for="mobile">Mobile <span class="req">*</span></label>
                                 <input placeholder="Your Mobile Number" class="form-control" type="text" name="mobile" id="mobile" required>
                              </div>
                           </div>
                           <div class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1">
                              <div class="form-group">
                                 <label for="dob">Date Of Birth <span class="req">*</span></label>
                                 <input value="<?php echo date('Y-m-d'); ?>" name="dob" id="dob" class="form-control" type="date" required>
                              </div>
                              <div class="form-group">
                                 <label for="gender">Gender <span class="req">*</span></label>
                                 <select name="gender" id="gender" class="form-control" required>
                                    <option value=''>Select Gender</option>
                                    <option value='M'>Male</option>
                                    <option value='F'>Female</option>
                                    <option value='O'>Others</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="state">State <span class="req">*</span></label>
                                 <select id="state" name ="state" class="form-control">
                                    <option value="">Select state</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="city">City <span class="req">*</span></label>
                                 <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                              </div>
                           </div>
                           <div class="col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2 mt-2">
                              <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="ghs_reg_btn">Complete Register</button> (OR) 
                                    <button type="button" class="btn btn-info"  id="ghs_log_btn">Already Have Account.?</button>
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
          <!-- =-=-=-=-=-=-= Registration Form End =-=-=-=-=-=-= -->
      </div>
       <!-- Forget Password -->
      <?php require_once('inc/forgot-pass-model.php'); ?>
      <!-- Main Content Area End --> 
      <?php require_once('inc/footer-link.php'); ?>
   </body>
</html>