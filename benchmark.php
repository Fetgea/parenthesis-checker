<?php
include __DIR__ . "/functions.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postBody = file_get_contents('php://input');
    try {
        if (checkParenthesis($postBody)) {
            $time1 = -microtime(true);

            for ($i = 0; $i < 100000; $i++) {
                checkParenthesis($postBody);
            }
            
            $time1 += microtime(true);
            
            
            $time2 = -microtime(true);
            
            for ($i = 0; $i < 100000; $i++) {
                checkParenthesis($postBody, 1);
            }
            
            $time2 += microtime(true);
            
            echo "Option 0: Time: " . $time1 . "\n";
            
            echo "Option 1: Time: " . $time2;
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo $e->getMessage();
    }
} else {
    http_response_code(400);
    throw new Exception("Incorrect Method");
}


/*
Benchmark results:
Option 0 - regex
Option 1 - string to array
100000 
string=((((()))))
Option 0: Time: 0.34913015365601
Option 1: Time: 0.26434683799744

string=()((((()))(()((((()()((()((()()(((()))))))))))))))
Option 0: Time: 0.83873081207275
Option 1: Time: 0.6825749874115

string=()((((()))(()((((()()((()((()()((((((((()))(()((((()()((()((()()(((())))))))))))))))))))))))))))))()
Option 0: Time: 1.6650459766388
Option 1: Time: 1.1795411109924

string=()((((()))(()((((()()((()((()()(((()))))))))))))))()((((()))(()((((()()((()((()()(((()))))))))))))))
Option 0: Time: 1.1582119464874
Option 1: Time: 1.1937530040741
*/