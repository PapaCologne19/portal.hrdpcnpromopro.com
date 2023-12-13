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
              <span class="app-brand-logo demo">
                <img src="../assets/img/elements/pcn.png" alt="" style="background-color: #6c757d !important;" width="5%">
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
                <i class="bi bi-speedometer2" style="margin-right: 1rem;"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">MRF</span>
            </li>
            <!-- MRF Lists -->
            <li class="menu-item">
              <a href="mrf_list.php" class="menu-link">
                <i class="bi bi-card-checklist" style="margin-right: 1rem;"></i>
                <div data-i18n="Analytics">MRF List
                <span class="notification badge">
                    <?php 
                      $id = $_SESSION['user_id'];
                      $get = "SELECT applicant.*, project.*, resume.*, mrf.*,
                              DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                              FROM applicant applicant, projects project, applicant_resume resume, mrf mrf
                              WHERE applicant.id = resume.applicant_id 
                              AND project.id = resume.project_id 
                              AND mrf.id = project.mrf_id
                              AND mrf.uid = '$id'
                              AND resume.status = 'QUALIFIED' 
                              AND resume.project_status = 'PENDING'";
                              
                              
                      $get_result = $link->query($get);
                      while($get_row = $get_result->fetch_assoc()){
                          $get2 = "SELECT employees.*, project.*, shortlist.*, shortlist.id AS shortlist_id, mrf.*  
                                                                                FROM employees employees, projects project, shortlist_master shortlist, mrf mrf
                                                                                WHERE employees.id = shortlist.employee_id 
                                                                                AND project.project_title = shortlist.shortlistnameto 
                                                                                AND mrf.id = project.mrf_id
                                                                                AND mrf.uid = '$id'                                                                                                                
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
            <!-- MRF Form -->
            <li class="menu-item">
              <a href="mrf_form.php" class="menu-link">
                <i class="bi bi-newspaper" style="margin-right: 1rem;"></i>
                <div data-i18n="Analytics">MRF Form</div>
              </a>
            </li>
            <!-- LOA Request -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="bi bi-database" style="margin-right: 1rem;"></i>
                <div data-i18n="Layouts">LOA Database</div>
              </a>
        
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="loa_database.php" class="menu-link">
                    <div data-i18n="Without navbar">LOA Request Status</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="deployed_employee.php" class="menu-link">
                    <div data-i18n="Container">Deployed Employee</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="expired_loa.php" class="menu-link">
                    <div data-i18n="Container">Expired LOA</div>
                  </a>
                </li>
              </ul>
            </li>

            
            
          
            
           
          
          </ul>
        </aside>