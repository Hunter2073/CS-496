<!--needs to be able to access the database and pull the first scene from the project id chosen after that, it needs to be able to properly pull the next scene from the option where it is linked-->

<html>
    <?php
        include dirname(__DIR__, 1).'/backend/backendapi/backendapi.php';
        
        $backendapi = new BackendAPI(0);
        $image = $backendapi->databaseapi->getImg();
        $txt = $backendapi->databaseapi->getTxt();
        $options = $backendapi->databaseapi->getOptions();
        
        $image=mysqli_fetch_assoc($image->getResult());
        $txt=mysqli_fetch_assoc($txt->getResult());
    ?>
    <head>
        <link rel="stylesheet" href="../css/mycss.css">
        
    </head>
    <body>
        <div class="play" id="main">
            <div class="play" id="image" style="background-image:url('<?php echo $image['imgDir'] ?>')"></div><br>
            <div class="play" id="text"><?php echo $txt['description']?></div>
            <div class="play" id="options">
                <?php
                    while($row = mysqli_fetch_assoc($options->getResult())){
                        echo "<button>".$row['oText']."</button>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>