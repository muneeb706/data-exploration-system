document.addEventListener("DOMContentLoaded", function () {
  $(".select2").select2();
});

var tables = [];

function getTableQueryList(sourceId) {
  var dataSourceTypeSelector = document
    .getElementById(sourceId)
    .querySelector("#" + sourceId + "-type");
  var selectedDataSourceType =
    dataSourceTypeSelector.options[dataSourceTypeSelector.selectedIndex].value;
  if (selectedDataSourceType == "table") {
    var xmlhttp = new XMLHttpRequest();
    var url = "/table_list";
    var res;
    xmlhttp.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        res = JSON.parse(this.responseText);
        var dataSourceNameSelector = document
          .getElementById(sourceId)
          .querySelector("#" + sourceId + "-name");
        dataSourceNameSelector.innerHTML =
          '<option value="" disabled selected>Select Name of Data Source</option>';
        res["data"].forEach((tableName) => {
          var option = document.createElement("option");
          option.setAttribute("value", tableName);
          var optionText = document.createTextNode(tableName);
          option.appendChild(optionText);
          dataSourceNameSelector.appendChild(option);
          dataSourceNameSelector.selectedIndex = 0;
        });
      }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  } else if (selectedDataSourceType == "query") {
    var xmlhttp = new XMLHttpRequest();
    var url = "/query_list";
    var res;
    xmlhttp.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        res = JSON.parse(this.responseText);
        var dataSourceNameSelector = document
          .getElementById(sourceId)
          .querySelector("#" + sourceId + "-name");
        dataSourceNameSelector.innerHTML =
          '<option value="" disabled selected>Select Name of Data Source</option>';
        res["data"].forEach((query) => {
          var option = document.createElement("option");
          option.setAttribute("value", query);
          var optionText = document.createTextNode(query.split("-").join(" "));
          option.appendChild(optionText);
          dataSourceNameSelector.appendChild(option);
          dataSourceNameSelector.selectedIndex = 0;
        });
      }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  }
}

function getDataGridHTML() {
  var html =
    "" +
    '   <div id="data-table-template" class="card" >  ' +
    '         <div id="data-table-header" class="card-header">  ' +
    '           <h4 id="data-table-headline">Table | Query Name</h4>  ' +
    '           <div class="card-tools">  ' +
    '             <button type="button" title="Minimize" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>  ' +
    "           </div>  " +
    "         </div>  " +
    '         <div id="data-table-body" class="card-body">  ' +
    '           <div class="card-header">  ' +
    '             <div class="row col-sm-9">  ' +
    '               <div class="form-group col-sm-1">  ' +
    '                 <button id="data-table-template-download" title="Download Data" class="btn btn-block btn-success" onclick="downloadTable(this)">  ' +
    '                   <i class="fas fa-file-download">  ' +
    "                   </i>  " +
    "                 </button>  " +
    "               </div>  " +
    '               <div class="form-group col-sm-1">  ' +
    '                 <button id="data-table-template-clear-filter" title="Refresh Data" class="btn btn-block btn-warning" onclick="clearDataHeaderFilter(this)">  ' +
    '                   <i class="fas fa-undo">  ' +
    "                   </i>  " +
    "                 </button>  " +
    "               </div>  " +
    '               <div class="form-group col-sm-2 align-self-center"> ' +
    "                 <b>Records Per Page:</b>" +
    "               </div>" +
    '               <div class="form-group col-sm-2">' +
    '                 <select id="data-table-template-records-per-page" class="form-control select2" onchange="resetRecordsPerPage(this)" style="width: 100%;">' +
    '                   <option value="100" selected>100</option>' +
    '                   <option value="500">500</option>' +
    '                   <option value="1000">1000</option>' +
    "                 </select>" +
    "               </div>" +
    "             </div>  " +
    "           </div>  " +
    "           <!-- /.card-header -->  " +
    '           <div class="card-body text-right">  ' +
    '             <b id="total-records">Total Records in Database: </b> ' +
    '             <div id="data-grid-template"></div>  ' +
    "           </div>  " +
    "           <!-- /.card-body -->   " +
    "      </div>  ";

  return html;
}

