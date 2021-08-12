<?php

use controllers\SearchController;

require_once "config.php";
require_once "classes/DBConnect.php";
require_once "classes/Search.php";
require_once "controllers/searchController.php";

//require_once "database/db.php";

$isSearch = false;
$search = null;

if (isset($_POST['searchWord'])) {
    $isSearch = true;
    $search = (new SearchController())->Searcher($_POST['searchWord']);
}

require_once 'layout.php';