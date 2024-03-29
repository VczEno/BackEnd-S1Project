<?php 
require_once('config.php');
include_once('function.php');

//aggiunta di un nuovo album al DB
if(isset($_REQUEST["action"]) && $_REQUEST["action"] === "addAlbum") {
    //validazione dei dati del form
    $albumTitle= strlen(trim(htmlspecialchars($_REQUEST['title']))) > 2 ? trim(htmlspecialchars($_REQUEST['title'])) : exit();
    $albumArtist =strlen(trim(htmlspecialchars($_REQUEST['artist']))) > 2 ? trim(htmlspecialchars($_REQUEST['artist'])) : exit();
    $albumYear= is_numeric(trim(htmlspecialchars($_REQUEST['year'])))  && trim(htmlspecialchars($_REQUEST['year'])) <= date('Y') ? trim(htmlspecialchars($_REQUEST['year'])) : exit;
    $albumGenre =strlen(trim(htmlspecialchars($_REQUEST['genre']))) > 2 ? trim(htmlspecialchars($_REQUEST['genre'])) : exit();;
    
    //instruzioni per il caricamento dell'immagine
    
    $target_dir = "uploads/"; //setto la cartella per gli upload
    $albumCover = $target_dir.'defaultCover.png'; //definisco il percorso per una copertina predefinita

    if(!empty($_FILES['cover'])) {
        if($_FILES['cover']["type"] === 'image/png' || $_FILES['cover']["type"] === 'image/jpg' || $_FILES['cover']["type"] === 'image/jpeg') { // true se il file è .jpeg o .png
            if($_FILES['cover']["size"] < 4000000) { 
                //funzione di php per l'upload del file in una cartella temporanea
                if(is_uploaded_file($_FILES['cover']["tmp_name"]) && $_FILES['cover']["error"] === UPLOAD_ERR_OK) { //true se caricamento andato a buon fine senza messaggi di errore
                    //funzione di php che sposta il file, i parametri sono i percorsi di partenza e arrivo 

                    if(move_uploaded_file($_FILES['cover']["tmp_name"], $target_dir.str_replace(' ', '_',$albumTitle).'-'.str_replace(' ', '_', $albumArtist))) {
                        $albumCover = $target_dir.str_replace(' ', '_',$albumTitle).'-'.str_replace(' ', '_', $albumArtist);
                        // se tutte le operazioni vanno a buon fine salvo nel database il percorso dell'immagine nominato univocamente per ogni album 
                        echo 'Caricamento avvenuto con successo';
                        
                    } else {
                        echo 'Errore!!!';
                    }
                }
            } else {
                echo 'FileSize troppo grande';
            }
        } else {
            /* var_dump($_FILES['cover']); */
            echo 'FileType non supportato';
        }
    }

    addAlbum ($albumTitle, $albumArtist, $albumYear, $albumGenre, $albumCover);
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'deleteAlbum') {
    deleteAlbum($_REQUEST['id']);
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'updateAlbum') {

    $albumTitle= strlen(trim(htmlspecialchars($_REQUEST['title']))) > 2 ? trim(htmlspecialchars($_REQUEST['title'])) : exit(print ' errore1');
/*     $albumArtist =strlen(trim(htmlspecialchars($_REQUEST['artist']))) > 2 ? trim(htmlspecialchars($_REQUEST['artist'])) : exit(print ' errore2');
 */    $albumYear= is_numeric(trim(htmlspecialchars($_REQUEST['year'])))  && trim(htmlspecialchars($_REQUEST['year'])) <= date('Y') ? trim(htmlspecialchars($_REQUEST['year'])) : exit(print ' errore3');
    $albumGenre =strlen(trim(htmlspecialchars($_REQUEST['genre']))) > 2 ? trim(htmlspecialchars($_REQUEST['genre'])) : exit(print ' errore4');;
    
    //instruzioni per il caricamento dell'immagine
    
    $target_dir = "uploads/"; //setto la cartella per gli upload
    

    if(!empty($_FILES['cover'])) {
        if($_FILES['cover']["type"] === 'image/png' || $_FILES['cover']["type"] === 'image/jpg' || $_FILES['cover']["type"] === 'image/jpeg') { // true se il file è .jpeg o .png
            if($_FILES['cover']["size"] < 4000000) { 
                //funzione di php per l'upload del file in una cartella temporanea
                if(is_uploaded_file($_FILES['cover']["tmp_name"]) && $_FILES['cover']["error"] === UPLOAD_ERR_OK) { //true se caricamento andato a buon fine senza messaggi di errore
                    //funzione di php che sposta il file, i parametri sono i percorsi di partenza e arrivo 

                    if(move_uploaded_file($_FILES['cover']["tmp_name"], $target_dir.str_replace(' ', '_',$albumTitle).'-'.str_replace(' ', '_', $albumArtist))) {
                        $albumCover = $target_dir.str_replace(' ', '_',$albumTitle).'-'.str_replace(' ', '_', $albumArtist);
                        // se tutte le operazioni vanno a buon fine salvo nel database il percorso dell'immagine nominato univocamente per ogni album 
                        echo 'Caricamento avvenuto con successo';
                        updateCover('albums', $_REQUEST['id'], $albumCover);

                    } else {
                        echo 'Errore!!!';
                    }
                }
            } else {
                echo 'FileSize troppo grande';
            }
        } else {
            var_dump($_FILES['cover']);
            echo 'FileType non supportato';
        }
    }




   updateAlbum($_REQUEST['id'], $albumTitle, $albumYear, $albumGenre);
}

