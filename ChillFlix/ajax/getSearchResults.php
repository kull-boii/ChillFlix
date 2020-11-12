<?php
require_once("../includes/config.php");
require_once("../includes/classes/SearchResultsProvider.php");
require_once("../includes/classes/EntityProvider.php");
require_once("../includes/classes/Entity.php");
require_once("../includes/classes/PreviewProvider.php");

if(isset($_POST["term"]) && isset($_POST["username"])){
    // echo "hello" . $_POST["term"];
    $srp = new SearchResultsProvider($con,$_POST["username"]);
    echo $srp->getResult($_POST["term"]);

}
else {
    echo "No term or username passed into file";
}
?>
