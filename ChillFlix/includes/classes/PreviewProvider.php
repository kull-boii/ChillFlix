<?php
class PreviewProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }
    public function createCategoryPreviewVideo($categoryId) {
        $entitiesArray = EntityProvider::getEntities($this->con, $categoryId, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createTVShowPreviewVideo(){
      $entitiesArray = EntityProvider::getTVShowEntities($this->con, null, 1);
      if(sizeof($entitiesArray) == 0){
        ErrorMessage::show("NO TV SHOWS TO DISPLAY");
      }

      return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createMoviesPreviewVideo(){
        $entitiesArray = EntityProvider::getMoviesEntities($this->con, null, 1);
        if(sizeof($entitiesArray) == 0){
          ErrorMessage::show("NO MOVIES TO DISPLAY");
        }
  
        return $this->createPreviewVideo($entitiesArray[0]);
      }


    // aim is to display random video
    // but if the user is on a particular entity then dont display different video
    public function createPreviewVideo($entity) {
         if($entity == null) {
            $entity = $this->getRandomEntity();
        }

        $id=$entity->getId();
        $name=$entity->getName();
        $preview=$entity->getPreview();
        $thumbnail=$entity->getThumbnail();
        $videoId = $entity->getId();

        // TODO : add subtitles
        // creating video instance and we will display the episode no and season no
        // if it is a movie dont display
        $video = new Video($this->con, $videoId);
        $inProgress=$video->isInProgress($this->username);
        $playButtonText = $inProgress ? "Contiue Watching" : "Play";

        // gettting the episode no
        $seasonEpisode = $video->getSeasonAndEpisode();

        // so if it is a movie append an h4 tqg else append empty string that is nothing
        $subheading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";


        $videoId = VideoProvider::getEntityVideoForUser($this->con,$id,$this->username);




        return"<div class='previewContainer'>

              <img src='$thumbnail' class='previewImage'  hidden>
              <video autoplay muted class='previewVideo' onended='previewEnded()'>
                  <source src='$preview' type='video/mp4'>
              </video>

              <div class='previewOverlay'>
                  <div class='mainDetails'>
                    <h3>$name</h3>
                    <span class='subheading'>$subheading</span>

                        <div class = 'buttons'>
                            <button onclick='watchVideo($videoId)'><i class='fas fa-play'></i> $playButtonText</button>
                            <button onclick ='volumeToggle(this)'>
                            <i class='fas fa-volume-mute'></i></button>

                        </div>

                  </div>
              </div>

        </div>";

    }
    public function createEntityPreviewSquare($entity) {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
                </a>";
    }

    private function getRandomEntity() {
      /*
        // selecting a random entity from entities table

        $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");

        // executing the query
        $query->execute();

        // displays in key value pair
        $row = $query->fetch(PDO::FETCH_ASSOC);
        // displaying random videos
        return new Entity($this->con, $row);
        */
        $entity = EntityProvider::getEntities($this->con, null,1);
        return $entity[0];
    }

}
?>
