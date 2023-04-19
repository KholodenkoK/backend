<?php
$a = htmlspecialchars($_GET["search"]);
if (isset($a)) echo $a;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br>
    <input type="submit" value="Submit">
</form>
<!--<script async src="https://cse.google.com/cse.js?cx=700ba0602242244ab">-->
<!--</script>-->
<div class="gcse-search"></div>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/customsearch/v1?key=AIzaSyBMxyOcnbfqtzbTcbLXK6NK994CnT6mEcs&cx=700ba0602242244ab&q='.$a);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$results = json_decode($response, true);
if (isset($results["items"])) {
    foreach ($results["items"] as $result) {
        echo "<a href='".$result["link"]."'>".$result["title"]."</a><br>";
        echo $result["snippet"]."<br>";
        echo "<hr>";
    }
} else {
    echo "---";
}
?>
</body>
</html>