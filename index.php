<?php
require_once 'DBConnection.php';
require_once 'update_db.php';
$db = new DBConnection('trelloanalyzer', 'trello_analyzer_db');

$teams = $db->GetColumns('teams', ['id', 'team_name']);

print_r($_POST);

$team_info = (array_key_exists('team_id', $_POST)) ? $db->GetRow('teams', 'id', $_POST['team_id'])[0] :
    ['id' => -1, 'team_name' => 'Команда не найдена :(', 'topic' => 'Возможно, допущена ошибка в написании названия команды', 'url' => ''];
$members = (array_key_exists('team_id', $_POST)) ? $db->GetRow('users', 'team_id', $_POST['team_id']) : [];


require 'content.html';

?>