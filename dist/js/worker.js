pendingXmlHttpRequests = []

onmessage = function (e) {
    if (e.data[0] =="stop") {
        for (var key in pendingXmlHttpRequests) {
            pendingXmlHttpRequests[key].abort()
            delete pendingXmlHttpRequests[key]  
        }
    }
    else{
        var type = e.data[1]
        var name = e.data[2]
        var chunk = e.data[3]
        var fileLimit = e.data[4]
        var filters = e.data[5]
        var urlFilter = ""
        var downloadLimit = 100000
        if (filters.length > 0) {
            var index = 0
            filters.forEach((filter)=>{
                urlFilter+="&filters["+index+"][field]="+filter["field"]
                urlFilter+="&filters["+index+"][type]=like"
                urlFilter+="&filters["+index+"][value]="+filter["value"]
                index++
            })
        }
        var apiHost = "../../api"
        var totalDataReceived = 0
        var totalRecordsInDB = 0
        var progress_value = 0;
        var data = {}
        var CSV = '';
        var header = ''
        var sheetNo = 1
        var workerInst = this
        if (type != "" && name != "") {
            data["type"] = type
            data["name"] = name
            data["data"] = []
            var partitions = 1;
            sendRequest(0)
            function sendRequest(i) {
                var xmlhttp = new XMLHttpRequest();
                var requestId = i.toString()
                pendingXmlHttpRequests[requestId] = xmlhttp
                var queryUrl = apiHost + "/query_data.php?requestId="+requestId+"&request=data&dataSource=" + data["name"] + "&page=" + (i + 1) + "&size=" + chunk+urlFilter;
                var dataUrl = apiHost + "/table_data.php?requestId="+requestId+"&request=data&dataSource=" + data["name"] + "&page=" + (i + 1) + "&size=" + chunk+urlFilter;
                var res
                xmlhttp.onload = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        res = JSON.parse(this.responseText)
                        if (res["requestId"] in pendingXmlHttpRequests)
                            delete pendingXmlHttpRequests[res["requestId"]]
                        totalRecordsInDB = res["totalRecordsInDB"]
                        if (totalRecordsInDB < downloadLimit) {
                            partitions = Math.ceil(totalRecordsInDB / chunk)
                        } else {
                            partitions = Math.ceil(downloadLimit / chunk)
                        }
                        data["data"] = data["data"].concat(res["data"])
                        data["totalRecordsInDB"] = totalRecordsInDB
                        var prevTotalDataReceived = totalDataReceived
                        totalDataReceived += res["data"].length
                        if (prevTotalDataReceived == 0) {
                            var row = "";
                            //This loop will extract the label from 1st index of on array
                            for (var index in res["data"][0]) {
                                //Now convert each value to string and comma-seprated
                                row += index + ',';
                            }
                            row = row.slice(0, -1);
                            //append Label row with line break
                            CSV += row + '\r\n';
                            header = row + '\r\n'
                        }
                        //1st loop is to extract each row
                        for (var i = 0; i < res["data"].length; i++) {
                            var row = "";
                            //2nd loop will extract each column and convert it in string comma-seprated
                            for (var index in res["data"][i]) {
                                row += '"' + res["data"][i][index] + '",';
                            }
                            row.slice(0, row.length - 1);
                            //add a line break after each row
                            CSV += row + '\r\n';
                        }
    
                        progress_value = (totalDataReceived / totalRecordsInDB) * 100
                        // if data limit for one file is reached
                        // if (totalDataReceived > 0 && totalDataReceived < totalRecordsInDB 
                        //     && totalRecordsInDB > fileLimit && totalDataReceived % fileLimit == 0) {
                        //     workerInst.postMessage({ "type": "progress-data", "progress": progress_value, "data": CSV, "fileName": name + "-" + sheetNo })
                        //     sheetNo++
                        //     CSV = header
                        // } 
                        workerInst.postMessage({ "type": "progress", "progress": progress_value })
                        if (totalDataReceived >= totalRecordsInDB || totalDataReceived >= downloadLimit) {
                            var fileName = (sheetNo > 1) ? name + "-" + sheetNo : name
                            workerInst.postMessage({ "type": "data", "data": CSV, "fileName": fileName })
                        } else if (prevTotalDataReceived == 0) {
                            for (var k = 1; k < partitions; k++) {
                                sendRequest(k)
                            }
                        }
    
                    } else {
                        alert("Failed to receive data from the server.")
                    }
                };
                var url = (data["type"] == "query") ? queryUrl : dataUrl
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
            }
    
        } else {
            workerInst.postMessage({ "type": "data", "data": CSV })
        }
    }


    

}
