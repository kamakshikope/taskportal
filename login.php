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

              <div class="d-flex justify-content-center py-4">
                <a href="login.php" class="logo d-flex align-items-center w-auto">
                  
                  <span class="d-none d-lg-block" style="color:#000;">Tasks Management</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                       
                        <input type="text" name="username" onblur="checkValue(this.value)" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
					
					
					<label class="form-check-label" id="error" style="color: red;font-size: 13px;text-align: center;" for="sds"></label>
                  
                    <div class="col-12">
                      <button class="btn btn-primary w-100" onclick="return login(this)" type="button">Login</button>
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


function checkValue(username)
{
	$.ajax({
		url: "<?php echo BASE_PATH; ?>/model/checkusername.php",
		type: 'POST',
		data: JSON.stringify({
			"username": username,
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
				if(response.msg=="firstlogin")
				{
					window.location.href="resetpassword.php?q=1";
				}
				
			}
			
		}
		});
}

function login(obj)
{
	
	var pass = $('#yourPassword').val();
	var user = $('#yourUsername').val();
	if(pass == '' || user =='')
	{
		$('#error').html("Please enter Username/Email").fadeIn(); 
		return false;
	}	
	else
	{
		$('#error').html("").fadeOut();
	}
	$(obj).html("Loading..");	
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/checklogin.php",
			type: 'POST',
			data: JSON.stringify({
				"username": user,
				"password": pass,
				
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
					if(response.msg=="changepassword")
					{
						window.location.href="resetpassword.php?q=2";
					}
					else
					{
					
						//activate();
						$('#error').html("").fadeIn();
						if(response.responsepage!='')
							window.location.href="views/"+response.responsepage+".php";
						else
							window.location.href="views/dashboard.php";
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