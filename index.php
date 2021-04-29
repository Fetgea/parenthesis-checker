<?php

include __DIR__ . "/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postBody = file_get_contents('php://input');
    try {
        if (checkParenthesis($postBody, 1)) {
            http_response_code(200);
            echo "Ok";
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo $e->getMessage();
    }
} else {
    http_response_code(400);
    throw new Exception("Incorrect Method");
}
