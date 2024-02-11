<?php 

function getAllAlbums () {
    global $mysqli;
    $sql='SELECT * FROM albums';
    $res= $mysqli->query($sql);
    if($res) {
        $result= [];
        while ($row=$res->fetch_assoc()) {
            $result[] = $row;
        }
    return $result;
    }    
}

function addAlbum ($albumTitle, $albumArtist, $albumYear, $albumGenre, $albumCover) {
    global $mysqli;
    $sql= "SELECT * FROM artists WHERE name='".$albumArtist."'";
    $res= $mysqli->query($sql);
    if($res) {
        var_dump($res);
        while ($row=$res->fetch_assoc()) {
            print_r($row);
            $art_id= $row['id'];
            
            echo $art_id;
            if(is_numeric($art_id)){echo 'ARTISTA TROVATO';};
        }
        if (!is_numeric($art_id)) {
            echo"ARTISTA ASSENTE";
            $target_dir = "uploads/artists/"; //setto la cartella per gli upload
            $artistCover = $target_dir.'defaultArtist.png'; //definisco il percorso per una copertina predefinita
        $sql= "INSERT INTO artists (name, cover) VALUES ('".$albumArtist."', '".$artistCover."')";
        if (!$mysqli->query($sql)) {
            echo ($mysqli->connect_error);
            } else {
            echo 'Record ARTISTA aggiunto con successo!!!';
            }
        $sql= "SELECT * FROM artists WHERE name='".$albumArtist."'";
        $res= $mysqli->query($sql);
        if($res) {
        
            var_dump($res);
            while ($row=$res->fetch_assoc()) {
                $result = $row;
                $art_id= $result['id'];
                echo $art_id;
                if(!is_null($art_id)){echo 'ARTISTA appena aggunto TROVATO';};
            }
            
            
            
        }
    
    } 
    

    $sql = "INSERT INTO albums (title, artist, year, genre, cover, art_id) 
    VALUES ('$albumTitle', '$albumArtist', '$albumYear', '$albumGenre', '$albumCover', '$art_id');";
if (!$mysqli->query($sql)) {
echo ($mysqli->connect_error);
} else {
echo 'Record ALBUM aggiunto con successo!!!';
header('location:http://localhost/BackEnd-S1Project/');
}
}
}

function deleteAlbum($id) {
    global $mysqli;
    $sql='DELETE FROM albums WHERE id='.$_REQUEST['id'];
    if (!$mysqli->query($sql)) {
        echo ($mysqli->connect_error);
        } else {
        echo 'Record eliminato con successo!!!';
        exit(header('Location: http://localhost/BackEnd-S1Project/'));
        }
}

function updateAlbum($id, $albumTitle, $albumYear, $albumGenre) {
    global $mysqli;
    $sql="UPDATE albums SET
    title= '".$albumTitle." ',
    year='".$albumYear." ',
    genre='".$albumGenre." '
WHERE id=".$id;
if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
else { echo 'Record aggiornato con successo!!!';
exit(header('location: http://localhost/BackEnd-S1Project/'));}
}

function getAlbumByID ($id) {
    global $mysqli;
    $sql='SELECT * FROM albums WHERE id='.$id;
    $res= $mysqli->query($sql);
    if($res) {
        $result=$res->fetch_assoc();
    }
return $result;
}

function getAllArtists () {
    global $mysqli;
    $sql='SELECT * FROM artists';
    $res= $mysqli->query($sql);
    if($res) {
        $result= [];
        while ($row=$res->fetch_assoc()) {
            $result[] = $row;
        }
    return $result;
    }  
    
}

function addArtist ($artistName, $artistCountry, $artistAlbumN, $artistGenre, $artistCover) {
    global $mysqli;
    $sql = "INSERT INTO artists (name, country, albumN, genre, cover) 
    VALUES ('$artistName', '$artistCountry', '$artistAlbumN', '$artistGenre', '$artistCover');";
if (!$mysqli->query($sql)) {
echo ($mysqli->connect_error);
} else {
echo 'Record aggiunto con successo!!!';
exit(header('location: http://localhost/BackEnd-S1Project/artists.php'));}
}

function updateArtist($id, $artistName, $artistCountry, $artistAlbumN, $artistGenre) {
    global $mysqli;
    $sql="UPDATE artists SET
                name= '".$artistName." ',
                country='".$artistCountry." ',
                albumN='".$artistAlbumN." ',
                genre='".$artistGenre." '
            WHERE id=".$_REQUEST['id'];
    if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
    else { echo 'Record aggiornato con successo!!!';
    exit(header('location: http://localhost/BackEnd-S1Project/artists.php'));}
}

function deleteArtist($id) {
    global $mysqli;
    $sql='DELETE FROM artists WHERE id='.$_REQUEST['id'];
    if (!$mysqli->query($sql)) {
        echo ($mysqli->connect_error);
        } else {
        echo 'Record eliminato con successo!!!';
        exit(header('Location: http://localhost/BackEnd-S1Project/artists.php'));
        }
}

function getArtistByID ($id) {
    global $mysqli;
    $sql='SELECT * FROM artists WHERE id='.$id;
    $res= $mysqli->query($sql);
    if($res) {
        $result=$res->fetch_assoc();
    }
return $result;
};

function updateCover($table, $id, $cover) {
    echo 'sono dentro la funzione';
    echo $id;
    echo $cover;
    global $mysqli;
    $sql="UPDATE $table SET
                cover='".$cover." '
            WHERE id=".$id;
    if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
    else { echo 'Record aggiornato con successo!!!';};
};

function resetCover ($table, $id) {
    global $mysqli;
    if ($table == 'albums') {
        $sql="UPDATE $table SET cover='uploads/defaultCover.png' WHERE id=".$id;
        if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
        else { echo 'Record aggiornato con successo!!!';
            exit(header('location:http://localhost/BackEnd-S1Project/updateAlbum.php?id='.$id));
        };
    } else if ($table == 'artists') {
        $sql="UPDATE $table SET cover='uploads/artists/defaultArtist.png' WHERE id=".$id;
        if(!$mysqli->query($sql)) { echo($mysqli->connect_error); }
        else { echo 'Record aggiornato con successo!!!';
            exit(header('location:http://localhost/BackEnd-S1Project/updateArtist.php?id='.$id));
        };
    }
}


