<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link href="<?php echo media_url() ?>css/login2.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <script >
    const inputs = document.querySelectorAll(".input");


  function addcl(){
	  let parent = this.parentNode.parentNode;
	  parent.classList.add("focus");
    }

  function remcl(){
	  let parent = this.parentNode.parentNode;
	  if(this.value == ""){
		parent.classList.remove("focus");
	  }
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

  </script>
</head>

<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
  <?php echo form_open('manage/auth/login', array('class'=>'login100-form validate-form')); ?>

		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="index.html">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
        <?php if ($this->session->flashdata('failed')) { ?>
          <br><br>
        <div class="alert alert-danger alert-dismissible" style="margin-top: -85px !important;">
          <h5><i class="fa fa-close"></i> Email atau Password salah!</h5>
        </div>
        <?php  }  ?>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
        <?php echo form_close(); ?>
    </div>
   
</body>
</html>
