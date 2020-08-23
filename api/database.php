<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

// update database properties.
$dbconn="";
$dbname="";

// provide database credentials
// if running in production server
// if ($_SERVER['SERVER_NAME']=='') {
// 	$servername = "";	
// 	$dbname = "";
// 	$username = "";
// 	$password = "";
// 	$port = "";
// 	$dbconn = @pg_connect("host=".$servername." port=".$port." dbname=".$dbname." user=".$username." password=".$password);
	
// } // if running in localhost
// 	else {
	
// 	$servername = "";
// 	$dbname = "";
// 	$username = "";
// 	$password = "";
// 	$port = "";	
// 	$dbconn = @pg_connect("host=".$servername." port=".$port." dbname=".$dbname." user=".$username." password=".$password);

// }


// Check connection
// if (!$dbconn) {
//     die('Connection to '.$dbname.' has failed: ');
// }


function getNumericColumns($schema, $isView, $dataSource, $dbconn) {
	// COLUMN_1, COLUMN_2
	$query = "";

	// If given datasource is view / query then get numeric columns from it otherwise get from datatable.
	// if ($isView) {

	// 	$query = "SELECT a.attname as NUMERIC_COL
	// 	FROM pg_attribute a
	// 	  JOIN pg_class t on a.attrelid = t.oid
	// 	  JOIN pg_namespace s on t.relnamespace = s.oid
	// 	WHERE a.attnum > 0 
	// 	  AND NOT a.attisdropped
	// 	  AND t.relname = "."'".$dataSource."'"." AND s.nspname = "."'".$schema."'"." 
	// 	  AND pg_catalog.format_type(a.atttypid, a.atttypmod) IN ('smallint', 'integer', 'bigint', 
	// 								'decimal', 'numeric', 'real', 'double precision')";

	// } else {

	// 	$query = "SELECT COL.COLUMN_NAME AS NUMERIC_COL
	// 	FROM INFORMATION_SCHEMA.COLUMNS COL
	// 	WHERE TABLE_SCHEMA = "."'".$schema."'"." AND  
	// 	TABLE_NAME = "."'".$dataSource."'"." AND COL.DATA_TYPE IN ('smallint', 'integer', 'bigint', 
	// 							'decimal', 'numeric', 'real', 'double precision')";
	// }
	
	// execute query
	// $queryResult = @pg_query($dbconn, $query);
	// $result = array();
	// if ($queryResult) {
	// 	$count=0;
	// 	while ($data = pg_fetch_object($queryResult)) {
	// 		$result[$count] = $data->numeric_col;
	// 		$count++;
	// 	}
	// } else {
	// 	throw new Exception('Failed to execute query related to numeric columns.');
	// }
	// returning mocked results.
	$result = array("COLUMN_1", "COLUMN_2", "COLUMN_3");
	return $result;
  }

  function getDropdownCols($dbconn, $table) {
	$dropdownCols = array();
	// get dropdown values based on given datatable.
	// if($table == "") {
	//   $dropdownCols = array("COLUMN_3"=>getAnalyteDataForFilter($dbconn,"COLUMN_3"), 
	// 						"COLUMN_4"=>getAnalyteDataForFilter($dbconn, "COLUMN_4"));
	// } else if ($table == "") {
	//   $dropdownCols = array("COLUMN_3"=>getAnalyteDataForFilter($dbconn,"COLUMN_3"));
	// }

	$dropdownCols = array("COLUMN_3"=>getAnalyteDataForFilter($dbconn,"COLUMN_3"), 
	"COLUMN_4"=>getAnalyteDataForFilter($dbconn, "COLUMN_4"));
	return $dropdownCols;
  }
  
  function getAnalyteDataForFilter($dbconn, $colName) {
	// update datasource from where data for given column will be fetched.
	$dataSource = "";
    $schema = "";
	$dataQuery = "";
	// execute query
    // $dataResult = @pg_query($dbconn, $dataQuery);
	// $dataList = array();
	// $dataList[0] = "";
    // $count=1;
    // while ($data = pg_fetch_object($dataResult)) {
    //     $dataList[$count] = $data->{$colName};
    //     $count++;
	// }
	// mocked data list
	$dataList = array("AB","CD","EF","GH","IJ","KL","MN","OP","QR","ST","UV","WX","YZ");
	return $dataList;
  }

?>