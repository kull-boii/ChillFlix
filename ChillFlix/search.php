<?php
    include_once("includes/header.php");
?>

<div class="textboxContainer" style="padding: 100px 50px;">
    <input type="text" style="  height: 50px;
  width: 80vw;
  margin:auto auto;
  border: 1px solid #dedede;
  background-color: transparent;
  color: #fff;
  font-size: 20px;
  padding: 5px 10px;
  border-radius: 6px;"
class="searchInput" placeholder="Search Movies, Shows ...">
</div>


<div class="results"></div>


<script>

$(function(){

  const username = '<?php echo $userLoggedIn ?>';
  let timer;

  $(".searchInput").keyup(function()
  {
    clearTimeout(timer);

    timer = setTimeout(() => {
      let val = $(".searchInput").val();

      if(val != "")
      {
          $.post("ajax/getSearchResults.php",{term : val, username : username},function(data)
          {
        $(".results").html(data);

          })
      }
      else{
        $(".results").html("");
      }





      console.log(val);
    }, 500);
  })

})




</script>
