<style>
  .notification {
    color: black;
    text-decoration: none;
    position: relative;
    display: inline-block;
    border-radius: 2px;
  }

  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 2px 5px;
    border-radius: 50%;
    background-color: #D80032 !important;
    color: white;
  }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
            <a href="index.php" class="app-brand-link justify-content-center text-center mx-auto">
              <span class="app-brand-logo demo mb-3">
                <img src="../assets/img/icons/brands/pcnlogo1.png" alt="PCN logo" style="background-color: #c2c7d0 !important; border-radius: 50px;">
              </span>
              <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">PCN</span> -->
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
<br>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="index.php" class="menu-link">
        <i class="bi bi-house-door" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>


    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">POOLERS SECTION</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="bi bi-file-richtext" style="margin-right: 1rem;"></i>
        <div data-i18n="Layouts">Resume</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pooler_resume.php" class="menu-link">
            <div data-i18n="Without navbar">For Screening & Passed</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pooler_deployed.php" class="menu-link">
            <div data-i18n="Container">Deployed</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pooler_failed.php" class="menu-link">
            <div data-i18n="Container">Failed</div>
          </a>
        </li>
      </ul>
    </li>



    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">MRF SECTION</span>
    </li>
    <!-- Accept MRF-->
    <li class="menu-item">
      <a href="accept_mrf.php" class="menu-link ">
        <i class="bi bi-list-ul" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">MRF 
          <span class="notification badge">
            <?php 
              $get = "SELECT * FROM mrf WHERE is_deleted = '0' AND hr_personnel != 'YES'";
              $get_result = $link->query($get);
              while($get_row = $get_result->fetch_assoc()){
                if($notification = $get_result->num_rows){
                  echo '<span class="badge rounded-pill bg-danger">'.$notification.'</span>';
                }
                else{
                  echo "";
                }
              }
            ?>
          </span>
        </div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">EWB SECTION</span>
    </li>
    <!-- For Requirements-->
    <li class="menu-item">
      <a href="for_requirements.php" class="menu-link">
        <i class="bi bi-calendar2-week" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">For Requirements
        <span class="notification badge">
            <?php 
              $get_for_requirements = "SELECT * FROM employees WHERE ewb_status = 'DECLINED'";
              $get_for_requirements_result = $link->query($get_for_requirements);
              while($get_for_requirements_row = $get_for_requirements_result->fetch_assoc()){
                if($get_for_requirements_row_notification = $get_for_requirements_result->num_rows){
                  echo '<span class="badge rounded-pill bg-danger">'.$get_for_requirements_row_notification.'</span>';
                }
                else{
                  echo "";
                }
              }
            ?>
          </span>
        </div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">RECRUITMENT SECTION</span>
    </li>
    <!-- Applicant -->
    <li class="menu-item">
      <a href="applicant.php" class="menu-link">
        <i class="bi bi-list-check" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Shortlisting
          <span class="notification badge">
              <?php 
                $get_resume = "SELECT * FROM applicant_resume WHERE status = 'FOR SCREENING' AND is_deleted = '0'";
                $get_resume_result = $link->query($get_resume);
                while($get_resume_row = $get_resume_result->fetch_assoc()){
                  if($get_resume_notification = $get_resume_result->num_rows){
                    echo '<span class="badge rounded-pill bg-danger">'.$get_resume_notification.'</span>';
                  }
                  else{
                    echo "";
                  }
                }
              ?>
            </span>
        </div>
      </a>
    </li>
    <!-- Deploy Applicant-->
    <li class="menu-item">
      <a href="deploy.php" class="menu-link">
        <i class="bi bi-send-exclamation" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">For Deployment</div>
      </a>
    </li>
    <!-- Take Applicant Photo -->
    <li class="menu-item">
      <a href="take_photo.php" class="menu-link">
        <i class="bi bi-camera" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Take Applicant Photo</div>
      </a>
    </li>
    <!-- Database Entry -->
    <li class="menu-item">
      <form action="database_entry.php" method="POST" class="menu-link">
        <i class="bi bi-database" style="margin-right: 1rem;"></i>
        <button type="submit" class="btn btn-default" name="database_entry" data-i18n="Analytics" style="color: #C2C7D0 !important; outline: none !important; padding: 0;">Database Entry</button>
      </form>
    </li>
    <!-- Applicant -->
    <li class="menu-item">
      <a href="employees.php" class="menu-link">
        <i class="bi bi-people" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Employee</div>
      </a>
    </li>
    <!-- Print an entry -->
    <li class="menu-item">
      <a href="print_entry.php" class="menu-link">
        <i class="bi bi-printer" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Print an Entry</div>
      </a>
    </li>
    
    <li class="menu-item">
      <a href="recruitment_loa_database.php" class="menu-link">
        <i class="bi bi-database" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">LOA Database</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="float.php" class="menu-link">
        <i class="bi bi-person-exclamation" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Float</div>
      </a>
    </li>
    
    <!--<li class="menu-header small text-uppercase">-->
    <!--  <span class="menu-header-text">SHORTLISTING MENU</span>-->
    <!--</li>-->
    <!-- Create Shortlist Title -->
    <!-- <li class="menu-item">
      <a href="create_shortlist.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Create Shortlist Title</div>
      </a>
    </li> -->
    <!-- Add Applicant to Shortlist -->
    <!-- <li class="menu-item">
      <a href="add_shortlist.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Add to Shortlist</div>
      </a>
    </li> -->
    <!-- Remove Applicant to Shortlist -->
    <!-- <li class="menu-item">
      <a href="remove_shortlist.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Remove to Shortlist</div>
      </a>
    </li> -->




    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">REPORTS</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="bi bi-card-list" style="margin-right: 1rem"></i>
        <div data-i18n="Layouts">Recruitment Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="list_of_blacklisted.php" class="menu-link">
            <div data-i18n="Without navbar">List of Blacklisted</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="list_of_backout.php" class="menu-link">
            <div data-i18n="Container">List of Backout</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="list_of_canceled.php" class="menu-link">
            <div data-i18n="Container">List of Canceled</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="view_database.php" class="menu-link">
            <div data-i18n="Container">Applicant Database Report</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="mrf_report.php" class="menu-link">
            <div data-i18n="Container">MRF Report</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="employee_report.php" class="menu-link">
            <div data-i18n="Container">Employee Report</div>
          </a>
        </li>

      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="bi bi-card-list" style="margin-right: 1rem"></i>
        <div data-i18n="Layouts">Shortlist Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="shortlist_download.php" class="menu-link">
            <div data-i18n="Without navbar">Shortlist Download</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="summary_report.php" class="menu-link">
            <div data-i18n="Container">Summary Report</div>
          </a>
        </li>
      </ul>
    </li>


  </ul>
</aside>