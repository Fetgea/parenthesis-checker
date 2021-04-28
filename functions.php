<?
/**
 * Function check correctness of parenthesis string 
 *
 * @param $postBody Post body of http query
 * @return true Returns true if parenthesis string is correct
 */
function checkParenthesis($postBody) {
    $check = strlen($postBody);
    //Вполне возможно, что не нужно 
    if (!$_SERVER["CONTENT_LENGTH"] === strlen($postBody)) {
        http_response_code(400);
        throw new Exception("Content Length Mismatch");
    }
    parse_str($postBody, $postArray);

    if (!isset($postArray["string"])) {
        throw new Exception("Post Body String parameter not found");
    }
    
    $check = count_chars($postArray["string"], 1);

    if (!isset($check["40"]) || !isset($check["41"]) || $check["40"]!==$check["41"]) {
        http_response_code(400);
        throw new Exception("Parenthesis Check failed");
    }
    //$regexPattern = "/\(([^\(\)]*)\)/";
    $regexPattern = "/\(\)/";
    $return = $postArray["string"];
    do {
        $buffer = $return;
        $return = preg_replace($regexPattern, "", $buffer);
    } while ($buffer !== $return);
    $endRegex = "/\(|\)/";
    if (preg_match($endRegex, $return)) {
        http_response_code(400);
        throw new Exception("Parenthesis Check failed");
    }
    http_response_code(200);
    return true;
}