<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ablepro v8.0 bootstrap admin template by Phoenixcoded</title>
  <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="">
  <meta name="author" content="Phoenixcoded" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">



</head>

<body class="">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ navigation menu ] start -->
  <nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
      <div class="navbar-content scroll-div ">
        <div class="" style="margin-bottom: 15px;">
          <div class="main-menu-header">
            <img class="img-radius" src="<?= base_url() . "/" . $foto_laboran ?>" alt="User-Profile-Image">
            <div class="user-details">
              <div id="more-details"><?= $nama_laboran . "<br>" . $nip_laboran ?></div>
            </div>
          </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
          <li class="nav-item pcoded-menu-caption">
            <label>Menu</label>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>Dashboard" class="nav-link ">
              <span class="pcoded-micon"><i class="feather icon-home"></i></span>
              <span class="pcoded-mtext">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>TroubleTicket" class="nav-link ">
              <span class="pcoded-micon"><i class="feather icon-thumbs-down"></i></span>
              <span class="pcoded-mtext">Trouble Ticket</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- [ navigation menu ] end -->
  <!-- [ Header ] start -->
  <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      <a href="#!" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="logo" height="28px">
      </a>
      <a href="#!" class="mob-toggler">
        <i class="feather icon-more-vertical"></i>
      </a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li>
          <div class="dropdown drp-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-notification">
              <div class="pro-head">
                <div class="row">
                  <div class="col-lg-3">
                    <img src="<?= base_url() . "/" . $foto_laboran ?>" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <div class="col-lg-9">
                    <span><?= $nama_laboran . "<br>" . $nip_laboran ?></span>
                  </div>
                </div>
              </div>
              <ul class="pro-body">
                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                <li><a href="<?= base_url() ?>Auth/logout" class="dropdown-item"><i class="feather icon-power text-danger"></i> Lock Screen</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </header>
  <!-- [ Header ] end -->
  <!-- [ Main Content ] start -->
  <div class="pcoded-main-container">
    <div class="pcoded-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-lg-7 col-md-12">
          <!-- support-section start -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                  <h2 class="m-0">350</h2>
                  <span class="text-c-blue">Support Requests</span>
                  <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                </div>
                <div id="support-chart"></div>
                <div class="card-footer bg-primary text-white">
                  <div class="row text-center">
                    <div class="col">
                      <h4 class="m-0 text-white">10</h4>
                      <span>Open</span>
                    </div>
                    <div class="col">
                      <h4 class="m-0 text-white">5</h4>
                      <span>Running</span>
                    </div>
                    <div class="col">
                      <h4 class="m-0 text-white">3</h4>
                      <span>Solved</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                  <h2 class="m-0">350</h2>
                  <span class="text-c-green">Support Requests</span>
                  <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                </div>
                <div id="support-chart1"></div>
                <div class="card-footer bg-success text-white">
                  <div class="row text-center">
                    <div class="col">
                      <h4 class="m-0 text-white">10</h4>
                      <span>Open</span>
                    </div>
                    <div class="col">
                      <h4 class="m-0 text-white">5</h4>
                      <span>Running</span>
                    </div>
                    <div class="col">
                      <h4 class="m-0 text-white">3</h4>
                      <span>Solved</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- support-section end -->
        </div>
        <div class="col-lg-5 col-md-12">
          <!-- page statustic card start -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-yellow">$30200</h4>
                      <h6 class="text-muted m-b-0">All Earnings</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-yellow">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">% change</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-green">290+</h4>
                      <h6 class="text-muted m-b-0">Page Views</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-file-text f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-green">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">% change</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-red">145</h4>
                      <h6 class="text-muted m-b-0">Task</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-calendar f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-red">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">% change</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-down text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-blue">500</h4>
                      <h6 class="text-muted m-b-0">Downloads</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-thumbs-down f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-blue">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">% change</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-down text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- page statustic card end -->
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- Button trigger modal -->


  <!-- [ Main Content ] end -->
  <!-- Warning Section start -->
  <!-- Older IE warning message -->
  <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
  <!-- Warning Section Ends -->

  <!-- Required Js -->
  <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/ripple.js"></script>
  <script src="assets/js/pcoded.min.js"></script>

  <!-- Apex Chart -->
  <script src="assets/js/plugins/apexcharts.min.js"></script>
  <!-- custom-chart js -->
  <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>