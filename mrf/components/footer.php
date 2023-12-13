   <!-- Core JS -->
   <!-- build:js assets/vendor/js/core.js -->
   <script src="../assets/vendor/libs/jquery/jquery.js"></script>
   <script src="../assets/vendor/libs/popper/popper.js"></script>
   <script src="../assets/vendor/js/bootstrap.js"></script>
   <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

   <script src="../assets/vendor/js/menu.js"></script>
   <!-- endbuild -->

   <script>
      // For Update Screening
      $(document).ready(function() {
         $('tbody').on('click', '.btnsearch', function() {
            var Id = $(this).prev('.project_id').val();
            $('#projectModal').modal('show');

            // load the corresponding question(s) for the clicked row
            $.ajax({
               url: 'ratings.php',
               type: 'post',
               data: {
                  id: Id
               },
               success: function(response) {
                  $('#projectModal .modal-body').html(response);
                  new DataTable('#example');
               },
               error: function() {
                  alert('Error.');
               }
            });
         });
      });
   </script>

   <!-- Data Table -->
   <script>
      new DataTable('#example');
    //   var myModal = new bootstrap.Modal(document.getElementById('projectModal'));

   </script>

   <!-- Tooltips Enabler -->
   <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
   </script>

   <!-- Vendors JS -->
   <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

   <!-- Main JS -->
   <script src="../assets/js/main.js"></script>

   <!-- Page JS -->
   <script src="../assets/js/dashboards-analytics.js"></script>

   <!-- Place this tag in your head or just before your close body tag. -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>