<?php

include_once("../elements/mainheader.php");
?>

<body>

<?php
include_once("../elements/subheader.php");
?>

  <!-- ======= Sidebar ======= -->
<?php
include_once("../elements/sidebar.php");
?>
 <!-- End Sidebar-->

  <main id="main" class="main">

     <div class="pagetitle">
      <h1>Users Master</h1>
     
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

		<div class="col-lg-6">
		 <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo BASE_PATH ?>views/dashboard.php">Home</a></li>
          
          <li class="breadcrumb-item active">Master</li>
        </ol>
      </nav>
		</div>
		<div class="col-lg-6">
		<button data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="fillupempty()" type="button" class="btn btn-primary tablebutton"><i class="bi bi-file-earmark-plus me-1"></i> Add New</button>
		</div>
		<div class="col-lg-12">
		
          <div class="card" id="tablecard">
            <div class="card-body">
              <h5 class="card-title">Users List</h5>

              <!-- Table with stripped rows -->
              
			  
			  <table id="users-master" class="table table-striped display nowrap"" cellspacing="0" width="100%">
				<thead>
					<tr>
					
					<th>#</th>
					
					<th>First Name</th>
					<th>Last Name</th>
					
					<th>Phone</th>
					<th>Email</th>
					<th>Last Login</th>
					<th>Last Password Change</th>
					
					<th>Action</th>
					</tr>
				</thead>
				</table>
				

              <!-- End Table with stripped rows -->

            </div>
          </div>
		</div>
       

        
      </div>
    </section>
	
	
	  	<div class="modal fade" id="verticalycentered" tabindex="-1">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Edit User</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"  aria-label="Close"></button>
			</div>
			<div class="modal-body">
			  <form class="row g-3">
              
				 <div class="col-md-4">
				  <input type="hidden" class="form-control" id="uid">
				<label for="FullName" class="form-label">First Name<span style="color:red"> *</span>:</label>
                  <input type="text" class="form-control validate-req" id="first_name" placeholder=" ">
                </div>
				
				<div class="col-md-4">
				<label for="LoginName" class="form-label">Last Name<span style="color:red"> *</span>:</label>
                  <input type="text" class="form-control" id="last_name" placeholder=" ">
                </div>
				
				<div class="col-md-4">
				<label for="LoginName" class="form-label">Phone<span style="color:red"> *</span>:</label>
                  <input type="text" class="form-control" id="phone" placeholder=" ">
                </div>
				 <div class="col-md-4">
				 <label for="email" class="form-label">Email<span style="color:red"> *</span>:</label>
                  <input type="email" class="form-control" id="email" placeholder="">
                </div>
				
				<div class="col-md-4">
				<label for="Password" class="form-label">Password<span style="color:red"> *</span>:</label>
                  <input type="text" class="form-control" id="password" placeholder=" ">
				 
                </div>
				
				<div class="col-md-4" id="checkpass" style="margin-top:50px;">
				 <input type="checkbox" onclick="disablepassword()" id="autopassword" placeholder=" "> Create Automatically
				  </div>
				
				<div class="col-md-4" id="adminread">
				<label for="registered" class="form-label">Registered At:</label>
                  <span id="registered_at" class="form-control"  >
                </div>
               
			  
				
				
                
                
              </form>
			</div>
			<div class="modal-footer">
			
			  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			 <input type="submit" id="savechanges" class="btn btn-primary" value="Save changes" onclick="return validate();"></input>
			  <span id="loader"></span>
			</div>
		  </div>
		</div>
	  </div><!-- End Vertically centered Modal-->
	  
  </main><!-- End #main -->
  


  <!-- ======= Footer ======= -->
  <?php
include_once("../elements/footer.php");
?>

<script>
$(document).ready(function() {
   
	GetUsermaster();
 } );
