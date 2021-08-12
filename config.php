<?php
$url = parse_url(getenv('CLEARDB_DATABASE_URL'));

$server = $url['host'] ?? 'localhost';
$username = $url['user'] ?? 'admin';
$password = $url['pass'] ?? 'password';
$db = $url['path'] ? substr($url['path'], 1) : 'test_posts_db';

define('HOST', $server);
define('USER', $username);
define('PAS', $password);
define('DB', $db);