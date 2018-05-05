<?php

    include 'inc/header.php';
    
    include '../../dbConnection.php';
    
    function getAllPets(){
        
      $conn = getDatabaseConnection('pets');
      
      $sql = "SELECT id, name, type FROM pets ORDER BY name";
      
      $stmt = $conn->prepare($sql);  
      $stmt->execute();
      $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $records;  
    }
    
?>
<script>
    $(document).ready(function(){
        $("#home").removeClass("active");
        $("#pets").addClass("active");
        $("#about").removeClass("active");
    });
</script>

<script>
    
    $(document).ready(function(){
    
            $("#adoptionsLink").addClass("active");
            
            $(".petLink").click(function(){
                
                //alert(  );
                
                $('#petModal').modal("show");
                $("#petInfo").html("<img src='img/loading.gif'>");
                      
                
                $.ajax({

                    type: "GET",
                    url: "api/getPetInfo.php",
                    dataType: "json",
                    data: { "id": $(this).attr("id")},
                    success: function(data,status) {
                       //alert(data.breed);
                       //log.console(data.pictureURL);
                       
                       $("#petModalLabel").html("<h2>" + data.name +"</h2>");
                       $("#petInfo").html("");
                       $("#petInfo").append("<img src='img/" + data.pictureURL +"' width='150' style='float:left'>");
                       $("#petInfo").append("Age: " + ((new Date()).getFullYear() - data.yob) + " years <br>");
                       $("#petInfo").append("Breed: " + data.breed + "<br>");
                       $("#petInfo").append(data.description + "<br>");
                       
                       
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                });//ajax
                
                
            });
        
        
    }); //document ready
    
    
</script>

<style>
    #adopt {
        margin: 0 auto;
        text-align:left;
        width: 600px;
        height: 60px;
        position: relative;
        border: 2px solid black;
        background-color: rgba(0, 0, 0, .08);
        border-radius: 10px;
        padding-left: 10px;
    }
    #adoptButton {
        margin-top:8px;
        margin-right:8px;
        position: absolute;
        right: 0px;
    }
</style>
<?php
    $petList = getAllPets();
    
    //print_r($petList);
    
    foreach ($petList as $pet) {
        echo "<div id='adopt'>";
        echo "<button type='button' class='btn btn-secondary' id='adoptButton'>Adopt Me!</button>";
        echo "Name: <a href='#' class='petLink' id='".$pet['id']."'  > " . $pet['name'] . " </a> <br>";
        echo "Type: " . $pet['type'] . "<br><br>";
        echo "</div><br>";
        
    }

?>


<!-- Modal -->
<div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="petModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
        <div id="petInfo"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php

    include 'inc/footer.php';

?>