function GetUsermaster()
{
	 var table = $('#users-master').dataTable({
		 "order": [[1, 'desc']],
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo BASE_PATH; ?>/model/masters/userslist.php",
		"columnDefs": [ {
			"targets": -1,
			"data": null,
			"defaultContent": "<button type='button' class='btn btn-dark tablebuttons' data-bs-toggle='modal' onclick='fillup()' data-bs-target='#verticalycentered'><i class='bi bi-pencil-square'></i></button>"
		}],
		
		'rowCallback': function(row, data, index){
			
			$(row).find('td:eq(7)').html('<button type="button" class="btn btn-dark tablebuttons" data-bs-toggle="modal" onclick="fillup(\''+data[0]+'\', \''+data[1]+'\',\''+data[2]+'\', \''+data[3]+'\', \''+data[4]+'\', \''+data[5]+'\', \''+data[6]+'\', \''+data[7]+'\')" data-bs-target="#verticalycentered"><i class="bi bi-pencil-square"></i></button><button  class="btn btn-dark tablebuttons" onclick="downloadcsv(\''+data[0]+'\')"><i class="bi bi-download"></i></button>');
			$(row).find('td:eq(0)').html(+index+1);
			
			
		  }
    } );

}


function fillup(uid, first_name, last_name, phone,email, password, registered)
{
	$('#uid').val(uid);
	$('#first_name').val(first_name);
	$('#last_name').val(last_name);
	$('#phone').val(phone);
	$('#email').val(email);
	$('#password').val('');
	$('#registered_at').html(registered);
	$('#adminread').show();
	$('#checkpass').hide();
	
}

function fillupempty()
{
	$('#uid').val('');
	$('#first_name').val('');
	$('#last_name').val('');
	$('#phone').val('');
	$('#email').val('');
	$('#password').val('');
	$('#adminread').hide();
	$('#checkpass').show();
	$('#verticalycentered .modal-title').html("Add New User");
}


function SaveMaster()
{
	var uid = $('#uid').val();
	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var email = $('#email').val();
	var autopassword = document.getElementById("autopassword").checked;
	
	if(first_name == '' || last_name == '' || phone =='' || email == '')
	{
		alert("Please fill all mandatory fields!");
		return false;
	}
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/masters/masteredit.php",
			type: 'POST',
			data: JSON.stringify({
				"uid": uid,
				"first_name": first_name,
				"last_name": last_name,
				"phone": phone,
				"password": password,
				"email": email,
				"autopassword": autopassword,
				"mastername": 'user_master'
			}),
			datatype:'application/json',
			beforeSend: function() {
				var ss = '<button class="btn btn-primary" type="button" disabled=""><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span></button>';
				$('#savechanges').hide();
				$('#loader').html(ss);
				$('#loader').show();
			},
			complete: function(res) {
				//console.log(res);
			},
			success: function(res) {
				console.log(res);
				$('#loader').hide();
				$('#savechanges').show();
				var response = JSON.parse(res);
		
				if(response.status == 1)
				{
					$('#close').click();
					$('.main').append('<div id="alert" style="position:absolute" class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Updated successfully! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					
					$('#users-master').DataTable().ajax.reload();

					setTimeout( function(){
						$('#alert').hide().fadeOut();
						} , 3000);

				}
				else
				{
					$('.modal-footer').prepend('<label class="form-check-label" id="error" style="color: red;font-size: 13px;margin: 10px 40px;" for="sds">Failed</label>');
				}
			}
	});
}

function disablepassword()
{
	var autopassword = document.getElementById("autopassword").checked;
	if(autopassword == true)
	{
		$('#password').attr('readOnly', true);
		$('#password').css('background', 'aliceblue');
		
	}
	else
	{
		$('#password').attr('readOnly', false);
		$('#password').css('background', '');
	}
}

function downloadcsv(uid)
{
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/masters/masteredit.php",
			type: 'POST',
			data: JSON.stringify({
				"uid": uid,
				"mastername": 'downloadtasks'
			}),
			datatype:'application/json',
			beforeSend: function() {
				var ss = '<button class="btn btn-primary" type="button" disabled=""><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span></button>';
				$('#loader').html(ss);
				$('#loader').show();
			},
			complete: function(res) {
				//console.log(res);
			},
			success: function(data) {
				console.log(data);
				 /*
				   * Make CSV downloadable
				   */
				  var downloadLink = document.createElement("a");
				  var fileData = ['\ufeff'+data];

				  var blobObject = new Blob(fileData,{
					 type: "text/csv;charset=utf-8;"
				   });

				  var url = URL.createObjectURL(blobObject);
				  downloadLink.href = url;
				  downloadLink.download = "tasks_"+uid+".csv";

				  /*
				   * Actually download CSV
				   */
				  document.body.appendChild(downloadLink);
				  downloadLink.click();
				  document.body.removeChild(downloadLink);
			}
	});
}

</script>


</body>

</html>