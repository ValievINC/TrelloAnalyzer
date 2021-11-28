<?php
require 'DBConnection.php';
$db = new DBConnection('test', 'trello_analyzer_db');

$teams = $db->GetColumns('teams', ['id', 'name']);

require 'content.html';

?>