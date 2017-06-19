<?php

    require("param.inc.php");

    if (isset($_SESSION["pseudoCo"])) {
        echo 'ENFIN TROP COOOOOOL - ';
        echo $_SESSION["pseudoCo"];
    }
    

?>