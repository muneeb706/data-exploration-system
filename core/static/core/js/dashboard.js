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
              dataSourceTypeSelector.options[
                  dataSourceTypeSelector.selectedIndex
              ].value;
          var name =
              dataSourceNameSelector.options[
                  dataSourceNameSelector.selectedIndex
              ].value;
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
                                  data["type"] == res["type"] &&
                                  data["name"] == res["name"]
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
                                  data["type"] == res["type"] &&
                                  data["name"] == res["name"]
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
