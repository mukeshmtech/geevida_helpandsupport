<div class="background-rotator">
   <!-- slider start-->
   <div class="owl-carousel owl-theme background-rotator-slider">
      <!-- Slide -->
      <div class="item linear-overlay"><img src="images/slider/1.jpg" alt=""></div>
      <!-- Slide -->
      <div class="item linear-overlay"><img  src="images/slider/2.jpg" alt=""></div>
      <!-- Slide -->
      <div class="item linear-overlay"><img src="images/slider/3.jpg" alt=""></div>
   </div>
   <div class="search-section">
      <!-- Find search section -->
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <!-- Heading -->
               <div class="content">
                  <div class="heading-caption">
                     <h1>Find what are you looking for</h1>
                  </div>
                  <div class="search-form">
                     <form id="search-frm" method="POST">
                        <div class="row">
                           <!-- Input Field -->
                           <div class="col-md-8 col-xs-12 col-sm-8">
                              <input type="text" name="search-text" id="search-text" class="form-control" placeholder="What Are You Looking For..." value="<?php echo (isset($_POST['search-text']))?$_POST['search-text']:''; ?>" />
                           </div>
                           <!-- Search Button -->
                           <div class="col-md-4 col-xs-12 col-sm-4">
                              <button type="button" onclick="searchFilter();" class="btn btn-theme btn-block">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.Find search section-->
</div>