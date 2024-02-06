document.addEventListener("DOMContentLoaded", function () {
  $(".select2").select2();

  $("#year-range input").each(function () {
    $(this).datepicker({
      autoclose: true,
      format: " yyyy",
      viewMode: "years",
      minViewMode: "years",
    });
  });
});

function getLoadingIndicatorHtml() {
  var html =
    "" +
    '<div id="loading-indicator" class="overlay">' +
    '<i class="fas fa-5x fa-sync-alt fa-spin"></i>' +
    "</div>";
  return html;
}

var defaultElementCodeDescription = "Element1";
loadCounts();
loadElement();
loadChartData(true);

function loadCounts() {
  var tempLIDiv1 = document.createElement("div");
  tempLIDiv1.innerHTML = getLoadingIndicatorHtml();
  var entity1sCountBox = document.getElementById("entity1-count");
  entity1sCountBox.appendChild(tempLIDiv1.firstElementChild);
  var entity1sCountXmlhttp = new XMLHttpRequest();
  var entity1sCountUrl = "/entity_count?dataSource=ENTITY1";
  var entity1sCountres;
  entity1sCountXmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      entity1sCountres = JSON.parse(this.responseText);
      entity1sCountBox.querySelector("h3").innerHTML =
        entity1sCountres["totalRecordsInDB"];
      entity1sCountBox.removeChild(entity1sCountBox.lastChild);
    }
  };
  entity1sCountXmlhttp.open("GET", entity1sCountUrl, true);
  entity1sCountXmlhttp.send();

  var tempLIDiv2 = document.createElement("div");
  tempLIDiv2.innerHTML = getLoadingIndicatorHtml();
  var entity2sCountBox = document.getElementById("entity2-count");
  entity2sCountBox.appendChild(tempLIDiv2.firstElementChild);

  var entity2sCountXmlhttp = new XMLHttpRequest();
  var entity2sCountUrl = "/entity_count?dataSource=ENTITY2";
  var entity2sCountres;
  entity2sCountXmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      entity2sCountres = JSON.parse(this.responseText);
      entity2sCountBox.querySelector("h3").innerHTML =
        entity2sCountres["totalRecordsInDB"];
      entity2sCountBox.removeChild(entity2sCountBox.lastChild);
    } else {
      alert("Failed to get Entity 2 count from server.");
    }
  };
  entity2sCountXmlhttp.open("GET", entity2sCountUrl, true);
  entity2sCountXmlhttp.send();

  var tempLIDiv3 = document.createElement("div");
  tempLIDiv3.innerHTML = getLoadingIndicatorHtml();
  var entity3CountBox = document.getElementById("entity3-count");
  entity3CountBox.appendChild(tempLIDiv3.firstElementChild);
  var entity3CountXmlhttp = new XMLHttpRequest();
  var entity3CountUrl = "/entity_count?dataSource=ENTITY3";
  var entity3Countres;
  entity3CountXmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      entity3Countres = JSON.parse(this.responseText);
      entity3CountBox.querySelector("h3").innerHTML =
        entity3Countres["totalRecordsInDB"];
      entity3CountBox.removeChild(entity3CountBox.lastChild);
    } else {
      alert("Failed to get Entity 3 count from server.");
    }
  };
  entity3CountXmlhttp.open("GET", entity3CountUrl, true);
  entity3CountXmlhttp.send();

  var tempLIDiv4 = document.createElement("div");
  tempLIDiv4.innerHTML = getLoadingIndicatorHtml();
  var entity4CountBox = document.getElementById("entity4-count");
  entity4CountBox.appendChild(tempLIDiv4.firstElementChild);
  var entity4CountXmlhttp = new XMLHttpRequest();
  var entity4CountUrl = "/entity_count?dataSource=ENTITY4";
  var entity4Countres;
  entity4CountXmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      entity4Countres = JSON.parse(this.responseText);
      entity4CountBox.querySelector("h3").innerHTML =
        entity4Countres["totalRecordsInDB"];
      entity4CountBox.removeChild(entity4CountBox.lastChild);
    } else {
      alert("Failed to get Entity 4 count from server.");
    }
  };
  entity4CountXmlhttp.open("GET", entity4CountUrl, true);
  entity4CountXmlhttp.send();
}

