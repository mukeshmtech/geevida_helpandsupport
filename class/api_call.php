<?php

require "UserClass.php";

// Get the HTTP method and request path
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$endpointURL = $_SERVER['REQUEST_URI'];
$endpointName = basename($endpointURL);

if($endpointName == "userLoginApi" && $method=="POST"){
    userLoginApi();
}
else if($endpointName == "statesListAPi" && $method=="GET"){
    statesListAPi();
}
else if($endpointName == "userRegisterApi" && $method=="POST"){
    userRegisterApi();
}
else
{
    http_response_code(404); // Not Found
    $response = [
        'error' => 'Method/Endpoint Invalid'
    ];
    echo json_encode($response);
}

function userLoginApi(){

    $jsonBody = file_get_contents('php://input');
    $decodeData=json_decode($jsonBody);

    if(!isset($decodeData->user_name) || empty($decodeData->user_name) || !isset($decodeData->password) || empty($decodeData->password)){

        $response = ['status' => false, 'data' => [], 'message' => 'Invalid data'];
        echo json_encode($response);
		exit;
    }

    $userClass = new UserClass();
    $result = $userClass->loginUser($decodeData->user_name,$decodeData->password);

    $responseMessage=$result?"Success":"Failer";
    $response = ['status' => true, 'data' => $result, 'message' => $responseMessage];
    echo json_encode($response);
    exit;
    
}

function statesListAPi(){

    $userClass = new UserClass();
    $result = $userClass->getStatesList();  
    $response = ['status' => true, 'data' => $result, 'message' => ''];
    echo json_encode($response);
    exit;
}

function userRegisterApi(){

    $jsonBody = file_get_contents('php://input');
    $decodeData=json_decode($jsonBody);
    
    if(!isset($decodeData->usermail) || empty($decodeData->usermail) || !isset($decodeData->password) || empty($decodeData->password)){

        $response = ['status' => false, 'data' => [], 'message' => 'Invalid data'];
        echo json_encode($response);
        exit;
    }

    $userClass = new UserClass();
    $result = $userClass->registerUser($decodeData->name,$decodeData->usermail,$decodeData->password,$decodeData->mobile,$decodeData->dob,$decodeData->gender,$decodeData->state,$decodeData->city);

    if($result==1)
    {
        $responseMessage="Register Success";
        $status=true;
    }
    else if($result==2)
    {
        $responseMessage="EmailId Already Exists";
        $status=true;
    }
    else if($result==0)
    {
        $responseMessage="Something wrong.Please try again!";
        $status=false;
    }

    $response = ['status' => $status, 'data' => $result, 'message' => $responseMessage];
    echo json_encode($response);
    exit;
}
?>