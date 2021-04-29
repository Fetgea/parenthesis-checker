<?
/**
 * Function checks correctness of parenthesis string 
 *
 * @param $postBody Post body of http query
 * @param int $option parameter let you choose method of string checking 
 *                    0 - using regex and preg_match; 1 - simple string to array traversing
 * @return true Returns true if parenthesis string is correct
 * @throws Exception in case of errors
 */
function checkParenthesis($postBody, $option = 0) 
{
    $check = strlen($postBody);
    //Вполне возможно, что не нужно 
    if ($_SERVER["CONTENT_LENGTH"] == 0) {
        throw new Exception("Empty Post Body");
    }
    parse_str($postBody, $postArray);

    if (empty($postArray["string"])) {
        throw new Exception("Post Body parameter String not found or Empty");
    }
    $stringLength = strlen($postArray["string"]);
    if ($_SERVER["CONTENT_LENGTH"] != ($stringLength + 7)) {
        throw new Exception("Content Length Mismatch");
    }
    $check = count_chars($postArray["string"], 1);

    if (!isset($check["40"]) || !isset($check["41"]) || $check["40"] !== $check["41"]) {
        throw new Exception("Parenthesis Check failed");
    }
    // pattern for strings with symbols other than parenthesis $regexPattern = "/\(([^\(\)]*)\)/";
    if ($option === 0) {
        $regexPattern = "/\(\)/";
        $return = $postArray["string"];
        do {
            $buffer = $return;
            $return = preg_replace($regexPattern, "", $buffer);
        } while ($buffer !== $return);
        $endRegex = "/\(|\)/";
        if (preg_match($endRegex, $return) || !empty($return)) {
            throw new Exception("Parenthesis Check failed");
        }
        return true;
    } elseif ($option === 1) {
        $stringArray = str_split($postArray["string"]);
        $parenthesisCounter = 0;
        foreach ($stringArray as $char) {
            if ($char === "(") {
                $parenthesisCounter += 1;
            } elseif ($char === ")") {
                $parenthesisCounter -= 1;
            } else {
                throw new Exception("Parenthesis Check failed");
            }
            if ($parenthesisCounter < 0) {
                throw new Exception("Parenthesis Check failed");
            }
        }

        if ($parenthesisCounter > 0) {
            throw new Exception("Parenthesis Check failed");
        }
        return true;
    }
}