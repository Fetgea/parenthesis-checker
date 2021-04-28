<?php

include(__DIR__ . "/functions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postBody = file_get_contents('php://input');
    try {
        if(checkParenthesis($postBody)) {
            echo "Ok";
        }
    } catch(Exception $e) {
        http_response_code(400);
        echo $e->getMessage();        
    }
} else {
    http_response_code(400);
    throw new Exception("Incorrect Method");
}
