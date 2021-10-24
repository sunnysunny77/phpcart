<?php

$root = $_SERVER["DOCUMENT_ROOT"];

if(isset($_GET["image_id"])) {

    include_once $root . "/includes/db.inc.php";
    
    try { 
        $sql = "SELECT filename, mimetype, filedata
                FROM files INNER JOIN mimetypes ON mimetypes.mimetype_id = files.mimetype_id
                WHERE file_id= :file_id";
         $s = $pdo->prepare($sql);
         $s->bindValue(":file_id", $_GET["image_id"]);
         $s->execute();
    }
    catch (PDOException $e) {
        http_response_code(500);
        exit();
    }
    
    $file = $s->fetch();
    if (!$file) {
        http_response_code(404);
        exit();
    }
    
    $filename = $file["filename"];
    $mimetype = $file["mimetype"];
    $filedata = $file["filedata"];
    $disposition = "inline";
    
    header("Content-length: " . strlen($filedata));
    header("Content-type: $mimetype");
    header("Content-disposition: $disposition; filename=$filename");
    
    echo $filedata;
    exit();
  }

?>