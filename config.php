<?php

//Разработка
// define('HOST', 'localhost');
// define('USER', 'root');
// define('PAS', 'root');
// define('DB', 'test_posts_db');

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

define('HOST', $server);
define('USER', $username);
define('PAS', $password);
define('DB', $db);
