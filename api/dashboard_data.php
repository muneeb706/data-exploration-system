<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include 'database.php';

$request = $_GET["request"];
$requestId = (!isset($_GET['requestId']) && empty($_GET['requestId']))?"0":$_GET['requestId'];
if ($request == "count") {
  $dataSource = $_GET['dataSource'];
  // update schema name.
  $schema = "";
  // query to count number of items in given datasource / datatable.
  //  $countQuery = "";
  //  $filterCount = 0;
  // execute query.
  //   $countResult = @pg_query($dbconn, $countQuery);
  
  $json_response = "";
  // return result if query is executed otherwise, return error
  //   if (!$countResult) {
  //     $json_response = json_encode(array("requestId"=>$requestId, "error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
  //     @pg_close($dbconn);
  //     echo $json_response;
  //   } else {
  //       $count=0;
  //       $countData = pg_fetch_object($countResult);
  //       $totalRecordsInDB = $countData->count;
  //       $response = array("type"=>"count", "requestId"=>$requestId, "name"=>$dataSource, "totalRecordsInDB"=>$totalRecordsInDB, );
  //       $json_response = json_encode($response);
  //       @pg_close($dbconn);
  //       echo $json_response;
  //   }

  $response = array("type"=>"count", "requestId"=>$requestId, "name"=>$dataSource, "totalRecordsInDB"=>100000);
  $json_response = json_encode($response);
  echo $json_response;

} else if ($request == "element-list") {
    // update datasource name where elemnts are present.
    $dataSource = "";
    // $schema = "";
    // query to fetch elements from datasource / datatable.
    // $dataQuery = 'SELECT DISTINCT '.'"DESCRIPTION"'.' FROM '.$schema.'.'.'"'.$dataSource.'"'.' ORDER BY "DESCRIPTION" ASC';
    //execute query
    // $dataResult = @pg_query($dbconn, $dataQuery);
    $json_response = "";
    // return result if query is executed otherwise, return error
    // if (!$dataResult) {
    //     $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
    // } else {
    //       $dataList = array();
    //       $count=0;
    //       while ($data = pg_fetch_object($dataResult)) {
    //           $dataList[$count] = $data;
    //           $count++;
    //       }
    //       $response = array("type"=>"table", "requestId"=>$requestId, "name"=>$dataSource, "data"=>$dataList);
    //       $json_response = json_encode($response);
    //   }
    
    // closing database connection.
    // @pg_close($dbconn);
    $dataList = array(["DESCRIPTION" => "ABC 123"], ["DESCRIPTION" => "DEF 456"], ["DESCRIPTION" => "GHI 789"]);
    $response = array("type"=>"table", "requestId"=>$requestId, "name"=>$dataSource, "data"=>$dataList);
    $json_response = json_encode($response);
    echo $json_response;
 
  
} else if ($request == "timeline") {
 
    $yearTo = $_GET['yearTo'];
    $yearFrom = $_GET['yearFrom'];
    $elementCodeDescription = $_GET['elementCodeDescription'];
    // decoding 'PLUS-SIGN' to '+'
    $elementCodeDescription = str_replace("PLUS-SIGN", "+", $elementCodeDescription);
    // getting ANALYTE_CODE from description
    $elementCode;
    $dataSource = "ELEMENT_CODE";
    // $schema = "cheec";
    // executing query to fetch results
    // $dataQuery = "";
    // $dataResult = @pg_query($dbconn, $dataQuery);

    // if (!$dataResult) {
    //     $json_response = json_encode(array("requestId"=>$requestId,"error"=>"An error occurred, while fetching data from table ( ".$dataSource." ). " ));
    // } else {
    //     while ($data = pg_fetch_object($dataResult)) {
    //         $analyteCode = $data->ANALYTE_CODE;
    //         break;
    //     }
    // }
 
    $dataList = array("1990"=>"8","1991"=>"5","1992"=>"7","1993"=>"3","1994"=>"2","1995"=>"2","1996"=>"6","1997"=>"9","1998"=>"12","1999"=>"13","2000"=>"7");

    $response = array("type"=>"table", "requestId"=>$requestId, "name"=>$dataSource, "data"=>$dataList);
    $json_response = json_encode($response);

    echo $json_response;
 
    // close database connection
    //@pg_close($dbconn);
}


?>