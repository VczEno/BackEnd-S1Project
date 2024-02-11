<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$album= getAlbumByID($_GET['id']);
?>

<div class="container  p-5">
    <div class='text-center my-5'>
         
        <h1 class='fs-1 fw-bold'>WHAT A REC<i class="bi bi-vinyl-fill"></i>RD!</h1>
        
        <p class='fs-4 fw-semibold' >Store here your favorite records!</p>
    </div>

    <div class="row">
        <div class="col-4 text-center ">
        
            <div class= 'position-relative'>
            <img src=<?=$album['cover']?> alt="albumCover"  class='w-100'  > 
            <a href="controller.php?action=resetCover&id=<?=$album['id']?>&table=albums" class='btn btn-danger  position-absolute top-0 end-0'><i class="bi bi-trash3"></i></a>
            </div>  
        
        
            <div class='my-3'>
                <p class='fs-4 fw-bold m-0'><?=$album['title']?></p>
                <p class='fs-5 fw-semibold m-0'><?=$album['artist']?></p>
                <p class='fs-6  m-0'>Release Year: <?=$album['year']?></p>
                <p class='fs-6  m-0'>Genre: <?=$album['genre']?></p>
            </div> 
        </div>
        <div class="col-8">
            <form method='POST' action="controller.php?action=updateAlbum&id=<?=$_GET['id']?>" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label class='fw-semibold fs-5' for="">Title</label>
                        <input type="text" class="form-control" value='<?= $album['title'] ?>' placeholder='Title...' name='title'>
                    </div>
                   
                    <div class="mb-3">
                        <label class='fw-semibold fs-5'  for="">Release Year</label>
                        <input type="number" class="form-control" value='<?=$album['year']?>' placeholder='Release Year...' name='year'>
                    </div>
                    <div class="mb-3">
                        <label class='fw-semibold fs-5'  for="">Genre</label>
                        <input type="text" class="form-control" value='<?=$album['genre']?>' placeholder='Genre...' name='genre'>
                    </div>
                    
        
                
                    <div class="mb-3">
                        <label class='fw-semibold fs-5' for="">Cover</label>
                    <input type="file" class="form-control" placeholder='Upload the cover' name='cover'>

                    </div>
                    
                    
                    <button type="submit" class="btn btn-dark">Submit</button>
                    
                
            
            </form>
        </div>
    </div>

</div>
























<?php
require_once('footer.php');
?>