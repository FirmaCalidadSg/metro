<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
 
  <link rel="stylesheet" href="../app/Assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../app/Assets/css/kaiadmin.min.css" />

  <link rel="stylesheet" href="../app/Assets/css/globals.css" />
  <link rel="stylesheet" href="../app/Assets/css/style.css" />
  <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
  <link rel="stylesheet" href="../app/Assets/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="../app/Assets/datatable/datatables.css" />
  <link rel="stylesheet" href="../app/Assets/fontawesome-free-5.15.4-web/css/all.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #e4ebdb;" >
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" >
          <a href="index.html" class="logo">
            <img src="../app/Assets/css/images/logo.svg" alt="navbar brand" class="navbar-brand" height="50" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="../demo1/index.html">
                      <span class="sub-item">Dashboard 1</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Components</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Base</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="components/avatars.html">
                      <span class="sub-item">Avatars</span>
                    </a>
                  </li>
                 
                </ul>
              </div>
            </li>
            
            
           
            
            
            
            
            
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div style="background-color: #f2f5f4; padding:2%;" class="main-panel">

     <!--  <div class="container">
        <div class="row">
          <div class="col-md-4">Columna 1</div>
          <div class="col-md-4">Columna 2</div>
          <div class="col-md-4">Columna 3</div>
          <div class="col-md-12">Columna 4</div>
          <div class="col-md-6">Columna 5</div>
          <div class="col-md-6">Columna 6</div>
        </div>
      </div> -->
      

     