function getLoadingIndicatorHtml() {
  var html =
    "" +
    '<div id="loading-indicator" class="overlay">' +
    '<i class="fas fa-5x fa-sync-alt fa-spin"></i>' +
    "</div>";
  return html;
}

//custom max min header filter
var minMaxFilterEditor = function (
  cell,
  onRendered,
  success,
  cancel,
  editorParams
) {
  var container = document.createElement("span");

  //create and style inputs
  var start = $("<input type='number' placeholder='Min'/>");
  var end = $("<input type='number' placeholder='Max'/>");

  $(container).append(start).append(end);

  var inputs = $("input", container);

  inputs
    .css({
      padding: "4px",
      width: "50%",
      "box-sizing": "border-box",
    })
    .val(cell.getValue());

  function buildValues() {
    if (start.val() == "" && end.val() == "") {
      return "";
    } else {
      return start.val() + "-" + end.val();
    }
  }

  //submit new value on enter
  inputs.on("keydown", function (e) {
    if (e.keyCode == 13) {
      success(buildValues());
    }

    if (e.keyCode == 27) {
      cancel();
    }
  });

  return container;
};

// array for storing properties of all the tables(Tabulator) loaded in the page.
var tables = [];

function populateDataGrid() {
  document.getElementById("data-table-section").innerHTML = "";
  var dataGridHtml = getDataGridHTML();
  var tempLIDiv = document.createElement("div");
  tempLIDiv.innerHTML = getLoadingIndicatorHtml();
  var dataSourceSelectionTool = document.getElementById(
    "data-source-selection-tool"
  );
  dataSourceSelectionTool.appendChild(tempLIDiv.firstElementChild);
  tables = [];
  //two requests are generating for first page no.
  getData().then((dataList) => {
    var count = 1;
    var clonedElement;

    dataList.forEach((data) => {
      var tempDiv = document.createElement("div");
      tempDiv.innerHTML = dataGridHtml;
      clonedElement = tempDiv.querySelector("#data-table-template");
      clonedElement.id = "data-table-" + count;
      var clonedElementGrid = clonedElement.querySelector(
        "#data-grid-template"
      );
      clonedElementGrid.id = "data-grid-" + count;
      var clonedElementTotalRecordH =
        clonedElement.querySelector("#total-records");
      clonedElementTotalRecordH.id = "total-records-" + count;
      clonedElementTotalRecordH.innerHTML =
        "Total Records in Database: " + data["totalRecordsInDB"];
      var clonedElementDownload = clonedElement.querySelector(
        "#data-table-template-download"
      );
      clonedElementDownload.id = "data-table-" + count + "-download";
      var clonedElementRefresh = clonedElement.querySelector(
        "#data-table-template-clear-filter"
      );
      clonedElementRefresh.id = "data-table-" + count + "-clear-filter";
      var clonedElementRecordsPerPage = clonedElement.querySelector(
        "#data-table-template-records-per-page"
      );
      clonedElementRecordsPerPage.id =
        "data-table-" + count + "-records-per-page";
      clonedElement.querySelector("#data-table-headline").innerHTML = data[
        "name"
      ]
        .split("-")
        .join(" ");
      document
        .getElementById("data-table-section")
        .appendChild(tempDiv.firstElementChild);
      var cols = [{ formatter: "rownum", align: "center", width: 40 }];

      if (data["data"].length > 0) {
        Object.keys(data["data"][0]).forEach((colName) => {
          var colProps = {};
          colProps["title"] = colName;
          colProps["field"] = colName;
          colProps["width"] = 150;
          if (data["numericCols"].indexOf(colName) >= 0) {
            colProps["headerFilter"] = minMaxFilterEditor;
          } else if (Object.keys(data["dropdownCols"]).indexOf(colName) >= 0) {
            colProps["headerFilter"] = "select";
            colProps["headerFilterParams"] = data["dropdownCols"][colName];
          } else {
            colProps["headerFilter"] = "input";
          }
          colProps["headerFilterLiveFilter"] = false;
          cols.push(colProps);
        });
      }

      var table = new Tabulator("#" + clonedElementGrid.id, {
        layout: "fitDataStretch",
        height: "550px",
        autoColumns: false,
        columns: cols,
        //data: data["data"],
        pagination: "remote",
        paginationSize: 100,
        ajaxURL: data["type"] == "table" ? "/table_data" : "/query_data",
        ajaxParams: { dataSource: data["name"] },
        ajaxFiltering: true,
        selectable: true,
        ajaxResponse: function (url, params, response) {
          //url - the URL of the request
          //params - the parameters passed with the request
          //response - the JSON object returned in the body of the response.
          clonedElement.querySelector(
            "#" + clonedElementTotalRecordH.id
          ).innerHTML =
            "Total Records in Database: " + response["totalRecordsInDB"];
          return response; //return the response data to tabulator
        },
      });
      clonedElement.style.display = "block";
      tables.push({
        downloadId: clonedElementDownload.id,
        refreshId: clonedElementRefresh.id,
        recordsPerPageId: clonedElementRecordsPerPage.id,
        table: table,
        name: data["name"],
      });
      count++;
    });
    //removing loading indicator
    dataSourceSelectionTool.removeChild(dataSourceSelectionTool.lastChild);
    $(".select2").select2();
  });
}

