<?php
$s = "kill vts kill destroy vts drop subotica delete 024";

echo $s . "<br><br>";

$words = array("kill","destroy","drop","delete");
$message = explode(" ",$s);
$s = "";

foreach ($message as $key => $word) {
    $len = strlen($word);
    $s .= str_replace($words, substr($word, 0, 1) . str_repeat('*', $len - 2) . substr($word, $len - 1, 1), $word);
    $s .= ($key != count($message)-1) ? " " : "" ;
}

echo $s;
?>