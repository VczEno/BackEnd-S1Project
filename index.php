<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$albums=getAllAlbum();

?>


<div class="container  p-5">
    <div class='text-center'>
        <h1>WHAT A RECORD!</h1>
        <p>Store you favorite record here</p>
    </div>

    


    <form method='POST' action="controller.php?action=addAlbum" enctype="multipart/form-data">
        <div class='row g-3'>    
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Title...' name='title'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Artist...' name='artist'>
            </div>
            <div class="mb-3 col">
                <input type="number" class="form-control" placeholder='Release Year...' name='year'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" placeholder='Genre...' name='genre'>
            </div>
            
        </div>
        <div class='row g-3'>
        <div class="mb-3 col offset-4">
                <input type="file" class="form-control" placeholder='Upload the cover' name='cover'>
            </div>
            <div class="mb-3 col">
            <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </div>
    
    </form>

    <div>
   
         
        <?php 
            if(!$albums) {
        ?>  
            <h2 class='text-center'>It seems that your record collection is empty...</h2>
                                     
        <?php 
            } else { 
        ?>
                <div class="row row-cols-4 flex-wrap">

        <?php
                foreach($albums as $album) { 
                    $src= $album['cover']  ? $album['cover']  :  $defaultCover;
        ?>
                    <div class="col d-flex flex-column">
                        <div >

                            <img src=<?=$src?> alt="albumCover" class='img-fluid' >

                        </div>   
                        <div class="text-center">
                            <p class='fs-4 fw-bold m-0'><?=$album['title']?></p>
                            <p class='fs-5 fw-semibold m-0'><?=$album['artist']?></p>
                            <p class='fs-6  m-0'>Release Year: <?=$album['year']?></p>
                            <p class='fs-6  m-0'>Genre: <?=$album['genre']?></p>
                        </div> 
                        <div>
                            <a href="updateAlbum.php?id=<?=$album['id']?>" class='btn btn-outline-warning'><i class="bi bi-pencil-square"></i></a>
                            <a href="controller.php?action=delete&id=<?=$album['id']?>" class='btn btn-outline-danger'><i class="bi bi-trash3"></i></a>

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