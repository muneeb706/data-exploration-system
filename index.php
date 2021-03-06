<?php
session_start();
if(empty($_SESSION["sessionId"]) or !isset($_SESSION["sessionId"])) {
  header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Organization Name - DES | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link
    href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"
    rel="stylesheet" />
  <!-- <link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css">
  <link rel="stylesheet" href="./plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
            <a class="nav-link" id="log-out" title="log out" href="./api/logout.php">
              <i class="fas fa-sign-out-alt"></i>
            </a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="./dist/img/Logo.png" alt="Organization Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8" />
        <span class="brand-text font-weight-light">Org Name - DES</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./dist/img/profile-pic.jpg" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="./index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="./data-explorer.php" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Data Explorer
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="./data-downloader.php" class="nav-link">
                <i class="nav-icon fas fa-download"></i>
                <p>
                  Data Downloader
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div id="entity1-count" class="small-box bg-info">
                <div id="entity1" class="inner">
                  <h3>150</h3>
                  <p>Entity - 1</p>
                </div>
                <div class="icon">
                  <i class="ion ion-waterdrop"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div id="entity2-count" class="small-box bg-success">
                <div class="inner">
                  <h3>53</h3>
                  <p>Entity - 2</p>
                </div>
                <div class="icon">
                  <i class="ion ion-beaker"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div id="entity3-count" class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>
                  <p>Entity - 3</p>
                </div>
                <div class="icon">
                  <i class="ion ion-gear-b"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div id="entity4-count" class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>
                  <p>Entity - 4</p>
                </div>
                <div class="icon">
                  <i class="ion ion-erlenmeyer-flask"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card" id="entity5Viz">
                <div class="card-header">
                  <h5 class="card-title">Entity - 5 Line Graph</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <!-- <div class="btn-group">
                      <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item">Something else here</a>
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>
                      </div>
                    </div> -->
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <!-- <p class="text-center">
                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                      </p> -->

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="entity5Chart" height="180" style="height: 180px;"></canvas>
                      </div>
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="form-group col-md-4">
                      <!-- <p class="text-center">
                        <strong>Goal Completion</strong>
                      </p>-->
                      <label>Select Year Range</label>

                      <div class="form-group input-group input-daterange" id="year-range">
                        <input id="year-from" type="text" class="form-control" value="1990">
                        <div class="input-group-text">to</div>
                        <input id="year-to" type="text" class="form-control" value="2000">
                      </div>

                      <div class="form-group">
                        <label>Select Element</label>
                        <select id="element-select"class="form-control select2" data-placeholder="Select Element" style="width: 100%;">
                        </select>
                      </div>

                      <div class="form-group">
                        <button id="chart-submit" title="Load Data" class="btn btn-block btn-success"
                          onclick="loadChartData()">
                          Apply
                        </button>
                      </div>

                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                  
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>&copy; 2020 - <a href="#" target="_blank">Muneeb Shahid</a></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->

  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="./dist/js/demo.js"></script>

  <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
  <script
    src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="./plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="./plugins/raphael/raphael.min.js"></script>
  <script src="./plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="./plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="./plugins/chart.js/Chart.min.js"></script>

  <!-- daterangepicker -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/daterangepicker/daterangepicker.js"></script>

  <!-- PAGE SCRIPTS -->
  <script src="./dist/js/dashboard.js"></script>
  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>

  <script>
    var apiHost = "./api"
    $(document).ready(function () {
      $('.select2').select2();
    });

    $('#year-range input').each(function () {
      $(this).datepicker({
        autoclose: true,
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years"
      });
      //$(this).datepicker('clearDates');
    });

    function getLoadingIndicatorHtml() {
      var html =
        "" +
        '<div id="loading-indicator" class="overlay">' +
        '<i class="fas fa-5x fa-sync-alt fa-spin"></i>' +
        "</div>";
      return html;
    }

    var defaultElementCodeDescription = "ABC, DEF, GHI AS N"
    loadCounts()
    loadElement()
    loadChartData(true)


    function loadCounts() {
      var tempLIDiv1 = document.createElement("div")
      tempLIDiv1.innerHTML = getLoadingIndicatorHtml()
      var entity1sCountBox = document.getElementById("entity1-count")
      entity1sCountBox.appendChild(tempLIDiv1.firstElementChild)
      var entity1sCountXmlhttp = new XMLHttpRequest();
      var entity1sCountUrl = apiHost + "/dashboard_data.php?request=count&dataSource=ENTITY1";
      var entity1sCountres
      entity1sCountXmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          entity1sCountres = JSON.parse(this.responseText)
          entity1sCountBox.querySelector("h3").innerHTML = entity1sCountres["totalRecordsInDB"]
          entity1sCountBox.removeChild(entity1sCountBox.lastChild)
        }
      };
      entity1sCountXmlhttp.open("GET", entity1sCountUrl, true);
      entity1sCountXmlhttp.send();

      var tempLIDiv2 = document.createElement("div")
      tempLIDiv2.innerHTML = getLoadingIndicatorHtml()
      var entity2sCountBox = document.getElementById("entity2-count")
      entity2sCountBox.appendChild(tempLIDiv2.firstElementChild)

      var entity2sCountXmlhttp = new XMLHttpRequest();
      var entity2sCountUrl = apiHost + "/dashboard_data.php?request=count&dataSource=ENTITY2";
      var entity2sCountres
      entity2sCountXmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          entity2sCountres = JSON.parse(this.responseText)
          entity2sCountBox.querySelector("h3").innerHTML = entity2sCountres["totalRecordsInDB"]
          entity2sCountBox.removeChild(entity2sCountBox.lastChild)
        } else {
          alert("Failed to get Entity 2 count from server.")
        }
      };
      entity2sCountXmlhttp.open("GET", entity2sCountUrl, true);
      entity2sCountXmlhttp.send();

      var tempLIDiv3 = document.createElement("div")
      tempLIDiv3.innerHTML = getLoadingIndicatorHtml()
      var entity3CountBox = document.getElementById("entity3-count")
      entity3CountBox.appendChild(tempLIDiv3.firstElementChild)
      var entity3CountXmlhttp = new XMLHttpRequest();
      var entity3CountUrl = apiHost + "/dashboard_data.php?request=count&dataSource=ENTITY3";
      var entity3Countres
      entity3CountXmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          entity3Countres = JSON.parse(this.responseText)
          entity3CountBox.querySelector("h3").innerHTML = entity3Countres["totalRecordsInDB"]
          entity3CountBox.removeChild(entity3CountBox.lastChild)
        } else {
          alert("Failed to get Entity 3 count from server.")
        }
      };
      entity3CountXmlhttp.open("GET", entity3CountUrl, true);
      entity3CountXmlhttp.send();

      var tempLIDiv4 = document.createElement("div")
      tempLIDiv4.innerHTML = getLoadingIndicatorHtml()
      var entity4CountBox = document.getElementById("entity4-count")
      entity4CountBox.appendChild(tempLIDiv4.firstElementChild)
      var entity4CountXmlhttp = new XMLHttpRequest();
      var entity4CountUrl = apiHost + "/dashboard_data.php?request=count&dataSource=ELEMENT_CODE";
      var entity4Countres
      entity4CountXmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          entity4Countres = JSON.parse(this.responseText)
          entity4CountBox.querySelector("h3").innerHTML = entity4Countres["totalRecordsInDB"]
          entity4CountBox.removeChild(entity4CountBox.lastChild)
        } else {
          alert("Failed to get Entity 4 count from server.")
        }
      };
      entity4CountXmlhttp.open("GET", entity4CountUrl, true);
      entity4CountXmlhttp.send();
    }

    function loadElement() {

      var elementSelect = document.getElementById("element-select")
      var xmlhttp = new XMLHttpRequest();
      var url = apiHost+"/dashboard_data.php?request=element-list"
      var res
      xmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          res = JSON.parse(this.responseText)
          elementSelect.innerHTML = '<option value="" disabled>Select Element</option>'
          index = 1
          elementSelect.selectedIndex = 0
          res['data'].forEach(element => {
              var option = document.createElement("option");
              option.setAttribute("value", element["DESCRIPTION"])
              var optionText = document.createTextNode(element["DESCRIPTION"])
              option.appendChild(optionText)
              if(element["DESCRIPTION"]==defaultElementCodeDescription) {
                option.setAttribute("selected", "selected")  
                elementSelect.selectedIndex = index
              }
              elementSelect.appendChild(option)
              index++;
            })
          } else {
              alert("Failed to get element list from server.")
          }
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
    }

    //  //-----------------------
    //- CHART -
    //-----------------------

    // Get context with jQuery - using jQuery's .get() method.
    var entity5ChartCanvas = $('#entity5Chart').get(0).getContext('2d')


    var entity5ChartData = {
      labels: [],
      datasets: [
        {
          label: 'Digital Goods',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    }

    var entity5ChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          },
          scaleLabel: {
            display: true,
            labelString: 'Year'
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          },
          scaleLabel: {
            display: true,
            labelString: 'Percentage %'
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var entity5Chart = new Chart(entity5ChartCanvas, {
      type: 'line',
      data: entity5ChartData,
      options: entity5ChartOptions
    }
    )

    function loadChartData(init=false) {
      var tempLIDiv1 = document.createElement("div")
      tempLIDiv1.innerHTML = getLoadingIndicatorHtml()
      var entity5Viz = document.getElementById("entity5Viz")
      entity5Viz.appendChild(tempLIDiv1.firstElementChild)
      var elementSelect = document.getElementById("element-select")
      var elementValue = (init)?defaultElementCodeDescription:elementSelect.options[elementSelect.selectedIndex].value
      // encoding plus '+' symbol as it is treated as space in url
      elementValue = elementValue.replace(/\+/g, "PLUS-SIGN")
      var yearFromValue = document.getElementById("year-from").value.trim()
      var yearToValue = document.getElementById("year-to").value.trim()
      var xmlhttp = new XMLHttpRequest();
      var url = apiHost+"/dashboard_data.php?request=timeline&elementCodeDescription="+elementValue+"&yearFrom="+yearFromValue+"&yearTo="+yearToValue
      var res
      xmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          res = JSON.parse(this.responseText)
          labels = []
          data = []
          Object.keys(res['data']).forEach(year => {
            labels.push(year)
            data.push(res['data'][year])
          })
          entity5ChartData["labels"] = labels
          entity5ChartData["datasets"][0]["data"] = data
          entity5Chart["data"] = entity5ChartData
          entity5Chart.update()
         } else {
            alert("Failed to get chart data for given element from server.")
         }
         entity5Viz.removeChild(entity5Viz.lastChild)
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
      

    }


//---------------------------
//- END CHART -
//---------------------------

  </script>
</body>

</html>