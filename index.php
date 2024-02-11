<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$albums= getAllAlbums();

?>


<div class="container  p-5">
    <div class='text-center my-5'>
         
        <h1 class='fs-1 fw-bold'>WHAT A REC<i class="bi bi-vinyl-fill"></i>RD!</h1>
        
        <p class='fs-4 fw-semibold' >Store here your favorite records!</p>
    </div>

    

    <!-- form add ALBUM -->
    <form class='p-3 m-3 rounded-4 shadow addForm' method='POST' action="controller.php?action=addAlbum" enctype="multipart/form-data">
        <p class='text-center fw-semibold text-light '>Add an album to your library</p>
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
            <button type="submit" class="btn btn-outline-light">Submit</button>
            </div>
        </div>
    
    </form>

    <!-- form add ARTIST -->
   <!--  <form class='border border-dark p-3 m-3 rounded-4' method='POST' action="controller.php?action=addArtist" enctype="multipart/form-data">
        <p class='text-center fw-semibold '>Add an artist to your library</p>
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
            <button type="submit" class="btn btn-outline-dark">Submit</button>
            </div>
        </div>
    
    </form> -->

    <div>
        <?php 
            if(!$albums) {
        ?>  
            <h2 class='text-center my-5 py-5'>It seems that your record collection is empty...</h2>
                                     
        <?php 
            } else { 
        ?>
                <div class="row row-cols-4 flex-wrap">

        <?php
                foreach($albums as $album) { 
                    $src= $album['cover']  ? $album['cover']  :  $defaultCover;
        ?>
                    <div class="col d-flex flex-column text-center rounded-4 shadow p-3 albumCard">
                        <div >

                            <img src=<?=$src?> alt="albumCover" class='img-fluid shadow' >

                        </div>   
                        <div >
                            <p class='fs-4 fw-bold m-0'><?=$album['title']?></p>
                            <p class='fs-5 fw-semibold m-0'><?=$album['artist']?></p>
                            <p class='fs-6  m-0'>Release Year: <?=$album['year']?></p>
                            <p class='fs-6  m-0'>Genre: <?=$album['genre']?></p>
                            <hr>
                        </div> 
                        <div >
                            <a href="updateAlbum.php?id=<?=$album['id']?>" class='btn btn-outline-light'><i class="bi bi-pencil-square"></i></a>
                            <a href="controller.php?action=deleteAlbum&id=<?=$album['id']?>" class='btn btn-outline-dark'><i class="bi bi-trash3"></i></a>

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