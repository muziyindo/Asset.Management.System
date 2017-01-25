<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $title ; ?></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href="<?php echo base_url() ; ?>asset/bs_css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ; ?>asset/bs_css/styles.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/bs_js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/bs_js/jquery-1.8.3.min.js"></script>
    <link href="<?php echo base_url() ; ?>asset/bs_css/toastr.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/bs_js/toastr.js"></script>

    <style>

       html 
       {
         position: relative;
         min-height: 100%;
       }

       body
       {
         margin: 0 0 100px; /* bottom = footer height */
         padding: 25px;

         /*height: 200px;
    background: red; /* For browsers that do not support gradients */    
    /*background: -webkit-linear-gradient(left, rgb(0,31,63) , white); /* For Safari 5.1 to 6.0 */
    /*background: -o-linear-gradient(right, rgb(0,31,63), white); /* For Opera 11.1 to 12.0 */
    /*background: -moz-linear-gradient(right, rgb(0,31,63), white); /* For Firefox 3.6 to 15 */
    /*background: linear-gradient(to right, rgb(0,31,63) , white); /* Standard syntax (must be last) */
       }

       footer 
       {
         //background-color: orange;
         position: absolute;
         left: 0;
         bottom: 0;
         height: 100px;
         width: 100%;
         overflow:hidden;
         text-align: center;
      }

      

    </style>

    <script>
      toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut" 
    } 
   </script>

	</head>
	<body style="background:white">
   <?php 
        error_reporting(E_ERROR|E_WARNING);
     
         echo form_open('user_login_c/index');

         $message=$this->session->flashdata('message');

         if($message=="no_data")
         {
          echo '<script>Command: toastr["error"]("Username and password missing")</script>';
         }
         else if($message=="incorrect_data")
         {
          echo '<script>Command: toastr["error"]("Incorrect login details")</script>';
         }
     ?>
     
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
<div class="container"><center>SOLUTION TO ASSET MANAGEMENT<!--<img src="<?php echo base_url(); ?>asset/images/qlogo.png"></img>--></center></div>
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center" style="color:red">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Username" name="uname">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="pword">
            </div>
            <div class="form-group">
              <input class="btn btn-default btn-lg btn-block" type="submit" value="Log In"></input>
              <!--<span class="pull-right"><a href="#"></a></span><span><a href="#" >Need help?</a></span>-->
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <!--<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>-->
          <div class="footer-main">
             
          </div>
		  </div>	
      </div>
  </div>
  </div>
</div>
<footer>
     <h6>Solution To Asset Management (STAM) &copy , 2016</h6>    
</footer>
	<!-- script references -->
		<script src="<?php echo base_url() ; ?>asset/bs_js/jquery-1.8.3.min.js"></script>
		<script src="<?php echo base_url() ; ?>asset/bs_js/bootstrap.min.js"></script>
	</body>
</html>