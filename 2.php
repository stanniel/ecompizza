<?php
$s = "kill vts kill destroy vts drop subotica delete 024";
$search = explode(" ",$s);
$search = array_unique($search);

echo $s."<br><br>";
foreach ($search as $word){
    echo $word.": ".substr_count($s, $word)."<br>";
}
?>