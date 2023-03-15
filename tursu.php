<?php

function get_names($file){
    $names =  preg_split('/\r\n|\r|\n/', file_get_contents($file['tmp_name']));
    return $names;
}

function get_directories(){
    $dir = getcwd();
    $dirs = explode('/', $dir);
    $dirs_main = [];
    $s = '';
    for($n = 0; $n < count($dirs); $n++){
        $s .= $dirs[$n] . '/';
        array_push($dirs_main, $s);
    }

    return $dirs_main;
}

function start($names, $dirs){
    foreach($dirs as $dir){
        foreach($names as $name){
            $path = $dir . $name;
            if(file_exists($path)){
                echo $path . " EXISTS!!!" . "<br>";
            }else{
                echo $path . " error" . "<br>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Path Finder</title>
</head>
<body>
    <h3>How to use?</h3>
    <p>Add a .txt file for better use.</p>
    <p>Inside should be like:</p>
    <p>Name1<br>Name2<br>Name3<br></p>
    <p>...And so on.</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Start" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $file = $_FILES['file'];
            $names = get_names($file);
            $dirs = get_directories();
            echo "<br>";
            start($names, $dirs);
        }
    ?>
</body>
</html>
