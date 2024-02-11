<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$artist = getArtistByID($_GET['id']);


?>




<div class="container  p-5">
    <div class='text-center my-5'>
         
        <h1 class='fs-1 fw-bold'>WHAT A REC<i class="bi bi-vinyl-fill"></i>RD!</h1>
        
        <p class='fs-4 fw-semibold' >Store here your favorite records!</p>
    </div>


    <div class="row">
        <div class="col-4 text-center ">
        
            <div class= 'position-relative'>
                <img src=<?=$artist['cover']?> alt="albumCover"  class='img-fluid'  > 
                <a href="controller.php?action=resetCover&id=<?=$artist['id']?>&table=artists" class='btn btn-danger  position-absolute top-0 end-0'><i class="bi bi-trash3"></i></a>
            </div>  
            <div class="my-3">
                <p class='fs-4 fw-bold m-0'><?=$artist['name']?></p>
                <?php 
                    if ($artist['country']) {echo "<p class='fs-5 fw-semibold m-0'>From: ".$artist['country']."</p>";}
                    if ($artist['albumN'] != 0) {echo "<p class='fs-5 fw-semibold m-0'>Released album: ".$artist['albumN']."</p>";}
                    if ($artist['genre']) {echo "<p class='fs-5 fw-semibold m-0'>Genre: ".$artist['genre']."</p>";}
                ?>
            </div> 
        </div> 
        
        <div class="col-8">
        <form method='POST' action="controller.php?action=updateArtist&id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
        <div class='row g-3'>
            <div class="mb-3 ">
                <label class='fw-semibold fs-5'  for="name">Name</label>
                <input type="text" class="form-control" value='<?=$artist['name']?>' placeholder='Name...' name='name' id='name'>
            </div>

            <div class="mb-3 ">
                <label class='fw-semibold fs-5' for="country">Country</label>
                <input type="text" class="form-control" value='<?=$artist['country']?>' placeholder='Country...' name='country' id='country'>
            </div>
            <div class="mb-3 ">
                <label class='fw-semibold fs-5' for="albumN">Released Albums</label>
                <input type="number" class="form-control" value='<?=$artist['albumN']?>' placeholder='Released Albums...'name='albumN' id='albumN'>
            </div>
            <div class="mb-3 ">
                <label class='fw-semibold fs-5' for="genre">Genre</label>
                <input type="text" class="form-control" value='<?=$artist['genre']?>' placeholder='Genre...' name='genre' id='genre'>
            </div>

            </div>
                <div class="mb-3 ">
                    <label class='fw-semibold fs-5' for="cover">Cover</label>
                    <input type="file" class="form-control" placeholder='Upload the image' name='cover' id='cover'>
                </div>
                <div class="mb-3 ">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </div>

    </form>
        </div>
    </div>


    


</div>
























<?php
require_once('footer.php');
?>