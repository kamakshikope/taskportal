<?php

include_once("../elements/mainheader.php");
?>

<body>

<?php
include_once("../elements/subheader.php");
?>

  <!-- ======= Sidebar ======= -->
<?php
include_once("../elements/usersidebar.php");
?>
 <!-- End Sidebar-->

  <main id="main" class="main">

     <div class="pagetitle">
      <h1>Tasks List</h1>
     
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

		<div class="col-lg-6">
		 <nav>
        <ol class="breadcrumb">
          
          <li class="breadcrumb-item active">My Tasks</li>
        </ol>
      </nav>
		</div>
		<div class="col-lg-6">
		<button data-bs-toggle="modal" data-bs-target="#verticalycentered" onclick="fillupempty()" type="button" class="btn btn-primary tablebutton"><i class="bi bi-file-earmark-plus me-1"></i> Add New Task</button>
		</div>
		<div class="col-lg-12">
		
          <div class="card" id="tablecard">
            <div class="card-body">
              <h5 class="card-title">Tasks List</h5>

              <!-- Table with stripped rows -->
              
			  
			  <table id="tasks-list" class="table table-striped display nowrap"" cellspacing="0" width="100%">
				<thead>
					<tr>
					
					<th>#</th>
					
					<th>Start Time</th>
					<th>Stop Time</th>
					
					<th>Notes</th>
					<th>Description</th>
					
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
			  <h5 class="modal-title">Edit Task</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"  aria-label="Close"></button>
			</div>
			<div class="modal-body">
			  <form class="row g-3">
              
				 <div class="col-md-4">
				  <input type="hidden" class="form-control" id="tid">
				<label for="FullName" class="form-label">Start Time<span style="color:red"> *</span>:</label>
                  <input type="datetime-local" class="form-control validate-req" id="start_time" placeholder=" ">
                </div>
				
				<div class="col-md-4">
				<label for="LoginName" class="form-label">Stop Time<span style="color:red"> *</span>:</label>
                  <input type="datetime-local" class="form-control" id="stop_time" placeholder=" ">
                </div>
				
				<div class="col-md-4">
				<label for="LoginName" class="form-label">Notes<span style="color:red"> *</span>:</label>
                  <input type="text" class="form-control" id="notes" placeholder=" ">
                </div>
				
			  
				<div class="col-md-4">
				<label for="LoginName" class="form-label">Description<span style="color:red"> *</span>:</label>
                  <textarea class="form-control" id="description" placeholder=" "></textarea>
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
   
	Gettaskslist();
 } );
function Gettaskslist()
{
	 var table = $('#tasks-list').dataTable({
		 "order": [[1, 'desc']],
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
		"ajax": {
		   "url": "<?php echo BASE_PATH; ?>/model/users/taskslist.php",
		   "data": function ( d ) {
			 return $.extend( {}, d, {
			   "uid": <?php echo $_SESSION['userId']; ?>
			 } );
		   }
		 },
		 
        "columnDefs": [ {
			"targets": -1,
			"data": null,
			"defaultContent": "<button type='button' class='btn btn-dark tablebuttons' data-bs-toggle='modal' onclick='fillup()' data-bs-target='#verticalycentered'><i class='bi bi-pencil-square'></i></button>"
		}],
		
		'rowCallback': function(row, data, index){
			
			$(row).find('td:eq(5)').html('<button type="button" class="btn btn-dark tablebuttons" data-bs-toggle="modal" onclick="fillup(\''+data[0]+'\', \''+data[1]+'\',\''+data[2]+'\', \''+data[3]+'\', \''+data[4]+'\', \''+data[5]+'\')" data-bs-target="#verticalycentered"><i class="bi bi-pencil-square"></i></button>');
			$(row).find('td:eq(0)').html(+index+1);
			
			
		  }
    } );

}


function fillup(tid, start_time, stop_time, notes,description)
{
	$('#tid').val(tid);
	$('#start_time').val(start_time);
	$('#stop_time').val(stop_time);
	$('#notes').val(notes);
	$('#description').val(description);
	
	
}

function fillupempty()
{
	$('#tid').val('');
	$('#start_time').val('');
	$('#stop_time').val('');
	$('#notes').val('');
	$('#description').val('');
	
	$('#verticalycentered .modal-title').html("Add New Task");
}


function SaveMaster()
{
	var tid = $('#tid').val();
	var start_time = $('#start_time').val();
	var stop_time = $('#stop_time').val();
	var notes = $('#notes').val();
	var description = $('#description').val();
	
	if(start_time == '' || stop_time == '' || notes =='' || description == '')
	{
		alert("Please fill all mandatory fields!");
		return false;
	}
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/users/tasksedit.php",
			type: 'POST',
			data: JSON.stringify({
				"tid": tid,
				"start_time": start_time,
				"stop_time": stop_time,
				"notes": notes,
				"description": description,
				
				"mastername": 'tasks_list'
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
					
					$('#tasks-list').DataTable().ajax.reload();

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


</script>


</body>

</html>