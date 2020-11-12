<?php
require_once("includes/header.php");
$preview = new PreviewProvider($con, $userLoggedIn);
// displaying random video
echo $preview->createPreviewVideo(null);

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showAllCategories();
?>
