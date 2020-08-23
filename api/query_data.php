<?php

include 'database.php';

$request = $_GET["request"];
$requestId = (!isset($_GET['requestId']) && empty($_GET['requestId']))?"0":$_GET['requestId'];
if ($request == "list") {
    $query_list = array("QUERY1", "QUERY2", "QUERY3");
    echo json_encode($query_list);
} else if ($request == "data") {

    $dataSource = $_GET['dataSource'];
    $pageNo = (!isset($_GET['page']) && empty($_GET['page']))?1:$_GET['page'];
    $responseSize = (!isset($_GET['size']) && empty($_GET['size']))?100:$_GET['size'];
    $offset = ($pageNo - 1) * $responseSize;
    $totalPages = ceil($responseSize/$responseSize);

    $filters = (isset($_GET["filters"]))?$_GET["filters"]:array();

    $schema = "";

    try {
      
      if ($dataSource=="QUERY1") {

        // update view name / query name
        $viewName = "";
        $numericCols = getNumericColumns($schema, True, $viewName, $dbconn);
  
        // $countQuery = '';
        // $filterCount = 0;
        // while ($filterCount < sizeof($filters)) {
        //   if ($filterCount == 0) {
        //     $countQuery = $countQuery.appendWhereQuery($filters[$filterCount]["field"], $filters[$filterCount]["value"], $numericCols, $dropdownCols);
        //   } else {
        //     $countQuery = $countQuery.appendAndQuery($filters[$filterCount]["field"], $filters[$filterCount]["value"], $numericCols, $dropdownCols);   
        //   }
        //   $filterCount++;
        // }
        
        // $countResult = @pg_query($dbconn, $countQuery);
        // $json_response = "";
        // if (!$countResult) {
        //   $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from query ( ".$dataSource." ). " ));
        //   @pg_close($dbconn);
        //   echo $json_response;
        // } else {
        //     $count=0;
        //     $countData = pg_fetch_object($countResult);
        //     $totalRecordsInDB = $countData->count;
        //     if ($totalRecordsInDB > 0) {
        //       $totalPages = ceil($totalRecordsInDB/$responseSize);
        // }
        

          // $dataQuery = "";
          
          // $filterCount = 0;
          
          // while ($filterCount < sizeof($filters)) {
          //   if ($filterCount == 0) {
          //     $dataQuery = $dataQuery.appendWhereQuery($filters[$filterCount]["field"], $filters[$filterCount]["value"], $numericCols, $dropdownCols);
          //   } else {
          //     $dataQuery = $dataQuery.appendAndQuery($filters[$filterCount]["field"], $filters[$filterCount]["value"], $numericCols, $dropdownCols);   
          //   }
          //   $filterCount++;
          // }

          // $dataQuery = $dataQuery." LIMIT ".$responseSize." OFFSET ".$offset;
          // $dataResult = @pg_query($dbconn, $dataQuery);

          // $json_response = "";
          // if (!$dataResult) {
          //   $json_response = json_encode(array("error"=>"An error occurred, while fetching data from query ( ".$dataSource." ). " ));
          // } else {
          //     $dataList = array();
          //     $count=0;
          //     while ($data = pg_fetch_object($dataResult)) {
          //         $dataList[$count] = $data;
          //         $count++;
          //     }
          //     $response = array("type"=>"query","requestId"=>$requestId, "last_page"=>$totalPages, "name"=>$dataSource, "totalRecordsInDB"=>$totalRecordsInDB,
          //                       "data"=>$dataList, "numericCols" => $numericCols, 
          //                       "dropdownCols"=>$dropdownCols);

          //     $json_response = json_encode($response);
          // }
          // @pg_close($dbconn);
        
        $totalRecordsInDB = 10000;
     
        if ($totalRecordsInDB > 0) {
          $totalPages = ceil($totalRecordsInDB/$responseSize);
        }

        // generating mocked data
        $dataList = array();
        $index = 0;
        while($index < $responseSize) {
          $dataList[$index] = array(
            "COLUMN_1"=>"12345",
            "COLUMN_2"=>"12345",
            "COLUMN_3"=>"12345",
            "COLUMN_4"=>"AB",
            "COLUMN_5"=>"YZ",
            "COLUMN_6"=>"ABCDEF",
            "COLUMN_7"=>"ABCDEF",
            "COLUMN_8"=>"ABCDEF",
            "COLUMN_9"=>"ABCDEF",
            "COLUMN_10"=>"ABCDEF",
            "COLUMN_11"=>"ABCDEF",
            "COLUMN_12"=>"ABCDEF",
            "COLUMN_13"=>"ABCDEF",
            "COLUMN_14"=>"UVWXYZ",
            "COLUMN_15"=>"ABCDEF"
          );
          $index++;
        }

        $response = array("type"=>"query", "requestId"=>$requestId,"last_page"=>$totalPages, "name"=>$dataSource, 
        "totalRecordsInDB"=>$totalRecordsInDB, "data"=>$dataList, "numericCols" => $numericCols,
        "dropdownCols" => getDropdownCols($dbconn, $dataSource));
        $json_response = json_encode($response);
        echo $json_response;

      } else if ($dataSource=="QUERY2") {

        
        // update view name / query name
        $viewName = "";
        $numericCols = getNumericColumns($schema, True, $viewName, $dbconn);
  
        $totalRecordsInDB = 10000;
     
        if ($totalRecordsInDB > 0) {
          $totalPages = ceil($totalRecordsInDB/$responseSize);
        }

        // generating mocked data
        $dataList = array();
        $index = 0;
        while($index < $responseSize) {
          $dataList[$index] = array(
            "COLUMN_1"=>"12345",
            "COLUMN_2"=>"12345",
            "COLUMN_3"=>"12345",
            "COLUMN_4"=>"AB",
            "COLUMN_5"=>"YZ",
            "COLUMN_6"=>"ABCDEF",
            "COLUMN_7"=>"ABCDEF",
            "COLUMN_8"=>"ABCDEF",
            "COLUMN_9"=>"ABCDEF",
            "COLUMN_10"=>"ABCDEF",
            "COLUMN_11"=>"ABCDEF",
            "COLUMN_12"=>"ABCDEF",
            "COLUMN_13"=>"ABCDEF",
            "COLUMN_14"=>"UVWXYZ",
            "COLUMN_15"=>"ABCDEF"
          );
          $index++;
        }

        $response = array("type"=>"query", "requestId"=>$requestId,"last_page"=>$totalPages, "name"=>$dataSource, 
        "totalRecordsInDB"=>$totalRecordsInDB, "data"=>$dataList, "numericCols" => $numericCols,
        "dropdownCols" => getDropdownCols($dbconn, $dataSource));
        $json_response = json_encode($response);
        echo $json_response;
          
      } else if ($dataSource=="QUERY3") {

          // update view name / query name
          $viewName = "";
          $numericCols = getNumericColumns($schema, True, $viewName, $dbconn);
  
          $totalRecordsInDB = 10000;
     
          if ($totalRecordsInDB > 0) {
            $totalPages = ceil($totalRecordsInDB/$responseSize);
          }

          // generating mocked data
          $dataList = array();
          $index = 0;
          while($index < $responseSize) {
            $dataList[$index] = array(
                    "COLUMN_1"=>"12345",
                    "COLUMN_2"=>"12345",
                    "COLUMN_3"=>"12345",
                    "COLUMN_4"=>"AB",
                    "COLUMN_5"=>"YZ",
                    "COLUMN_6"=>"ABCDEF",
                    "COLUMN_7"=>"ABCDEF",
                    "COLUMN_8"=>"ABCDEF",
                    "COLUMN_9"=>"ABCDEF",
                    "COLUMN_10"=>"ABCDEF",
                    "COLUMN_11"=>"ABCDEF",
                    "COLUMN_12"=>"ABCDEF",
                    "COLUMN_13"=>"ABCDEF",
                    "COLUMN_14"=>"UVWXYZ",
                    "COLUMN_15"=>"ABCDEF"
                  );
            $index++;
          }
        
          $response = array("type"=>"query", "requestId"=>$requestId,"last_page"=>$totalPages, "name"=>$dataSource, 
                "totalRecordsInDB"=>$totalRecordsInDB, "data"=>$dataList, "numericCols" => $numericCols,
                "dropdownCols" => getDropdownCols($dbconn, $dataSource));
          $json_response = json_encode($response);
          echo $json_response;
        
        }
    } catch (Exception $e) {
        $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
        @pg_close($dbconn);
        echo $json_response;
    }
  }

  // function appendWhereQuery($fieldName, $fieldValue, $numericCols, $dropdownCols) {
  //   $query = "";

  //   if ($fieldValue == "NULL") {
  //     $query = " WHERE CAST(".'"'.$fieldName.'"'." AS TEXT) "
  //     ."IS NULL ";

  //   } else if (in_array($fieldName, $numericCols)) {
  //       $range = explode("-", $fieldValue);
  //       $min = $range[0];
  //       $max = $range[1];
  //       if ($min != "" && $max != "") {
  //         $query = " WHERE ".'"'.$fieldName.'"'." >= "
  //         .(float)$min." AND ".'"'.$fieldName.'"'." <= ".(float)$max;
  //       } else if ($min != "" && $max == "") {
  //         $query = " WHERE ".'"'.$fieldName.'"'." >= "
  //         .(float)$min;
  //       } else if ($min == "" && $max != "") {
  //         $query = " WHERE ".'"'.$fieldName.'"'." <= "
  //         .(float)$max;
  //       }

  //   } else if (in_array($fieldName, $dropdownCols)) {
  //     $query = " WHERE LOWER(CAST(".'"'.$fieldName.'"'." AS TEXT)) "
  //                         ."= "."'".strtolower($fieldValue)."'";
  //   } else {
  //     $query = " WHERE LOWER(CAST(".'"'.$fieldName.'"'." AS TEXT)) "
  //                         ."LIKE "."'%".strtolower($fieldValue)."%'";
  //   }

  //   return $query;
  // }

  // function appendAndQuery($fieldName, $fieldValue, $numericCols, $dropdownCols) {
  //   $query = "";
  //   if ($fieldValue == "NULL") {
  //     $query = " AND CAST(".'"'.$fieldName.'"'." AS TEXT) "
  //     ."IS NULL  ";

  //   } else if (in_array($fieldName, $numericCols)) {
  //       $range = explode("-", $fieldValue);
  //       $min = $range[0];
  //       $max = $range[1];
  //       if ($min != "" && $max != "") {
  //         $query = " AND ".'"'.$fieldName.'"'." >= "
  //         .(float)$min." AND ".'"'.$fieldName.'"'." <= ".(float)$max;
  //       } else if ($min != "" && $max == "") {
  //         $query = " AND ".'"'.$fieldName.'"'." >= "
  //         .(float)$min;
  //       } else if ($min == "" && $max != "") {
  //         $query = " AND ".'"'.$fieldName.'"'." <= "
  //         .(float)$max;
  //       }

  //   } else if (in_array($fieldName, $dropdownCols)) {
  //     $query = " AND LOWER(CAST(".'"'.$fieldName.'"'." AS TEXT)) "
  //                         ."= "."'".strtolower($fieldValue)."'";
  //   } else {
  //     $query = " AND LOWER(CAST(".'"'.$fieldName.'"'." AS TEXT)) "
  //                         ."LIKE "."'%".strtolower($fieldValue)."%'";
  //   }

  //   return $query;
  // }
?>