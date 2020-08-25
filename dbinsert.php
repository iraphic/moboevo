<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['temp']) && isset($_GET['hum'])) 
{
    $Sensor1 = $_GET['temp'];
    $Sensor2 = $_GET['hum'];
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/dbconnect.php");

 
    // Connecting to database 
    $db = new DB_CONNECT();
    
    date_default_timezone_set('Asia/Bangkok');
     $dateS = date('Y-m-d', time());
    echo $dateS;
    // Fire SQL query to insert data in weather 
    //INSERT INTO `testingDB` (`No`, `Sensor1`, `Sensor2`) VALUES ('1', '1', '1');
    $result = mysql_query("INSERT INTO cobacoba1 (id,date,temperature,humidity) VALUES(Null,'$dateS','$Sensor1','$Sensor2')");
 
    // Check for succesfull execution of query
    if ($result) 
    {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Data successfully inserted.";
        // Show JSON response
        echo json_encode($response);
        } 
    else 
    {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
        // Show JSON response
        echo json_encode($response);
    }
} 
else 
{
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
    // Show JSON response
    echo json_encode($response);
}

?>