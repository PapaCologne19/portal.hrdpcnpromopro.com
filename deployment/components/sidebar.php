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
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo mb-3">
        <img src="../assets/img/icons/brands/pcnlogo1.png" alt="PCN logo" style="background-color: #6c757d !important;">
      </span>
      <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">PCN</span> -->
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="index.php" class="menu-link">
        <i class="bi bi-house-door" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="bi bi-send-arrow-down" style="margin-right: 1rem;"></i>
        <div data-i18n="Layouts">Deployment
        <span class="notification badge">
                    <?php 
                      $get = "SELECT shortlist.*, employee.*, shortlist.project_status AS for_loa_status, employee.id AS employee_ids
                              FROM shortlist_master shortlist, employees employee
                              WHERE shortlist.employee_id = employee.id
                              AND shortlist.deployment_status = 'FOR DEPLOYMENT'
                              AND shortlist.project_status = 'FOR LOA'";
                      $get_result = $link->query($get);
                      while($get_row = $get_result->fetch_assoc()){
                          
                      
                      
                        if($notification = $get_result->num_rows){
                            $get2 = "SELECT * FROM loa_renewal_request WHERE request_status = 'FOR RENEWAL'";
                            $get_result2 = $link->query($get2);
                            $notification2 = $get_result2->num_rows;
                            $notifications = $notification + $notification2;
                          echo '<span class="badge rounded-pill bg-danger" data-bs-toggle="tooltip" data-bs-title="You have '.$notifications.' notifications">'.$notifications.'</span>';
                        }
                        else{
                          echo "";
                        }
                      }
                    ?>
                </span>
        </div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="shortlist.php" class="menu-link">
            <div data-i18n="Without navbar">Project
                <span class="notification badge">
                    <?php 
                      $get = "SELECT shortlist.*, employee.*, shortlist.project_status AS for_loa_status, employee.id AS employee_ids
                              FROM shortlist_master shortlist, employees employee
                              WHERE shortlist.employee_id = employee.id
                              AND shortlist.deployment_status = 'FOR DEPLOYMENT'
                              AND shortlist.project_status = 'FOR LOA'";
                      $get_result = $link->query($get);
                      while($get_row = $get_result->fetch_assoc()){
                        if($notification = $get_result->num_rows){
                          echo '<span class="badge rounded-pill bg-danger" data-bs-toggle="tooltip" data-bs-title="Request LOA">'.$notification.'</span>';
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
        <li class="menu-item">
          <a href="loa_database.php" class="menu-link">
            <div data-i18n="Container">LOA Database</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="loa_history.php" class="menu-link">
            <div data-i18n="Container">LOA History</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="separation.php" class="menu-link">
            <div data-i18n="Container">Separation</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="loa_renewal_requests.php" class="menu-link">
            <div data-i18n="Without navbar">Renewal Requests
            <span class="notification badge">
                    <?php 
                      $get2 = "SELECT * FROM loa_renewal_request WHERE request_status = 'FOR RENEWAL'";
                      $get_result2 = $link->query($get2);
                      while($get_row2 = $get_result2->fetch_assoc()){
                        if($notification2 = $get_result2->num_rows){
                          echo '<span class="badge rounded-pill bg-danger" data-bs-toggle="tooltip" data-bs-title="Request LOA">'.$notification2.'</span>';
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
      </ul>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Deployment Action</span>
    </li>
    <!--<li class="menu-item">-->
    <!--  <a href="javascript:void(0);" class="menu-link menu-toggle">-->
    <!--    <i class="menu-icon tf-icons bx bx-dock-top"></i>-->
    <!--    <div data-i18n="Account Settings">Print</div>-->
    <!--  </a>-->
    <!--  <ul class="menu-sub">-->
    <!--    <li class="menu-item">-->
    <!--      <a href="pages-account-settings-account.html" class="menu-link">-->
    <!--        <div data-i18n="Account">Account</div>-->
    <!--      </a>-->
    <!--    </li>-->
        
    <!--  </ul>-->
    <!--</li>-->
    <li class="menu-item">
      <a href="print_entry.php" class="menu-link">
      <i class="bi bi-printer" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Print an Entry</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="employee.php" class="menu-link">
      <i class="bi bi-people" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Employees</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="create_id.php" class="menu-link">
      <i class="bi bi-card-text" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Create ID</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="excuse_letter.php" class="menu-link">
        <i class="bi bi-envelope-exclamation" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Excuse Letter</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="tables-basic.html" class="menu-link">
        <i class="bi bi-person-up" style="margin-right: 1rem !important"></i>
        <div data-i18n="Tables">Float</div>
      </a>
    </li>


    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
    <!-- LOA -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-archive" style="margin-right: 1rem !important"></i>
        <div data-i18n="User interface">Deployment Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="deployment_history_report.php" class="menu-link">
            <div data-i18n="Accordion">Deployment History Report</div>
          </a>
        </li>
      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="expired_loa_report.php" class="menu-link">
            <div data-i18n="Accordion">Expired LOA Report</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>