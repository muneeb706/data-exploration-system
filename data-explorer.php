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
  <title>Org Name-DES | Data Explorer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css" />
  <!-- Tabulator -->
  <link href="https://unpkg.com/tabulator-tables@4.5.3/dist/css/tabulator.min.css" rel="stylesheet" />
  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css">
  <link rel="stylesheet" href="./plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  
</head>

<body class="hold-transition sidebar-mini">
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
      <a href="./index.php" class="brand-link">
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
            <li class="nav-item has-treeview">
              <a href="./index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="./data-explorer.php" class="nav-link active">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1>Data Table</h1> -->
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Explorer</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <Section class="content">
        <div class="row">
          <div class="col-12">
            <div id="data-source-selection-tool" class="card">
              <div class="card-header">
                <h4>Data Source Selection Tool</h4>
                <div class="card-tools">
                  <button type="button" title="Minimize" class="btn btn-tool" data-card-widget="collapse"><i
                      class="fas fa-minus"></i></button>
                </div>
              </div>
              <div id="data-source-selection-tool-body" class="card-body">
                <div id="data-source-1" class="row">
                  <div class="form-group col-sm-4">
                    <select id="data-source-1-type" class="form-control select2"
                      onchange="getTableQueryList('data-source-1')" style="width: 100%;">
                      <option value="" disabled selected>Select Type of Data Source</option>
                      <option value="table">Table</option>
                      <option value="query">Query</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <select id="data-source-1-name" class="form-control select2" style="width: 100%;">
                      <option value="" disabled selected>Select Name of Data Source</option>
                    </select>
                  </div>
                  <!-- <div class="form-group col-sm-1">
                    <button id="data-source-add" class="btn btn-block btn-primary" onclick="addDataSource()">
                      <i class="fas fa-plus" style="text-align:center;">
                      </i>
                    </button>
                  </div> -->
                  <div class="form-group col-sm-1">
                    <button id="data-source-submit" title="Load Data" class="btn btn-block btn-success" onclick="populateDataGrid()">
                      <i class="fas fa-check" style="text-align:center;">
                      </i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div id="data-table-section" class="col-12">
            <!-- data-table card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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

    <!-- html templates -->

    <!-- /.data-table card -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="./plugins/datatables/jquery.dataTables.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <!-- Tabulator -->
  <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.5.3/dist/js/tabulator.min.js"></script>

  <!-- XLSX -->
  <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>

  <!-- page script -->
  <script>
    var apiHost = "./api"

    $(document).ready(function () {
      $('.select2').select2();
    });

    var tables = []

    function getTableQueryList(sourceId) {
      var dataSourceTypeSelector = document.getElementById(sourceId).querySelector("#" + sourceId + "-type")
      var selectedDataSourceType = dataSourceTypeSelector.options[dataSourceTypeSelector.selectedIndex].value;
      if (selectedDataSourceType == "table") {
        var xmlhttp = new XMLHttpRequest();
        var url = apiHost+"/table_data.php?request=list"
        var res
        xmlhttp.onload = function () {
          if (this.readyState == 4 && this.status == 200) {
            res = JSON.parse(this.responseText)
            var dataSourceNameSelector = document.getElementById(sourceId).querySelector("#" + sourceId + "-name")
            dataSourceNameSelector.innerHTML = '<option value="" disabled selected>Select Name of Data Source</option>'
            res.forEach(tableName => {
              var option = document.createElement("option");
              option.setAttribute("value", tableName)
              var optionText = document.createTextNode(tableName)
              option.appendChild(optionText)
              dataSourceNameSelector.appendChild(option)
              dataSourceNameSelector.selectedIndex = 0
            })
          }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
      } else if (selectedDataSourceType == "query") {
        var xmlhttp = new XMLHttpRequest();
        var url = apiHost+"/query_data.php?request=list"
        var res
        xmlhttp.onload = function () {
          if (this.readyState == 4 && this.status == 200) {
            res = JSON.parse(this.responseText)
            var dataSourceNameSelector = document.getElementById(sourceId).querySelector("#" + sourceId + "-name")
            dataSourceNameSelector.innerHTML = '<option value="" disabled selected>Select Name of Data Source</option>'
            res.forEach(query => {
              var option = document.createElement("option");
              option.setAttribute("value", query)
              var optionText = document.createTextNode(query.split("-").join(" "))
              option.appendChild(optionText)
              dataSourceNameSelector.appendChild(option)
              dataSourceNameSelector.selectedIndex = 0
            })
          }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
      }
    }

    function addDataSource(event) {

      var lastDataSourceElementId = document.getElementById('data-source-selection-tool-body').lastElementChild.id
      var newDataSourceElementId = lastDataSourceElementId.replace(/\d+$/, function (m) { return parseInt(m) + 1; })
      var newDataSourceTypeId = newDataSourceElementId + "-type"
      var newDataSourceNameId = newDataSourceElementId + "-name"

      var dataSourceSelectorHtml = ''
        + '<div class="form-group col-sm-4">'
        + '<select id="' + newDataSourceTypeId + '" class="form-control select2" onchange=getTableQueryList("' + newDataSourceElementId + '") style="width: 100%;">'
        + '<option value="" disabled selected>Select Type of Data Source</option>'
        + '<option value="table">Table</option>'
        + '<option value="query">Query</option>'
        + '</select>'
        + '</div>'
        + '<div class="form-group col-sm-4">'
        + '<select id="' + newDataSourceNameId + '" class="form-control select2" style="width: 100%;">'
        + '<option value="" disabled selected>Select Name of Data Source</option>'
        + '</select>'
        + '</div>'
        + '<div class="form-group col-sm-1">'
        + '<button id="' + newDataSourceElementId + '" class="btn btn-block btn-danger" onclick="removeDataSource(this)">'
        + '<i class="fas fa-minus" style="text-align:center;"></i>'
        + '</button>'
        + '</div>'
      var dataSourceSelectorParent = document.createElement('div')
      dataSourceSelectorParent.id = newDataSourceElementId
      dataSourceSelectorParent.className = "row"
      dataSourceSelectorParent.innerHTML = dataSourceSelectorHtml
      document.getElementById('data-source-selection-tool-body').appendChild(dataSourceSelectorParent)
      $('.select2').select2()

    }

    function removeDataSource(source) {
      var dataSource = document.getElementById(source.id)
      dataSource.parentNode.removeChild(dataSource)
    }

    function refereshDSSelectionTool() {
      var dsSelectionToolElem = document.getElementById("data-source-selection-tool-body")
      while (dsSelectionToolElem.children.length > 1) {
        dsSelectionToolElem.removeChild(dsSelectionToolElem.lastChild);
      }
      document.getElementById("data-source-1").querySelector("#data-source-1-type").selectedIndex = 0
      var dataSourceNameElem = document.getElementById("data-source-1").querySelector("#data-source-1-name")
      dataSourceNameElem.selectedIndex = 0
      while (dataSourceNameElem.children.length > 1) {
        dataSourceNameElem.removeChild(dataSourceNameElem.lastChild);
      }
      $('.select2').select2()
    }

    function getDataGridHTML() {
      var html = '' +
        '   <div id="data-table-template" class="card" >  ' +
        '         <div id="data-table-header" class="card-header">  ' +
        '           <h4 id="data-table-headline">Table | Query Name</h4>  ' +
        '           <div class="card-tools">  ' +
        '             <button type="button" title="Minimize" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>  ' +
        '           </div>  ' +
        '         </div>  ' +
        '         <div id="data-table-body" class="card-body">  ' +
        '           <div class="card-header">  ' +
        '             <div class="row col-sm-9">  ' +
        '               <div class="form-group col-sm-1">  ' +
        '                 <button id="data-table-template-download" title="Download Data" class="btn btn-block btn-success" onclick="downloadTable(this)">  ' +
        '                   <i class="fas fa-file-download">  ' +
        '                   </i>  ' +
        '                 </button>  ' +
        '               </div>  ' +
        '               <div class="form-group col-sm-1">  ' +
        '                 <button id="data-table-template-clear-filter" title="Refresh Data" class="btn btn-block btn-warning" onclick="clearDataHeaderFilter(this)">  ' +
        '                   <i class="fas fa-undo">  ' +
        '                   </i>  ' +
        '                 </button>  ' +
        '               </div>  ' +
        '               <div class="form-group col-sm-2 align-self-center"> ' +
        '                 <b>Records Per Page:</b>' +
        '               </div>' +
        '               <div class="form-group col-sm-2">' +
        '                 <select id="data-table-template-records-per-page" class="form-control select2" onchange="resetRecordsPerPage(this)" style="width: 100%;">' +
        '                   <option value="100" selected>100</option>' +
        '                   <option value="500">500</option>' +
        '                   <option value="1000">1000</option>' +
        '                 </select>' +
        '               </div>' +
        '             </div>  ' +
        '           </div>  ' +
        '           <!-- /.card-header -->  ' +
        '           <div class="card-body text-right">  ' +
        '             <b id="total-records">Total Records in Database: </b> ' +
        '             <div id="data-grid-template"></div>  ' +
        '           </div>  ' +
        '           <!-- /.card-body -->   ' +
        '      </div>  ';

      return html
    }

    function getLoadingIndicatorHtml() {
      var html = ""
      + '<div id="loading-indicator" class="overlay">'
      +    '<i class="fas fa-5x fa-sync-alt fa-spin"></i>'
      +  '</div>'
      return html
    }

    //custom max min header filter
    var minMaxFilterEditor = function(cell, onRendered, success, cancel, editorParams){

      var container = document.createElement('span')

      //create and style inputs
      var start = $("<input type='number' placeholder='Min'/>");
      var end = $("<input type='number' placeholder='Max'/>");

      $(container).append(start).append(end);

      var inputs = $("input", container);

      inputs.css({
          "padding":"4px",
          "width":"50%",
          "box-sizing":"border-box",
      })
      .val(cell.getValue());

      function buildValues(){
        if(start.val() == ""  && end.val() == "") {
          return ""
        } else {
          return start.val() + "-" + end.val()
        } 
      }

      //submit new value on enter
      inputs.on("keydown", function(e){
          if(e.keyCode == 13){
              success(buildValues());
          }

          if(e.keyCode == 27){
              cancel();
          }
      });

      return container;
    }

    
    // array for storing properties of all the tables(Tabulator) loaded in the page.
    var tables = []

    function populateDataGrid() {

      document.getElementById("data-table-section").innerHTML = ""
      var dataGridHtml = getDataGridHTML()
      var tempLIDiv = document.createElement("div")
      tempLIDiv.innerHTML = getLoadingIndicatorHtml()
      var dataSourceSelectionTool = document.getElementById("data-source-selection-tool")
      dataSourceSelectionTool.appendChild(tempLIDiv.firstElementChild)
      tables=[]
      //two requests are generating for first page no.
      getData().then((dataList) => {
        
        var count = 1
        var clonedElement

        dataList.forEach(data => {
          var tempDiv = document.createElement('div')
          tempDiv.innerHTML = dataGridHtml
          clonedElement = tempDiv.querySelector("#data-table-template")
          clonedElement.id = "data-table-" + count
          var clonedElementGrid = clonedElement.querySelector("#data-grid-template")
          clonedElementGrid.id = "data-grid-" + count
          var clonedElementTotalRecordH = clonedElement.querySelector("#total-records")
          clonedElementTotalRecordH.id = "total-records-" + count
          clonedElementTotalRecordH.innerHTML = "Total Records in Database: " + data["totalRecordsInDB"]
          var clonedElementDownload = clonedElement.querySelector("#data-table-template-download")
          clonedElementDownload.id = "data-table-" + count + '-download'
          var clonedElementRefresh = clonedElement.querySelector("#data-table-template-clear-filter")
          clonedElementRefresh.id = "data-table-" + count + '-clear-filter'
          var clonedElementRecordsPerPage = clonedElement.querySelector("#data-table-template-records-per-page")
          clonedElementRecordsPerPage.id = "data-table-" + count + '-records-per-page'
          clonedElement.querySelector("#data-table-headline").innerHTML = data["name"].split("-").join(" ")
          document.getElementById("data-table-section").appendChild(tempDiv.firstElementChild)
          var cols = [{formatter:"rownum", align:"center", width:40}]

          if(data["data"].length > 0) {
            Object.keys(data["data"][0]).forEach(colName=>{
              var colProps = {}
              colProps["title"] = colName
              colProps["field"] = colName
              colProps["width"] = 150
              if (data["numericCols"].indexOf(colName)>=0 ) {
                colProps["headerFilter"] = minMaxFilterEditor
              } else if (Object.keys(data["dropdownCols"]).indexOf(colName)>=0) {
                colProps["headerFilter"] = "select"
                colProps["headerFilterParams"] = data["dropdownCols"][colName]
              } else {
                colProps["headerFilter"] = "input"
              }
              colProps["headerFilterLiveFilter"] = false
              cols.push(colProps)
            })
          }

          var table = new Tabulator("#" + clonedElementGrid.id, {
            layout: "fitDataStretch",
            height: "550px",
            autoColumns: false,
            columns: cols,
            //data: data["data"],
            pagination: "remote",
            paginationSize: 100,
            ajaxURL:(data["type"]=="table")?apiHost+"/table_data.php":apiHost+"/query_data.php",
            ajaxParams:{request: "data", dataSource: data["name"]},
            ajaxFiltering:true,
            selectable: true,
            ajaxResponse:function(url, params, response){
              //url - the URL of the request
              //params - the parameters passed with the request
              //response - the JSON object returned in the body of the response.
              clonedElement.querySelector("#"+clonedElementTotalRecordH.id).innerHTML = "Total Records in Database: " + response["totalRecordsInDB"]
              return response; //return the response data to tabulator
            },
          });
          clonedElement.style.display = "block"
          tables.push({"downloadId":clonedElementDownload.id, "refreshId":clonedElementRefresh.id, 
            "recordsPerPageId": clonedElementRecordsPerPage.id, "table": table, "name": data["name"]})
          count++;
        })
        //removing loading indicator
        dataSourceSelectionTool.removeChild(dataSourceSelectionTool.lastChild)
        $('.select2').select2()
      })
    }

    function getData() {
      return new Promise((resolve, reject) => {
        var totalDataReceived = 0
        var dsSelectionToolElem = document.getElementById('data-source-selection-tool-body')
        var totalDataSources = dsSelectionToolElem.children.length
        var dataList = []
        for (var i = 0; i < totalDataSources; i++) {
          var dataSource = dsSelectionToolElem.children[i]
          var dataSourceTypeSelector = dataSource.querySelector("#" + dataSource.id + "-type")
          var dataSourceNameSelector = dataSource.querySelector("#" + dataSource.id + "-name")
          var data = {}
          var type = dataSourceTypeSelector.options[dataSourceTypeSelector.selectedIndex].value
          var name = dataSourceNameSelector.options[dataSourceNameSelector.selectedIndex].value
          if (type != "" && name != "") {
            data["type"] = type
            data["name"] = name
            data["data"] = []
            dataList.push(data)
            if (data["type"] == "table") {
              var xmlhttp = new XMLHttpRequest();
              var url = apiHost+"/table_data.php?request=data&dataSource=" + data["name"];
              var res
              xmlhttp.onload = function () {
                if (this.readyState == 4 && this.status == 200) {
                  res = JSON.parse(this.responseText)
                  var data = dataList.find(data => data["type"] == res["type"] && data["name"] == res["name"])
                  data["data"] = res["data"]
                  data["numericCols"] = res["numericCols"]
                  data["dropdownCols"] = res["dropdownCols"]
                  totalDataReceived++
                  if (totalDataReceived == totalDataSources) {
                    resolve(dataList)
                  }
                } else {
                  alert("Failed to receive data from server.")
                }
              };
              xmlhttp.open("GET", url, true);
              xmlhttp.send();
            } else if (data["type"] == "query") {
              var xmlhttp = new XMLHttpRequest();
              var url = apiHost+"/query_data.php?request=data&dataSource=" + data["name"];
              var res
              xmlhttp.onload = function () {
                if (this.readyState == 4 && this.status == 200) {
                  res = JSON.parse(this.responseText)
                  var data = dataList.find(data => data["type"] == res["type"] && data["name"] == res["name"])
                  data["data"] = res["data"]
                  data["numericCols"] = res["numericCols"]
                  data["dropdownCols"] = res["dropdownCols"]
                  totalDataReceived++
                  if (totalDataReceived == totalDataSources) {
                    resolve(dataList)
                  }
                } else {
                  alert("Failed to receive data from server.")
                }
              };
              xmlhttp.open("GET", url, true);
              xmlhttp.send();
            }
          } else {
            totalDataReceived++
            if (totalDataReceived == totalDataSources) {
                resolve(dataList)
            }
          }
        }
      })
    }

    function downloadTable(source) {
      var table = tables.find(table=>table["downloadId"]==source.id)
      table["table"].download("csv", table["name"]+"-"+table["table"].getPage()+".csv", { sheetName: "data" });
    }

    function clearDataHeaderFilter(source) {
      var table = tables.find(table=>table["refreshId"]==source.id)
      table["table"].clearHeaderFilter()
    }

    function resetRecordsPerPage(source) {
      var table = tables.find(table=>table["recordsPerPageId"]==source.id)
      var pageSize = document.getElementById(source.id).value
      table["table"].setPageSize(pageSize)
      table["table"].clearHeaderFilter()
    }

  </script>
</body>

</html>