if(isset($_REQUEST["action"]) && $_REQUEST["action"] === "addArtist") {
    //validazione dei dati del form
    $artistName= strlen(trim(htmlspecialchars($_REQUEST['name']))) > 2 ? trim(htmlspecialchars($_REQUEST['name'])) : exit();
    $artistCountry =strlen(trim(htmlspecialchars($_REQUEST['country']))) > 2 ? trim(htmlspecialchars($_REQUEST['country'])) : NULL;
    $artistAlbumN= is_numeric(trim(htmlspecialchars($_REQUEST['albumN']))) ? trim(htmlspecialchars($_REQUEST['albumN'])) : 0;
    $artistGenre =strlen(trim(htmlspecialchars($_REQUEST['genre']))) > 2 ? trim(htmlspecialchars($_REQUEST['genre'])) : NULL;
    
    //instruzioni per il caricamento dell'immagine
    
    $target_dir = "uploads/artists/"; //setto la cartella per gli upload
    $artistCover = $target_dir.'defaultArtist.png'; //definisco il percorso per una copertina predefinita

    if(!empty($_FILES['cover'])) {
        if($_FILES['cover']["type"] === 'image/png' || $_FILES['cover']["type"] === 'image/jpg' || $_FILES['cover']["type"] === 'image/jpeg') { // true se il file è .jpeg o .png
            if($_FILES['cover']["size"] < 4000000) { 
                //funzione di php per l'upload del file in una cartella temporanea
                if(is_uploaded_file($_FILES['cover']["tmp_name"]) && $_FILES['cover']["error"] === UPLOAD_ERR_OK) { //true se caricamento andato a buon fine senza messaggi di errore
                    //funzione di php che sposta il file, i parametri sono i percorsi di partenza e arrivo 

                    if(move_uploaded_file($_FILES['cover']["tmp_name"], $target_dir.str_replace(' ', '_',$artistName))) {
                        $artistCover = $target_dir.str_replace(' ', '_',$artistName);
                        // se tutte le operazioni vanno a buon fine salvo nel database il percorso dell'immagine nominato univocamente per ogni album 
                        echo 'Caricamento avvenuto con successo';
                        
                    } else {
                        echo 'Errore!!!';
                    }
                }
            } else {
                echo 'FileSize troppo grande';
            }
        } else {
            var_dump($_FILES['cover']);
            echo 'FileType non supportato';
        }
    }

    addArtist ($artistName, $artistCountry, $artistAlbumN, $artistGenre, $artistCover);
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'deleteArtist') {
    deleteArtist($_REQUEST['id']);
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'updateArtist') {
     //validazione dei dati del form
     $artistName= strlen(trim(htmlspecialchars($_REQUEST['name']))) > 2 ? trim(htmlspecialchars($_REQUEST['name'])) : exit();
     $artistCountry =strlen(trim(htmlspecialchars($_REQUEST['country']))) > 2 ? trim(htmlspecialchars($_REQUEST['country'])) : NULL;
     /* $artistIsBand = $_REQUEST['isBand']; */
     
     $artistAlbumN= is_numeric(trim(htmlspecialchars($_REQUEST['albumN']))) ? trim(htmlspecialchars($_REQUEST['albumN'])) : 0;
     $artistGenre =strlen(trim(htmlspecialchars($_REQUEST['genre']))) > 2 ? trim(htmlspecialchars($_REQUEST['genre'])) : NULL;
     
     
     
     //instruzioni per il caricamento dell'immagine
     
     $target_dir = "uploads/artists/"; //setto la cartella per gli upload
    
 
     if(!empty($_FILES['cover'])) {
         if($_FILES['cover']["type"] === 'image/png' || $_FILES['cover']["type"] === 'image/jpg' || $_FILES['cover']["type"] === 'image/jpeg') { // true se il file è .jpeg o .png
             if($_FILES['cover']["size"] < 4000000) { 
                 //funzione di php per l'upload del file in una cartella temporanea
                 if(is_uploaded_file($_FILES['cover']["tmp_name"]) && $_FILES['cover']["error"] === UPLOAD_ERR_OK) { //true se caricamento andato a buon fine senza messaggi di errore
                     //funzione di php che sposta il file, i parametri sono i percorsi di partenza e arrivo 
 
                     if(move_uploaded_file($_FILES['cover']["tmp_name"], $target_dir.str_replace(' ', '_',$artistName))) {
                         $artistCover = $target_dir.str_replace(' ', '_',$artistName);
                         // se tutte le operazioni vanno a buon fine salvo nel database il percorso dell'immagine nominato univocamente per ogni album 
                         echo 'Caricamento avvenuto con successo';
                         updateCover('artists', $_REQUEST['id'], $artistCover);
                     } else {
                         echo 'Errore!!!';
                     }
                 }
             } else {
                 echo 'FileSize troppo grande';
             }
         } else {
             var_dump($_FILES['cover']);
             echo 'FileType non supportato';
         }
     } 



    updateArtist($_REQUEST['id'], $artistName, $artistCountry, /* $artistIsBand, */ $artistAlbumN, $artistGenre);




    
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'resetCover') {
    resetCover($_REQUEST['table'], $_REQUEST['id']);

}




    



