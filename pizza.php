<?php
function simpleSelect($start_value, $end_value){

    echo '<option value="default">- choose -</option>';
    if($start_value < $end_value) {
        for (; $start_value < $end_value+1; $start_value++) {
            echo '<option value="' . $start_value . '">' . $start_value . '</option>';
        }
    }
    else {
        for (; $start_value > $end_value-1; $start_value--) {
            echo '<option value="' . $start_value . '">' . $start_value . '</option>';
        }
    }
}


require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizza order</title>
</head>
<body>
<form action="pizza_order.php" method="post">
    <fieldset>
        <legend>Pizza order</legend>
        <b>name:</b> <input type="text" name="name" id="name"> *   <?php echo (isset($_GET["name"]) && $_GET["name"]=="bad") ? '<span style="color:#f00;">Ovo polje je obavezno.</span>' : '';?><br><br>
        <b>e-mail:</b> <input type="text" name="email" id="email"> *   <?php echo (isset($_GET["email"]) && $_GET["email"]=="bad") ? '<span style="color:#f00;">Ovo polje je obavezno.</span>' : '';?><br><br>
        <b>birthday:</b> year : <select name="year" id="year"><?php simpleSelect($year_end,$year_start); ?></select>
        * month : <select name="month" id="month"><?php simpleSelect(1,12); ?></select>
        * day : <select name="day" id="day"><?php simpleSelect(1,31); ?></select> *   <?php echo ((isset($_GET["year"]) && $_GET["year"]=="bad") ||
            (isset($_GET["month"]) && $_GET["month"]=="bad") || (isset($_GET["day"]) && $_GET["day"]=="bad")) ? '<span style="color:#f00;">Datum je nepotpun ili prazan.</span>' : '';?>
        <br><br>
        <b>pizzas:</b> <select name="pizza" id="pizza">
            <option value="default">- choose -</option>
            <?php
            foreach($pizza as $name => $price){
                echo '<option value="' . $name . '">' . $name . '</option>';
            }
            ?>
        </select> *   <?php echo (isset($_GET["pizza"]) && $_GET["pizza"]=="bad") ? '<span style="color:#f00;">Niste izabrali picu.</span>' : '';?><br>
        <hr>
        <?php
        foreach ($pizza as $name => $price){
            echo $name . " = " . $price . " " . $currency . "<br>";
        }
        ?>
        <hr>
        <b>amount:</b> <select name="amount" id="amount"><?php simpleSelect(1,10); ?></select> *   <?php echo (isset($_GET["amount"]) && $_GET["amount"]=="bad") ? '<span style="color:#f00;">Niste izabrali kolicinu.</span>' : '';?><br><br>
        <b>payment:</b> <input type="radio" name="payment" value="cash"> cash <input type="radio" name="payment" value="card"> card  *   <?php echo (isset($_GET["payment"]) && $_GET["payment"]=="bad") ? '<span style="color:#f00;">Niste izabrali nacin placanja.</span>' : '';?><br><br>
        <b>comment</b> <br><br>
        <textarea name="comment" id="comment" cols="22" rows="3"></textarea><br><br>
        <b>Field with * are required!</b><br><br>
        <input type="submit" name="submit" id="submit" value="order"> <input type="reset" name="reset" id="reset" value="cancel"><br><br>
    </fieldset>
</form>

</body>
</html>