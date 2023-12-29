<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="assets/css/style.css">
  <title>HRS</title>
</head>

<body>
  <header class="cd-main-header js-cd-main-header">
    <div class="cd-logo-wrapper">
      <a href="#0" class="cd-logo"><img src="assets/img/pcnlogo1.png" alt="Logo"></a>
    </div>

    <!--    <div class="cd-search js-cd-search">
      <form>
        <input class="reset" type="search" placeholder="Search...">
      </form>
    </div>
 -->
    <button class="reset cd-nav-trigger js-cd-nav-trigger" aria-label="Toggle menu"><span></span></button>

    <ul class="cd-nav__list js-cd-nav__list">

      <!--<li class="cd-nav__item"><a href="#0">Tour</a></li>
      <li class="cd-nav__item"><a href="#0">Support</a></li>
      -->
      <li class="cd-nav__item cd-nav__item--has-children cd-nav__item--account js-cd-item--has-children">

        <a href="#0">
          <img src="assets/img/cd-avatar.svg" alt="avatar">
          <span>Account</span>
        </a>

        <ul class="cd-nav__sub-list">
          <li class="cd-nav__sub-item"><a href="#0">My Account</a></li>
          <li class="cd-nav__sub-item"><a href="#0">Edit Account</a></li>
          <li class="cd-nav__sub-item"><a href="#0">Logout</a></li>
        </ul>
      </li>
    </ul>

  </header> <!-- .cd-main-header -->

  <main class="cd-main-content">
    <nav class="cd-side-nav js-cd-side-nav">
      <ul class="cd-side__list js-cd-side__list">
        <li class="cd-side__label"><span>Recruitment Main</span></li>
        <!--<li class="cd-side__item cd-side__item--has-children cd-side__item--overview js-cd-item--has-children">
          <a href="#0">Overview</a>
          
          <ul class="cd-side__sub-list">
            <li class="cd-side__sub-item"><a href="#0">All Data</a></li>
            <li class="cd-side__sub-item"><a href="#0">Category 1</a></li>
            <li class="cd-side__sub-item"><a href="#0">Category 2</a></li>
          </ul>
        </li>

        <li class="cd-side__item cd-side__item--has-children cd-side__item--notifications cd-side__item--selected js-cd-item--has-children">
          <a href="#0">Notifications<span class="cd-count">3</span></a>
          
          <ul class="cd-side__sub-list">
            <li class="cd-side__sub-item"><a aria-current="page" href="#0">All Notifications</a></li>
            <li class="cd-side__sub-item"><a href="#0">Friends</a></li>
            <li class="cd-side__sub-item"><a href="#0">Other</a></li>
          </ul>
        </li>
    
        <li class="cd-side__item cd-side__item--has-children cd-side__item--comments js-cd-item--has-children">
          <a href="#0">Comments</a>
          
          <ul class="cd-side__sub-list">
            <li class="cd-side__sub-item"><a href="#0">All Comments</a></li>
            <li class="cd-side__sub-item"><a href="#0">Edit Comment</a></li>
            <li class="cd-side__sub-item"><a href="#0">Delete Comment</a></li>
          </ul>
        </li>
      </ul>
    -->
        <ul class="cd-side__list js-cd-side__list">
          <!--<li class="cd-side__label"><span>Recruitment Menu</span></li>-->
          <li class="cd-side__item cd-side__item--has-children cd-side__item--bookmarks js-cd-item--has-children">
            <a href="#0">Reports</a>

            <ul class="cd-side__sub-list">
              <form action="" method="POST">
                <li class="cd-side__sub-item"><a><BUTTON class="btn" name="recruitmentr">Recruitment Repots</button></a></li>
                <li class="cd-side__sub-item"><a><BUTTON class="btn" name="shorlistr">Shortlisting Repots</button></a></li>
                <li class="cd-side__sub-item"><a><BUTTON class="btn" name="additionalr">Additional Repots</button></a></li>
              </form>
            </ul>
          </li>

          <!--<li class="cd-side__item cd-side__item--has-children cd-side__item--images js-cd-item--has-children">
          <a href="#0">Images</a>
          
          <ul class="cd-side__sub-list">
            <li class="cd-side__sub-item"><a href="#0">All Images</a></li>
            <li class="cd-side__sub-item"><a href="#0">Edit Image</a></li>
          </ul>
        </li>
    
        <li class="cd-side__item cd-side__item--has-children cd-side__item--users js-cd-item--has-children">
          <a href="#0">Users</a>
          
          <ul class="cd-side__sub-list">

              <form action = "" method = "POST">
            <li class="cd-side__sub-item"><a href="#0">All Users</a></li>
            <li class="cd-side__sub-item"><a><BUTTON class="btn" name = "next1">Edit User</button></a></li>
            <li class="cd-side__sub-item"><a><BUTTON class="btn" name = "next">Add User</button></a></li>
              </form>
          </ul>
        </li>
        -->

        </ul>

        <ul class="cd-side__list js-cd-side__list">

          <form action="" method="POST">
            <li class="cd-side__label"><span>Action</span></li>
            <li class="cd-side__btn"><a><BUTTON class="btn" name="applicant">+ Create New Applicant</button></li>
            <li class="cd-side__btn"><a><BUTTON class="btn" name="shortlist">+ Create New Shortlist</button></a></li>
          </form>

        </ul>
    </nav>






    <?php
    if (isset($_POST['applicant'])) {
      echo '
    <div class="cd-content-wrapper">
      <div class="text-component text-center">
  <h1>dfdsfdResponsive Sidebar Navigation</h1>
<!--- laman -->

        <h1>Responsive Sidebar Navigation</h1>
        <p>👈<a href="https://codyhouse.co/gem/responsive-sidebar-navigation">Article &amp; Download</a></p>
      
<!--- laman -->
      </div>
    </div> <!-- .content-wrapper -->
  ';
    }



    if (isset($_POST['shortlist'])) {
      echo '
    <div class="cd-content-wrapper">
      <div class="text-component text-center">

<!--- laman -->

        <h1>Responsive Sidebar Navigation</h1>
        <p>👈<a href="https://codyhouse.co/gem/responsive-sidebar-navigation">Article &amp; Download</a></p>
      
<!--- laman -->
      </div>
    </div> <!-- .content-wrapper -->
  ';
    }



    if (isset($_POST['recruitmentr'])) {
      echo '
    <div class="cd-content-wrapper">
      <div class="text-component text-center">

<!--- laman -->
recruitmentr
        <h1>Responsive Sidebar Navigation</h1>
        <p>👈<a href="https://codyhouse.co/gem/responsive-sidebar-navigation">Article &amp; Download</a></p>
      
<!--- laman -->
      </div>
    </div> <!-- .content-wrapper -->
  ';
    }


    if (isset($_POST['shorlistr'])) {
      echo '
    <div class="cd-content-wrapper">
      <div class="text-component text-center">
shortlistr
<!--- laman -->

        <h1>Responsive Sidebar Navigation</h1>
        <p>👈<a href="https://codyhouse.co/gem/responsive-sidebar-navigation">Article &amp; Download</a></p>
      
<!--- laman -->
      </div>
    </div> <!-- .content-wrapper -->
  ';
    }

    if (isset($_POST['additionalr'])) {
      echo '
    <div class="cd-content-wrapper">
      <div class="text-component text-center">
additionalr
<!--- laman -->

        <h1>Responsive Sidebar Navigation</h1>
        <p>👈<a href="https://codyhouse.co/gem/responsive-sidebar-navigation">Article &amp; Download</a></p>
      
<!--- laman -->
      </div>
    </div> <!-- .content-wrapper -->
  ';
    }


    ?>

  </main> <!-- .cd-main-content -->
  <script src="assets/js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
  <script src="assets/js/menu-aim.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>