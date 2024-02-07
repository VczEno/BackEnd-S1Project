<?php
require_once('config.php');
require_once('function.php');

require_once('head.php');
include_once('navbar.php');

// salvo, se presenti, gli album presenti nel DB
$album=getAlbumByID($_GET['id']);

?>


<div class="container  p-5">
    <div class='text-center'>
        <h1>WHAT A RECORD!</h1>
        <p>Store you favorite record here</p>
    </div>

    


    <form method='POST' action="controller.php?action=updateAlbum&id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <div class='row g-3'>    
            <div class="mb-3 col">
                <input type="text" class="form-control" value=<?=$album['title']?> placeholder='Title...' name='title'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" value=<?=$album['artist']?> placeholder='Artist...' name='artist'>
            </div>
            <div class="mb-3 col">
                <input type="number" class="form-control" value=<?=$album['year']?> placeholder='Release Year...' name='year'>
            </div>
            <div class="mb-3 col">
                <input type="text" class="form-control" value=<?=$album['genre']?> placeholder='Genre...' name='genre'>
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


</div>
























<?php
require_once('footer.php');
?>