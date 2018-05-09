<?php

    include 'inc/header.php';
    
    $dir = 'img/';
    $imageFiles = glob($dir.'*.jpg');
    
?>       
<script>
    $(document).ready(function(){
        $("#home").addClass("active");
        $("#pets").removeClass("active");
        $("#about").removeClass("active");
    });
</script>
<style>
    #adoptButton {
      width: 600px;
    }
</style>
        <!-- Add Carousel here -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <?php for ($i=1; $i < count($imageFiles); $i++) { ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"></li>
          <?php } //endFor ?> 
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$imageFiles[0]?>" alt="First slide">
            </div>
            <?php for ($i=1; $i < count($imageFiles); $i++) { ?>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?=$imageFiles[$i]?>" alt = "First Slide">
              </div>
            <?php } //endFor ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        <br>
        
        <a href="pets.php"  class="btn btn-outline-secondary" role="button" id="adoptButton" aria-pressed="true"> Adopt Now! </a>
        
        
        <br>
        
        <div id = "petInfo"></div>

<?php

    include 'inc/footer.php';

?>