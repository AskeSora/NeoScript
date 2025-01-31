
<?php 
    include 'includes/shopHeader.php';


    if (file_exists($page)){
        include_once $page;
    } else {
        include_once 'pages/404.php';
    }


    include 'includes/shopFooter.php';
