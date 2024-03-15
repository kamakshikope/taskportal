<?php

require_once("../config/config.php");
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
      <h1>Dashboard</h1>
    
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            

        
			
			<!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Users </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="totalcnt"></h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            

          </div>
        </div><!-- End Left side columns -->

       

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
include_once("../elements/footer.php");
?>

<script>
$.ajax({
		url: "<?php echo BASE_PATH; ?>/model/masters/masteredit.php",
		type: 'POST',
		data: JSON.stringify({
			"mastername": 'total_users'
		}),
		datatype:'application/json',
		
		success: function(res) {
			console.log(res);
			
			var response = JSON.parse(res);
			$('#totalcnt').html(response.totalusers);
		}
});

		
</script>
</body>

</html>