function loadElement() {
  var elementSelect = document.getElementById("element-select");
  var xmlhttp = new XMLHttpRequest();
  var url = "/element_list";
  var res;
  xmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      res = JSON.parse(this.responseText);
      elementSelect.innerHTML =
        '<option value="" disabled>Select Element</option>';
      let index = 1;
      elementSelect.selectedIndex = 0;
      res["data"].forEach((element) => {
        var option = document.createElement("option");
        option.setAttribute("value", element["DESCRIPTION"]);
        var optionText = document.createTextNode(element["DESCRIPTION"]);
        option.appendChild(optionText);
        if (element["DESCRIPTION"] == defaultElementCodeDescription) {
          option.setAttribute("selected", "selected");
          elementSelect.selectedIndex = index;
        }
        elementSelect.appendChild(option);
        index++;
      });
    } else {
      alert("Failed to get element list from server.");
    }
  };
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

//-----------------------
//- CHART -
//-----------------------

// Get context with jQuery - using jQuery's .get() method.
var entity5ChartCanvas = $("#entity5Chart").get(0).getContext("2d");

var entity5ChartData = {
  labels: [],
  datasets: [
    {
      label: "Digital Goods",
      backgroundColor: "rgba(60,141,188,0.9)",
      borderColor: "rgba(60,141,188,0.8)",
      pointRadius: false,
      pointColor: "#3b8bba",
      pointStrokeColor: "rgba(60,141,188,1)",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(60,141,188,1)",
      data: [28, 48, 40, 19, 86, 27, 90],
    },
  ],
};

var entity5ChartOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: {
    display: false,
  },
  scales: {
    xAxes: [
      {
        gridLines: {
          display: false,
        },
        scaleLabel: {
          display: true,
          labelString: "Year",
        },
      },
    ],
    yAxes: [
      {
        gridLines: {
          display: false,
        },
        scaleLabel: {
          display: true,
          labelString: "Percentage %",
        },
      },
    ],
  },
};

// This will get the first returned node in the jQuery collection.
var entity5Chart = new Chart(entity5ChartCanvas, {
  type: "line",
  data: entity5ChartData,
  options: entity5ChartOptions,
});

function loadChartData(init = false) {
  var tempLIDiv1 = document.createElement("div");
  tempLIDiv1.innerHTML = getLoadingIndicatorHtml();
  var entity5Viz = document.getElementById("entity5Viz");
  entity5Viz.appendChild(tempLIDiv1.firstElementChild);
  var elementSelect = document.getElementById("element-select");
  var elementValue = init
    ? defaultElementCodeDescription
    : elementSelect.options[elementSelect.selectedIndex].value;
  // encoding plus '+' symbol as it is treated as space in url
  elementValue = elementValue.replace(/\+/g, "PLUS-SIGN");
  var yearFromValue = document.getElementById("year-from").value.trim();
  var yearToValue = document.getElementById("year-to").value.trim();
  var xmlhttp = new XMLHttpRequest();
  var url =
    "/element_timeline_data?elementCode=" +
    elementValue +
    "&yearFrom=" +
    yearFromValue +
    "&yearTo=" +
    yearToValue;
  var res;
  xmlhttp.onload = function () {
    if (this.readyState == 4 && this.status == 200) {
      res = JSON.parse(this.responseText);
      let labels = [];
      let data = [];
      Object.keys(res["data"]).forEach((year) => {
        labels.push(year);
        data.push(res["data"][year]);
      });
      entity5ChartData["labels"] = labels;
      entity5ChartData["datasets"][0]["data"] = data;
      entity5Chart["data"] = entity5ChartData;
      entity5Chart.update();
    } else {
      alert("Failed to get chart data for given element from server.");
    }
    entity5Viz.removeChild(entity5Viz.lastChild);
  };
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

//---------------------------
//- END CHART -
//---------------------------
