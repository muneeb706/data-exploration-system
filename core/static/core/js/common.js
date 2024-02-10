function getLoadingIndicatorHtml() {
  var html =
    "" +
    '<div id="loading-indicator" class="overlay">' +
    '<i class="fas fa-5x fa-sync-alt fa-spin"></i>' +
    "</div>";
  return html;
}

function createAndAppendOptions(
  dataSourceNameSelector,
  data,
  transformFunc = (x) => x
) {
  dataSourceNameSelector.innerHTML =
    '<option value="" disabled selected>Select Name of Data Source</option>';
  data.forEach((item) => {
    const option = document.createElement("option");
    option.value = item;
    option.text = transformFunc(item);
    dataSourceNameSelector.appendChild(option);
  });
  dataSourceNameSelector.selectedIndex = 0;
}

function getTableQueryList(sourceId) {
  const dataSourceTypeSelector = document
    .getElementById(sourceId)
    .querySelector(`#${sourceId}-type`);
  const selectedDataSourceType = dataSourceTypeSelector.value;
  const url =
    selectedDataSourceType === "table" ? "/table_list" : "/query_list";
  const transformFunc =
    selectedDataSourceType === "query"
      ? (query) => query.split("-").join(" ")
      : undefined;

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error(
          `Failed to get ${selectedDataSourceType} list from server.`
        );
      }
      return response.json();
    })
    .then((data) => {
      const dataSourceNameSelector = document
        .getElementById(sourceId)
        .querySelector(`#${sourceId}-name`);
      createAndAppendOptions(
        dataSourceNameSelector,
        data["data"],
        transformFunc
      );
    })
    .catch((error) => {
      alert(error.message);
    });
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

// custom max min header filter
const minMaxFilterEditor = (cell, onRendered, success, cancel) => {
  const container = document.createElement("span");

  // create and style inputs
  const start = $("<input type='number' placeholder='Min'/>");
  const end = $("<input type='number' placeholder='Max'/>");

  $(container).append(start, end);

  const inputs = $("input", container);

  inputs
    .css({
      padding: "4px",
      width: "50%",
      "box-sizing": "border-box",
    })
    .val(cell.getValue());

  const buildValues = () =>
    start.val() === "" && end.val() === "" ? "" : `${start.val()}-${end.val()}`;

  // submit new value on enter
  inputs.on("keydown", (e) => {
    if (e.keyCode === 13) success(buildValues());
    if (e.keyCode === 27) cancel();
  });

  return container;
};
