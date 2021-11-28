<?php
require 'DBConnection.php';
$db = new DBConnection('test', 'trello_analyzer_db');

$teams = $db->GetColumns('teams', ['id', 'name']);

$team_info = (array_key_exists('team_id', $_POST)) ? $db->GetRow('teams', 'id', $_POST['team_id'])[0] :
    ['id' => -1, 'name' => 'Команда не найдена :(', 'topic' => 'Возможно, допущена ошибка в написании названия команды', 'url' => ''];
$members = (array_key_exists('team_id', $_POST)) ? $db->GetRow('users', 'team_id', $_POST['team_id']) : [];


require 'content.php';

?>