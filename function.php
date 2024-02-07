<?php 

function getAllAlbum () {
    global $mysqli;
    $sql='SELECT * FROM albums';
    $res= $mysqli->query($sql);
    if($res) {
        while ($row=$res->fetch_assoc()) {
            $result[] = $row;
        }
    return $result;
    }
    
}

function addAlbum ($albumTitle, $albumArtist, $albumYear, $albumGenre, $albumCover) {
    global $mysqli;
    $sql = "INSERT INTO albums (title, artist, year, genre, cover) 
    VALUES ('$albumTitle', '$albumArtist', '$albumYear', '$albumGenre', '$albumCover');";
if (!$mysqli->query($sql)) {
echo ($mysqli->connect_error);
} else {
echo 'Record aggiunto con successo!!!';
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


function getAlbumByID ($id) {
    global $mysqli;
    $sql='SELECT * FROM albums WHERE id='.$id;
    $res= $mysqli->query($sql);
    if($res) {
        $result=$res->fetch_assoc();
    }
return $result;
}