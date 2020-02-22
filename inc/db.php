<?php

// new pdo instance.
$db = new pdo("mysql:host=localhost;dbname=pay;charset=utf8mb4", "root", "");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>