function getData() {
  return new Promise((resolve, reject) => {
    var totalDataReceived = 0;
    var dsSelectionToolElem = document.getElementById(
      "data-source-selection-tool-body"
    );
    var totalDataSources = dsSelectionToolElem.children.length;
    var dataList = [];
    for (var i = 0; i < totalDataSources; i++) {
      var dataSource = dsSelectionToolElem.children[i];
      var dataSourceTypeSelector = dataSource.querySelector(
        "#" + dataSource.id + "-type"
      );
      var dataSourceNameSelector = dataSource.querySelector(
        "#" + dataSource.id + "-name"
      );
      var data = {};
      var type =
        dataSourceTypeSelector.options[dataSourceTypeSelector.selectedIndex]
          .value;
      var name =
        dataSourceNameSelector.options[dataSourceNameSelector.selectedIndex]
          .value;
      if (type != "" && name != "") {
        data["type"] = type;
        data["name"] = name;
        data["data"] = [];
        dataList.push(data);
        if (data["type"] == "table") {
          var xmlhttp = new XMLHttpRequest();
          var url = "/table_data?dataSource=" + data["name"];
          var res;
          xmlhttp.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
              res = JSON.parse(this.responseText);
              var data = dataList.find(
                (data) =>
                  data["type"] == res["type"] && data["name"] == res["name"]
              );
              data["data"] = res["data"];
              data["numericCols"] = res["numericCols"];
              data["dropdownCols"] = res["dropdownCols"];
              totalDataReceived++;
              if (totalDataReceived == totalDataSources) {
                resolve(dataList);
              }
            } else {
              alert("Failed to receive data from server.");
            }
          };
          xmlhttp.open("GET", url, true);
          xmlhttp.send();
        } else if (data["type"] == "query") {
          var xmlhttp = new XMLHttpRequest();
          var url = "/query_data?dataSource=" + data["name"];
          var res;
          xmlhttp.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
              res = JSON.parse(this.responseText);
              var data = dataList.find(
                (data) =>
                  data["type"] == res["type"] && data["name"] == res["name"]
              );
              data["data"] = res["data"];
              data["numericCols"] = res["numericCols"];
              data["dropdownCols"] = res["dropdownCols"];
              totalDataReceived++;
              if (totalDataReceived == totalDataSources) {
                resolve(dataList);
              }
            } else {
              alert("Failed to receive data from server.");
            }
          };
          xmlhttp.open("GET", url, true);
          xmlhttp.send();
        }
      } else {
        totalDataReceived++;
        if (totalDataReceived == totalDataSources) {
          resolve(dataList);
        }
      }
    }
  });
}

function downloadTable(source) {
  var table = tables.find((table) => table["downloadId"] == source.id);
  table["table"].download(
    "csv",
    table["name"] + "-" + table["table"].getPage() + ".csv",
    { sheetName: "data" }
  );
}

function clearDataHeaderFilter(source) {
  var table = tables.find((table) => table["refreshId"] == source.id);
  table["table"].clearHeaderFilter();
}

function resetRecordsPerPage(source) {
  var table = tables.find((table) => table["recordsPerPageId"] == source.id);
  var pageSize = document.getElementById(source.id).value;
  table["table"].setPageSize(pageSize);
  table["table"].clearHeaderFilter();
}
