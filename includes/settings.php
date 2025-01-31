<?php

$pagename = $_GET['page'] ?? $_POST['page'] ?? 'home';
$page = "pages/$pagename.php";
