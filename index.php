<?php

require_once 'QueryBuilder.php'; 

QueryBuilder::$table = 'users';
$result = QueryBuilder::all(); 

print_r($result); 
