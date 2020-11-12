<?php
$hideNav = true;
require_once("includes/header.php");
if(!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into page");
}

$user = new User($con,$userLoggedIn);
if(!$user->getIsSubscribed()){
  ErrorMessage::show("You must be subscribed to watch.
                      <a href = 'profile.php'>Click here to subscribe</a>");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();

$upNextVideo = VideoProvider::getUpNext($con, $video);

 ?>
<div class= "watchContainer">

  <div class = "videoControls watchNav hide"style="
  position: absolute;
  width: 100%;
  z-index: 1;
  display: flex;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.3);">
    <button OnClick = "goBack()"><i class="fas fa-arrow-left"></i></button>
    <h1><?php echo $video-> getTitle(); ?> </h1>
  </div>

<!-- video overlay displays after the video is ended -->
  <div class="videoControls upNext"
  style="
  position: absolute;
  width: 100%;
  z-index: 1;
  display: flex;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.3);
  display:none;">
    <button OnClick = "restartVideo();"><i style = "color : azure; cursor: pointer;" class="fas fa-redo"></i></button>
    <div class="upNextContainer">
        <h2 style="color : #00ffff;">Up next:</h2>
        <h3 style="color : #d9ecf2;"><?php echo $upNextVideo->getTitle(); ?></h3>
        <h3 style="color : #d9ecf2;"><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>
        <button style="color : aquamarine; cursor: pointer;">
          <div class="playNext" style="color: aquamarine;" OnClick = "watchVideo(<?php echo $upNextVideo->getId();  ?>)">
          <i style="color: aquamarine; " class="fas fa-play"></i> Play
          </div>

        </button>
    </div>
  </div>

  <div class = "videoControls watchNav">
    <video controls autoplay onended="showUpNext()" style=" cursor: none; ">
          <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
          </source>
    </video>
</div>
<script>
    initVideo("<?php echo $video ->getId(); ?>","<?php echo $userLoggedIn; ?>");
</script>
