<?php
require_once("includes/header.php");
$preview = new PreviewProvider($con, $userLoggedIn);

// displaying random video
echo $preview->createMoviesPreviewVideo();

echo "<script type='text/javascript'> 
let ele = document.querySelector('span.subheading');
ele.remove();
</script>"; 


$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showMovieCategories();

 
?>
