<?php 
require_once("config/config.php");
//require_once("config/process.php");

include_once("elements/header.php");?>

<body>

  <main id="login-main">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                   <?php
				   if($_GET['q'] == 2)
					   echo " <p class=1text-center small style='color:#012970;'><b>Password is expired! Please change yout password.</b></p>";
				   else if($_GET['q'] == 1)
						echo "<p class=1text-center small style='color:#012970;'><b>Please reset Password to continue</b></p>";
					
					?>
                  </div>

                  <form method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                       
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
					
					<div class="col-12">
                      <label for="cyourPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="password" class="form-control" id="cyourPassword" required>
                      <div class="invalid-feedback">Please enter your Confirm password!</div>
                    </div>
					
					
					<label class="form-check-label" id="error" style="color: red;font-size: 13px;text-align: center;" for="sds"></label>
                  
                    <div class="col-12"style="text-align:center;">
                      <button class="btn btn-primary w-100" onclick="checkreset(this)" type="button">Reset</button>
                      <a href="<?php echo BASE_PATH?>/login.php">Back</a>
                    </div>
                    
                  </form>

                </div>
              </div>

             

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<script>


function checkreset(obj)
{
	
	var pass = $('#yourPassword').val();
	var cyourPassword = $('#cyourPassword').val();
	var user = $('#yourUsername').val();
	if(pass != cyourPassword)
	{
		$('#error').html("Password is Mismatched").fadeIn();
		return false;
	}
		
	else
	{
		$('#error').html("").fadeOut();
	}
	
	$(obj).html("Loading..");	
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/resetpassword.php",
			type: 'POST',
			data: JSON.stringify({
				"username": user,
				"password": pass,
				"cyourPassword": cyourPassword,
				
			}),
			datatype:'application/json',
			complete: function(res) {
				//console.log(res);
			},
			success: function(res) {
				console.log(res);
				var response = JSON.parse(res);
				
				if(response.status == 1)
				{
					//activate();
					$('#error').html("").fadeIn();
					
					if(response.msg=='success')
					{
						alert('Success!. Please login to continue!');
						window.location.href="login.php";
					}
				}
				else
				{
					var err = response.statusmsg;
					
					$('#error').html(err).fadeIn(); 
					$(obj).html("Login");
					return false;
				}
			}
		});
}


</script>
<?php include_once("elements/footer.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>


</body>



</html>