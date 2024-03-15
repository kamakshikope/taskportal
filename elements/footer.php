
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <!-- Vendor JS Files -->

  <script src="<?php echo BASE_PATH;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo BASE_PATH;?>assets/vendor/simple-datatables/simple-datatables.js"></script>

  <script src="<?php echo BASE_PATH;?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo BASE_PATH;?>assets/js/main.js"></script>
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  
  <link rel="stylesheet"  href="<?php echo BASE_PATH; ?>assets/css/jquery.dataTables.min.css">	
  
  
  <script src="<?php echo BASE_PATH; ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script> 

  <script>
  
	
$('body input[type=text]').addClass('acm');
$('body input[type=select]').addClass('acm');
$('textarea').addClass('acm');

function gosession()
{
	
	var branch_session = $('#branch_session').val();
	var dept_session = $('#dept_session').val();
	if(branch_session =='' || dept_session =='')
	{
		
		$('.header').append('<div id="alert" style="position:absolute;   top: 70px;right:0;" class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> Please select both Branch and Dept! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		setTimeout( function(){
			$('#alert').hide().fadeOut();
			
			
			} , 3000);
		return false;	
	}		
	$.ajax({
			url: "<?php echo BASE_PATH; ?>/model/activate.php",
			type: 'POST',
			data: JSON.stringify({
				"branch_session_id": $('#branch_session').val(),
				"dept_session_id": $('#dept_session').val()
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
					$('#error').html("").fadeIn();
					window.location.href="<?php echo BASE_PATH; ?>views/dashboard.php";
				}
				else
				{
					$('.header').append('<div id="alert" style="position:absolute;    top: 70px;right:0;" class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> '+response.statusmsg+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					
					
					setTimeout( function(){
						$('#alert').hide().fadeOut();
						
						
						} , 3000);
					$('#branch_session').val('');
					$('#branch_session_id').val('');
					$('#dept_session').val('');
					$('#dept_session_id').val('');

				}
			}
		});
}


    var getUrl = window.location;
	var baseUrl = (getUrl.toString().includes(".com"))?getUrl .protocol + "//" + getUrl.host:getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	$('#sidebar-nav li a').addClass("collapsed");
	if(getUrl.pathname.split('/')[2]=="master")
	{
		$('li#master a').removeClass("collapsed");
		$('li#master .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[3]=="companymapping.php")
	{
		$('li#companymapping a').removeClass("collapsed");
	}
	else if(getUrl.pathname.split('/')[3]=="dashboard.php")
	{
		$('li#dashboard a').removeClass("collapsed");
	}
	else if(getUrl.pathname.split('/')[2]=="reports" && (getUrl.pathname.split('/')[3]!="trail_balance_report.php" && getUrl.pathname.split('/')[3]!="ledgers_report.php" &&getUrl.pathname.split('/')[3]!="pl_report.php" &&getUrl.pathname.split('/')[3]!="period_analysis.php" &&getUrl.pathname.split('/')[3]!="bank_ledgers_report.php") )
	{
		$('li#Report a').removeClass("collapsed");
		$('li#Report .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[2]=="payreports")
	{
		$('li#ReportPay a').removeClass("collapsed");
		$('li#ReportPay .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[2]=="receivables")
	{
		$('li#receivables a').removeClass("collapsed");
		$('li#receivables .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[2]=="payables")
	{
		$('li#payables a').removeClass("collapsed");
		$('li#payables .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[2]=="general")
	{
		$('li#general_ledgers a').removeClass("collapsed");
		$('li#general_ledgers .nav-content.collapse').addClass("show");
	}else if(getUrl.pathname.split('/')[3]=="ledgers_report.php")
	{
		$('li#ledgers_report a').removeClass("collapsed");
		$('li#ledgers_report .nav-content.collapse').addClass("show");
	}else if(getUrl.pathname.split('/')[3]=="bank_ledgers_report.php")
	{
		$('li#bank_ledgers_report a').removeClass("collapsed");
		$('li#bank_ledgers_report .nav-content.collapse').addClass("show");
	}else if(getUrl.pathname.split('/')[3]=="trail_balance_report.php")
	{
		$('li#trail_balance_report a').removeClass("collapsed");
		$('li#trail_balance_report .nav-content.collapse').addClass("show");
	}else if(getUrl.pathname.split('/')[3]=="pl_report.php")
	{
		$('li#pl_report a').removeClass("collapsed");
		$('li#pl_report .nav-content.collapse').addClass("show");
	}
	else if(getUrl.pathname.split('/')[3]=="period_analysis.php")
	{
		$('li#period_analysis a').removeClass("collapsed");
		$('li#period_analysis .nav-content.collapse').addClass("show");
	}
 
var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/;
 
function validate(tab)
{
	if(tab == 'master')
	{
		var inputform = 'verticalycentered';
	}
	else if(tab == 'orgmaster')
	{
		var inputform = 'organizationform';
	}
	else
	{
		var inputform = 'verticalycentered_'+tab;
	}
	
	var valid = [];
	
	$("div#"+inputform+" .validate-req").each(function() {
		if($(this).val() == '' || $(this).val() == null || $(this).val() == 'null')
		{
			valid.push("1");	
			$(this).css({
                'border': '1px solid red',
                //'background': '#ffe5e5'
            });
			
           
		}
		else
		{
			valid.push("0");	
			$(this).css({
                'border': '1px solid #ced4da',
               // 'background': 'transparent'
            });
		}
	});
	console.log(valid);
	//GstNo
	$("div#"+inputform+" .gst-req").each(function() {
		
		if(!reggst.test($(this).val()) && $(this).val()!=''){
				
				valid.push("1");	
				$(this).css({
					'border': '1px solid red',
					//'background': '#ffe5e5'
				});
		}
		else
		{
			valid.push("0");	
			$(this).css({
                'border': '1px solid #ced4da',
               // 'background': 'transparent'
            });
		}
	});
	
	//PANno
	$("div#"+inputform+" .pan-req").each(function() {
		
		 var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
		 var txtpan = $(this).val(); 
		 if (txtpan.length == 10 ) {
			 if( txtpan.match(regExp) )
			 {
				 valid.push("0");	
				$(this).css({
					'border': '1px solid #ced4da',
				   // 'background': 'transparent'
				});
				
			}
			else
			{
				valid.push("1");	
				$(this).css({
					'border': '1px solid red',
					//'background': '#ffe5e5'
				});
			}
		 }
		 else
		 {
			 valid.push("1");	
				$(this).css({
					'border': '1px solid red',
					//'background': '#ffe5e5'
				});
		 }
		
	});
	
	
	
	
	console.log(valid);
	if($.inArray("1", valid) != -1)
	{

		$("div#"+inputform+" .modal-content").append('<div id="alert" style="position:absolute;    left:15px;bottom:0;" class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> Please fill all mandatory fields!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		setTimeout( function(){
		$('#alert').hide().fadeOut();
		
		
		} , 2000);
		
		return false;
	}
	else
	{
		
		if(tab == 'address')
		{
			SaveMaster_address();
		}
		else if(tab == 'document')
		{
			SaveMaster_document();
		}
		else if(tab == 'linesummary')
		{
			SaveMaster_linesummay();
		}
		else
		{
			SaveMaster();
		}
	}
	//return true;
}



$('#GST_Number').keyup(function()
{
	if(!reggst.test(gstinVal) && gstinVal!=''){
        $('.modal-content').append('<div id="alert" style="position:absolute;    left:15px;bottom:0;" class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> GST Identification Number is not valid. It should be in this "11AAAAA1111Z1A1" format!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		setTimeout( function(){
		$('#alert').hide().fadeOut();
		
		
		} , 2000);
		
		return false;
	}
});

function formatDate(dateString) {
	let date = new Date(dateString),

		
		day = String(date.getDate()).padStart(2, '0');
		month = String(date.getMonth() + 1).padStart(2, '0');
		year = date.getFullYear()
		//months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
		 
	return year + '-' + day + '-' +month ;

}

function formatDate1(dateString) {
	let date = new Date(dateString),

		
		day = String(date.getDate()).padStart(2, '0');
		month = String(date.getMonth() + 1).padStart(2, '0');
		year = date.getFullYear()
		//months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
		 
	return year + '-' + month + '-' +day ;

}


	</script>