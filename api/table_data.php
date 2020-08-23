<?php

include 'database.php';

$request = $_GET["request"];
$requestId = (!isset($_GET['requestId']) && empty($_GET['requestId']))?"0":$_GET['requestId'];
if ($request == "list") {
  // Execute query to get list of datatables in the database.

  // $result = @pg_query($dbconn, "");
  $json_response = "";
  // if (!$result) {
  //   $json_response = json_encode(array("requestId"=>$requestId, "error"=>"An error occurred, while fetching list of tables."));
  // } else {
  //     $tables = array();
  //     $count=0;
  //     while ($row = pg_fetch_row($result)) {
  //         $tables[$count] = $row[0];
  //         $count++;
  //     }
  //     $json_response = json_encode($tables);
  // }

  // close db connection.
  //@pg_close($dbconn);
  $tables = array("ENTITY1", "ENTITY2", "ENTITY3","ENTITY4", "ENTITY5");
  $json_response = json_encode($tables);
  echo $json_response;

} else if ($request == "data") {
  $dataSource = $_GET['dataSource'];
  $pageNo = (!isset($_GET['page']) && empty($_GET['page']))?1:$_GET['page'];
  $responseSize = (!isset($_GET['size']) && empty($_GET['size']))?100:$_GET['size'];
  $offset = ($pageNo - 1) * $responseSize;
  $totalPages = ceil($responseSize/$responseSize);
  
  //check for parameters and return appropriate error message

  $filters = (isset($_GET["filters"]))?$_GET["filters"]:array();

  // update schema.
  $schema = "";

  $json_response = "";
   
  // try {
    
    // get numeric columns function is in database.php
    $numericCols = getNumericColumns($schema, False, $dataSource, $dbconn);
    
    $countQuery = "";
    
    $filterCount = 0;
    // getting total number of records for given filter
    // while ($filterCount < sizeof($filters)) {
    //   if ($filterCount == 0) {
    //     if ($filters[$filterCount]["value"] == "NULL") {
    //         $countQuery = $countQuery." WHERE CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT) "
    //         ."IS NULL";  
    //     } else if (in_array($filters[$filterCount]["field"], $numericCols)) {
    //         $range = explode("-", $filters[$filterCount]["value"]);
    //         $min = $range[0];
    //         $max = $range[1];
    //         if ($min != "" && $max != "") {
    //           $countQuery = $countQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." >= "
    //           .(float)$min." AND ".'"'.$filters[$filterCount]["field"].'"'." <= ".(float)$max;
    //         } else if ($min != "" && $max == "") {
    //           $countQuery = $countQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." >= "
    //           .(float)$min;
    //         } else if ($min == "" && $max != "") {
    //           $countQuery = $countQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." <= "
    //           .(float)$max;
    //         }

    //     } else if (in_array($filters[$filterCount]["field"], $dropdownCols)) {
    //         $countQuery = $countQuery." WHERE LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
    //         ."= "."'".strtolower($filters[$filterCount]["value"])."'";
    //     } else {
    //       $countQuery = $countQuery." WHERE LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
    //                               ."LIKE "."'%".strtolower($filters[$filterCount]["value"])."%'";
    //     }
    //   } else {
        
    //       if ($filters[$filterCount]["value"] == "NULL") {
    //         $countQuery = $countQuery." AND CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT) "
    //                             ."IS NULL";  

    //       } else if (in_array($filters[$filterCount]["field"], $numericCols)) {
    //         $range = explode("-", $filters[$filterCount]["value"]);
    //         $min = $range[0];
    //         $max = $range[1];
    //         if ($min != "" && $max != "") {
    //           $countQuery = $countQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." >= "
    //           .(float)$min." AND ".'"'.$filters[$filterCount]["field"].'"'." <= ".(float)$max;
    //         } else if ($min != "" && $max == "") {
    //           $countQuery = $countQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." >= "
    //           .(float)$min;
    //         } else if ($min == "" && $max != "") {
    //           $countQuery = $countQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." <= "
    //           .(float)$max;
    //         }
    //       } else if (in_array($filters[$filterCount]["field"], $dropdownCols)) {
    //         $countQuery = $countQuery." AND LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
    //         ." = "."'".strtolower($filters[$filterCount]["value"])."'";
    //       } else {
    //         $countQuery = $countQuery." AND LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
    //                             ."LIKE "."'%".strtolower($filters[$filterCount]["value"])."%'";
    //       }
    //   }
    //   $filterCount++;
    // }

    // execute query
    // $countResult = @pg_query($dbconn, $countQuery);
   
    // if (!$countResult) {
    //   $json_response = json_encode(array("requestId"=>$requestId, "error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
    //   @pg_close($dbconn);
    //   echo $json_response;
    // } else {
        // getting data
        // $count=0;
        // $countData = pg_fetch_object($countResult);
        // $totalRecordsInDB = $countData->count;
        // if ($totalRecordsInDB > 0) {
        //   $totalPages = ceil($totalRecordsInDB/$responseSize);
        // }
        // $dataQuery = "";
        // $filterCount = 0;
        // while ($filterCount < sizeof($filters)) {
        //   if ($filterCount == 0) {
        //     if ($filters[$filterCount]["value"] == "NULL") {
        //       $dataQuery = $dataQuery." WHERE CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT) "
        //       ."IS NULL ";
        //     } else if (in_array($filters[$filterCount]["field"], $numericCols)) {
        //       $range = explode("-", $filters[$filterCount]["value"]);
        //       $min = $range[0];
        //       $max = $range[1];
        //       if ($min != "" && $max != "") {
        //         $dataQuery = $dataQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." >= "
        //         .(float)$min." AND ".'"'.$filters[$filterCount]["field"].'"'." <= ".(float)$max;
        //       } else if ($min != "" && $max == "") {
        //         $dataQuery = $dataQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." >= "
        //         .(float)$min;
        //       } else if ($min == "" && $max != "") {
        //         $dataQuery = $dataQuery." WHERE ".'"'.$filters[$filterCount]["field"].'"'." <= "
        //         .(float)$max;
        //       }
  
        //   } else if (in_array($filters[$filterCount]["field"], $dropdownCols)) {
        //     $dataQuery = $dataQuery." WHERE LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
        //                       ." = "."'".strtolower($filters[$filterCount]["value"])."'";
        //   }   else {
        //     $dataQuery = $dataQuery." WHERE LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
        //                           ."LIKE "."'%".strtolower($filters[$filterCount]["value"])."%'";
        //     }
        //   } else {
        //       if ($filters[$filterCount]["value"] == "NULL") {
        //         $dataQuery = $dataQuery." AND CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT) "
        //         ."IS NULL  ";
        //       } else if (in_array($filters[$filterCount]["field"], $numericCols)) {
        //         $range = explode("-", $filters[$filterCount]["value"]);
        //         $min = $range[0];
        //         $max = $range[1];
        //         if ($min != "" && $max != "") {
        //           $dataQuery = $dataQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." >= "
        //           .(float)$min." AND ".'"'.$filters[$filterCount]["field"].'"'." <= ".(float)$max;
        //         } else if ($min != "" && $max == "") {
        //           $dataQuery = $dataQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." >= "
        //           .(float)$min;
        //         } else if ($min == "" && $max != "") {
        //           $dataQuery = $dataQuery." AND ".'"'.$filters[$filterCount]["field"].'"'." <= "
        //           .(float)$max;
        //         }
        //       } else if (in_array($filters[$filterCount]["field"], $dropdownCols)) {
        //           $dataQuery = $dataQuery." AND LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
        //                             ." = "."'".strtolower($filters[$filterCount]["value"])."'";
        //       } else {
        //         $dataQuery = $dataQuery." AND LOWER(CAST(".'"'.$filters[$filterCount]["field"].'"'." AS TEXT)) "
        //                             ."LIKE "."'%".strtolower($filters[$filterCount]["value"])."%'";
        //       }
        //   }
        //   $filterCount++;
        // }

        // $dataQuery = $dataQuery." LIMIT ".$responseSize." OFFSET ".$offset;
        
        // $dataResult = @pg_query($dbconn, $dataQuery);

        // $json_response = "";
        // if (!$dataResult) {
        //   $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
        // } else {
        //     $dataList = array();
        //     $count=0;
        //     while ($data = pg_fetch_object($dataResult)) {
        //         $dataList[$count] = $data;
        //         $count++;
        //     }
            
        //     $response = array("type"=>"table", "requestId"=>$requestId,"last_page"=>$totalPages, "name"=>$dataSource, 
        //                       "totalRecordsInDB"=>$totalRecordsInDB, "data"=>$dataList, "numericCols" => $numericCols,
        //                     "dropdownCols" => getDropdownCols($dbconn, $dataSource));
        //     $json_response = json_encode($response);
        // }
        // @pg_close($dbconn);
        // echo $json_response;

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

        $response = array("type"=>"table", "requestId"=>$requestId,"last_page"=>$totalPages, "name"=>$dataSource, 
        "totalRecordsInDB"=>$totalRecordsInDB, "data"=>$dataList, "numericCols" => $numericCols,
        "dropdownCols" => getDropdownCols($dbconn, $dataSource));
        $json_response = json_encode($response);
        echo $json_response;
    }
  // } catch (Exception $e) {
  //   $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
  //   // @pg_close($dbconn);
  //   echo $json_response;
  // }

// }

?>