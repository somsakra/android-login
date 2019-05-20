<?php

require_once '../includes/DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(
        isset($_POST['username']) and 
            isset($_POST['email']) and
                isset($_POST['password']))
        {
        //poerate the data further
        $db = new DbOperations();

        $result = $db->createUser(   $_POST['username'],
                                    $_POST['password'],
                                    $_POST['email']);

        if($result == 1){
            $response['error'] = false;
            $response['message'] = 'User registered successfully';
        }elseif($result == 2){
            $response['error'] = true;
            $response['message'] = 'Some error occurred';
        }elseif($result == 0){
            $response['error'] = true;
            $response['message'] = 'You are already registered';
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }

}else{
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}

echo json_encode($response);