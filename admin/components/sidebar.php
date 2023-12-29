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
<br><br>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/index.php" class="menu-link">
        <i class="bi bi-house-door" style="margin-right: 1rem;"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>

    <!-- MRF Section -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">MRF Section</span></li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-card-checklist" style="margin-right: 1rem;"></i>
        <div data-i18n="User interface">MRF
        <span class="notification badge">
                    <?php 
                      $get = "SELECT applicant.*, project.*, resume.*, mrf.*,
                              DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                              FROM applicant applicant, projects project, applicant_resume resume, mrf mrf
                              WHERE applicant.id = resume.applicant_id 
                              AND project.id = resume.project_id 
                              AND mrf.id = project.mrf_id
                              AND resume.status = 'QUALIFIED' 
                              AND resume.project_status = 'PENDING'";
                              
                              
                      $get_result = $link->query($get);
                      while($get_row = $get_result->fetch_assoc()){
                          $get2 = "SELECT employees.*, project.*, shortlist.*, shortlist.id AS shortlist_id, mrf.*  
                                                                                FROM employees employees, projects project, shortlist_master shortlist, mrf mrf
                                                                                WHERE employees.id = shortlist.employee_id 
                                                                                AND project.project_title = shortlist.shortlistnameto 
                                                                                AND mrf.id = project.mrf_id                                                                                                           
                                                                                AND shortlist.project_status = 'FOR REQUEST'";
                                                              
                                                              
                                                      $get_result2 = $link->query($get2);
                                                      $for_request = $get_result2->num_rows;
                        if($notification = $get_result->num_rows){
                            $total_notification = $notification + $for_request;
                          echo '<span class="badge rounded-pill bg-danger">'.$total_notification.'</span>';
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
          <a href="https://portal.hrdpcnpromopro.com/admin/views/mrf_form.php" class="menu-link">
            <div data-i18n="Accordion">Request Form</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/mrf_list.php" class="menu-link">
            <div data-i18n="Accordion">MRF Lists
            <span class="notification badge">
                    <?php 
                      $get = "SELECT applicant.*, project.*, resume.*, mrf.*,
                              DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                              FROM applicant applicant, projects project, applicant_resume resume, mrf mrf
                              WHERE applicant.id = resume.applicant_id 
                              AND project.id = resume.project_id 
                              AND mrf.id = project.mrf_id
                              AND resume.status = 'QUALIFIED' 
                              AND resume.project_status = 'PENDING'";
                              
                              
                      $get_result = $link->query($get);
                      while($get_row = $get_result->fetch_assoc()){
                          $get2 = "SELECT employees.*, project.*, shortlist.*, shortlist.id AS shortlist_id, mrf.*  
                                                                                FROM employees employees, projects project, shortlist_master shortlist, mrf mrf
                                                                                WHERE employees.id = shortlist.employee_id 
                                                                                AND project.project_title = shortlist.shortlistnameto 
                                                                                AND mrf.id = project.mrf_id                                                                                                           
                                                                                AND shortlist.project_status = 'FOR REQUEST'";
                                                              
                                                              
                                                      $get_result2 = $link->query($get2);
                                                      $for_request = $get_result2->num_rows;
                        if($notification = $get_result->num_rows){
                            $total_notification = $notification + $for_request;
                          echo '<span class="badge rounded-pill bg-danger">'.$total_notification.'</span>';
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
        
        <!--MRF reports-->
        
      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <div data-i18n="Accordion">MRF Reports</div>
          </a>
          <ul class="menu-sub">
            <!-- For Category -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/mrf_loa_database.php" class="menu-link">
                <div data-i18n="User interface">LOA Requests Status</div>
              </a>
            </li>

            <!-- For Channels -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/mrf_deployed_employee.php" class="menu-link">
                <div data-i18n="User interface">Deployed Employees</div>
              </a>
            </li>

            <!-- For Classifications -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/mrf_expired_loa.php" class="menu-link">
                <div data-i18n="User interface">Expired LOA</div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    
    
    
    <!-- EWB SECTION -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">EWB Section</span></li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-list-stars" style="margin-right: 1rem;"></i>
        <div data-i18n="User interface">EWB</div>
      </a>

      <ul class="menu-sub">
          <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_for_verification.php" class="menu-link">
            <div data-i18n="Accordion">For Verification</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_employees.php" class="menu-link">
            <div data-i18n="Accordion">Employees</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_verified_applicants.php" class="menu-link">
            <div data-i18n="Accordion">Verified Employees</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_backout_employees.php" class="menu-link">
            <div data-i18n="Accordion">Backout Employees</div>
          </a>
        </li>
        
        <!--EWB reports-->
        
      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <div data-i18n="Accordion">EWB Reports</div>
          </a>
          <ul class="menu-sub">
            <!-- For Category -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_database.php" class="menu-link">
                <div data-i18n="User interface">EWB Database</div>
              </a>
            </li>

            <!-- For Channels -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/ewb_summary_reports.php" class="menu-link">
                <div data-i18n="User interface">Summary Report</div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    
    
    
    
    <!-- POOLERS SECTION -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">POOLERS Section</span></li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-pin" style="margin-right: 1rem;"></i>
        <div data-i18n="User interface">POOLERS</div>
      </a>

      <ul class="menu-sub">
          <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/pooler_job_vacancies.php" class="menu-link">
            <div data-i18n="Accordion">Vacancies</div>
          </a>
        </li>
          <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/pooler_submit_resume.php" class="menu-link">
            <div data-i18n="Accordion">Submit Resume</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/pooler_database.php" class="menu-link">
            <div data-i18n="Accordion">Database</div>
          </a>
        </li>
      </ul>
    </li>
    
    
    
    
    
     <!-- Deployment Section -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Deployment Section</span></li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-send-arrow-down" style="margin-right: 1rem;"></i>
        <div data-i18n="User interface">Deployment
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
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_shortlist.php" class="menu-link">
            <div data-i18n="Accordion">Project
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
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_loa_database.php" class="menu-link">
            <div data-i18n="Accordion">LOA Database</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_separation.php" class="menu-link">
            <div data-i18n="Accordion">Separation</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_loa_renewal_requests.php" class="menu-link">
            <div data-i18n="Accordion">Renewal Requests
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
        
      <!--Deployment reports-->
      </ul>
     
    
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_print_entry.php" class="menu-link">
        <i class="bi bi-printer" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Print An Entry</div>
      </a>
    </li>
    
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_employee.php" class="menu-link">
        <i class="bi bi-people" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Employees</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_create_id.php" class="menu-link">
        <i class="bi bi-card-text" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Create ID</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_excuse_letter.php" class="menu-link">
        <i class="bi bi-envelope-exclamation" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Excuse Letter</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_excuse_letter.php" class="menu-link">
        <i class="bi bi-person-up" style="margin-right: 1rem !important"></i>
        <div data-i18n="Tables">Float</div>
      </a>
    </li>
    
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="bi bi-archive" style="margin-right: 1rem !important"></i>
        <div data-i18n="User interface">Reports</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_history_report.php" class="menu-link">
            <div data-i18n="Accordion">Deployment History Reports</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/deployment_expired_loa_report.php" class="menu-link">
            <div data-i18n="Accordion">Expired LOA Reports</div>
          </a>
        </li>
      </ul>
    </li>
 
</li>
    
    
    
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Applicant Shortlist</span></li>
    <li class="menu-item">
      <a href="https://portal.hrdpcnpromopro.com/admin/views/applicant_resume.php" class="menu-link">
        <i class="bi bi-file-richtext" style="margin-right: 1rem;"></i>
        <div data-i18n="Tables">Resume</div>
      </a>
    </li>

    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">ADMINISTRATOR</span></li>
    <!-- LOA -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="User interface">LOA</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/loa.php" class="menu-link">
            <div data-i18n="Accordion">LOA table</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/create_loa.php" class="menu-link">
            <div data-i18n="Accordion">Create LOA Template</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Administrator -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="User interface">Administrator</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <div data-i18n="Accordion">Recruitment Maintenance</div>
          </a>
          <ul class="menu-sub">
            <!-- For Category -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/category.php" class="menu-link">
                <div data-i18n="User interface">Category</div>
              </a>
            </li>

            <!-- For Channels -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/channel.php" class="menu-link">
                <div data-i18n="User interface">Channels</div>
              </a>
            </li>

            <!-- For Classifications -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/classification.php" class="menu-link">
                <div data-i18n="User interface">Classifications</div>
              </a>
            </li>

            <!-- For Client Companies -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/client_companies.php" class="menu-link">
                <div data-i18n="User interface">Client Companies</div>
              </a>
            </li>

            <!-- For Division -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/division.php" class="menu-link">
                <div data-i18n="User interface">Division</div>
              </a>
            </li>

            <!-- For Identification Marks -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/identification_mark.php" class="menu-link">
                <div data-i18n="User interface">Identification Marks</div>
              </a>
            </li>

            <!-- For Locator -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/locator.php" class="menu-link">
                <div data-i18n="User interface">Locator</div>
              </a>
            </li>

            <!-- For Projects -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/project.php" class="menu-link">
                <div data-i18n="User interface">Projects</div>
              </a>
            </li>

            <!-- For Sources -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/source.php" class="menu-link">
                <div data-i18n="User interface">Sources</div>
              </a>
            </li>

            <!-- For Type of Separation -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/type_of_separation.php" class="menu-link">
                <div data-i18n="User interface">Type of Separation</div>
              </a>
            </li>

            <!-- For LOA - LOA Word Format -->
            <li class="menu-item">
              <a href="https://portal.hrdpcnpromopro.com/admin/views/create_loa.php" class="menu-link">
                <div data-i18n="User interface">LOA - LOA Word Format</div>
              </a>
            </li>

          </ul>
        </li>
      </ul>


    </li>

    <!-- History components -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-copy"></i>
        <div data-i18n="History UI">History</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/employee_history.php" class="menu-link">
            <div data-i18n="Perfect Scrollbar">Employee History</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/loa_history.php" class="menu-link">
            <div data-i18n="Perfect Scrollbar">LOA History</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/login_logs.php" class="menu-link">
            <div data-i18n="Perfect Scrollbar">Login Logs</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/transaction_logs.php" class="menu-link">
            <div data-i18n="Perfect Scrollbar">Transaction Logs</div>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Account Management</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/applicant_account_management.php" class="menu-link">
            <div data-i18n="Basic Inputs">Applicant</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://portal.hrdpcnpromopro.com/admin/views/user_account_management.php" class="menu-link">
            <div data-i18n="Input groups">User</div>
          </a>
        </li>
      </ul>
    </li>

    
  </ul>
</aside>