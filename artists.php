<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$artists= getAllArtists();

?>


<div class="container  p-5">
    <div class='text-center my-5'>
         
        <h1 class='fs-1 fw-bold'>WHAT A REC<i class="bi bi-vinyl-fill"></i>RD!</h1>
        
        <p class='fs-4 fw-semibold' >Store here your favorite records!</p>
    </div>


    <form class='border border-dark p-3 m-3 rounded-4 addForm' method='POST' action="controller.php?action=addArtist" enctype="multipart/form-data">
        <p class='text-center fw-semibold text-light '>Add an artist to your library</p>
        <div class='row g-3'>    
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Name...' name='name'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Country...' name='country'>
            </div>
            <div class="mb-3 col">
                <input type="number" class="form-control" placeholder='Album Number...' name='albumN'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Genre...' name='genre'>
            </div>
            
        </div>
        <div class='row g-3'>
        <div class="mb-3 col offset-4">
                <input type="file" class="form-control" placeholder='Add an image' name='cover'>
            </div>
            <div class="mb-3 col">
            <button type="submit" class="btn btn-outline-light">Submit</button>
            </div>
        </div>
    
    </form>

    <div>
   
         
        <?php 
            if(!$artists) {
        ?>  
            <h2 class='text-center my-5 py-5'>It seems that your record collection is empty...</h2>
                                     
        <?php 
            } else { 
        ?>
                <div class="row row-cols-4 flex-wrap">

        <?php
                foreach($artists as $artist) { 
                    $src= $artist['cover']  ? $artist['cover']  :  $defaultCover;
        ?>
                    <div class="col d-flex flex-column text-center rounded-4 shadow p-3 albumCard">
                        <div >

                            <img src=<?=$src?> alt="artistImage" class='img-fluid shadow' >

                        </div>   
                        <p class='fs-4 fw-bold m-0'><?=$artist['name']?></p>
                <?php 
                    if ($artist['country'] != '') {echo "<p class='fs-5 fw-semibold m-0'>From: ".$artist['country']."</p>";}
                    if ($artist['albumN'] != 0) {echo "<p class='fs-5 fw-semibold m-0'>Released album: ".$artist['albumN']."</p>";}
                    if ($artist['genre'] != '' ) {echo "<p class='fs-5 fw-semibold m-0'>Genre: ".$artist['genre']."</p>";}
                ?> 
                        <hr>
                        <div>
                            <a href="updateArtist.php?id=<?=$artist['id']?>" class='btn btn-outline-light'><i class="bi bi-pencil-square"></i></a>
                            <a href="controller.php?action=deleteArtist&id=<?=$artist['id']?>" class='btn btn-outline-dark'><i class="bi bi-trash3"></i></a>

                        </div>
                    </div>
                  
            
        <?php 
                } // ma può essere che devo fare così per incrociare HTML e PHP?
        ?>
            </div>
        <?php     
            }
        ?>


        
    </div>

</div>
























<?php
require_once('footer.php');
?>