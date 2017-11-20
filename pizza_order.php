<?php
require_once("config.php");

$data = [];
$error = [];
$error_url = "?";

//postavljanje $_POST podataka u lokalnu promenljivu i cuvanje greski ako ima
foreach ($_POST as $key => $value){
    $data[$key] = ($key != "name") ? ((trim($value)!="default") ? trim($value) : "") : trim($value);

    if($key != "comment")
    $error[$key] = ($key != "name") ? (empty(trim($value)) || $value=="default") : (empty(trim($value)));
}

//ne check-iranje radio buttona dovodi do toga da se ne napravi $_POST tog elementa. Posebna provera za to
if(isset($_POST["payment"])){
    $error["payment"] = false;
}
else {
    $data["payment"] = "";
    $error["payment"] = true;
}

//manuelno generisanje $_GET promenljivih u URL-u na osnovu mogucih gresaka
foreach($error as $key => $value){
    $error_url .= ($value) ? $key."=bad&" : "";
}

//slanje nazad na pocetnu stranicu ako ima gresaka
if($error_url != "?"){
    header("location: pizza.php".$error_url);
}
//ako nema gresaka
else {

//brisanje kljucnih reci iz komentara pa brisanje viska razmaka
    if ($data["comment"] != "") {
        $data["comment"] = str_replace($words, "", $data["comment"]);
        $data["comment"] = preg_replace('/\s\s+/', ' ', $data["comment"]);
    }

    checkout($data);


}
//funkcija za racunanje i ispis narudzbe
function checkout($data){
    global $pizza;
    global $currency;

    $birthday = date_create($data["year"] . "-" . $data["month"] . "-" . $data["day"]);
    $today = date_create("today");
    $age = date_diff($birthday, $today)->y;
    $discount = 1;

    $discount -= ($age > 60) ? 0.03 : 0;
    $discount -= ($data["payment"]=="cash") ? 0.02 : 0;

    $price = $pizza[$data["pizza"]] * $data["amount"] * $discount;


    echo 'Name: ' . $data["name"] . "<br>";
    echo 'E-mail: ' . $data["email"] . "<br>";
    echo 'Birthday: ' . $data["day"] . "." . $data["month"] . "." . $data["year"] . "<br>";
    echo 'Age: ' . $age . "<br>";
    echo 'Order: ' . $data["amount"] . "x " . $data["pizza"] . "<br>";
    echo 'Payment: ' . $data["payment"] . "<br>";
    echo 'Comment: ' . $data["comment"] . "<br><br>";
    echo 'Price: ' . $price . " " . $currency;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
</body>
</html>