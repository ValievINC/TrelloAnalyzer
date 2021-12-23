<?php
require_once 'DBConnection.php';
require_once 'update_db.php';
$db = new DBConnection('trelloanalyzer', 'trello_analyzer_db');

$teams = $db->GetColumns('teams', ['id', 'team_name']);

$tn = (array_key_exists('team_name', $_POST)) ? $_POST['team_name'] : '';

$team_info = $tn ? $db->GetRow('teams', 'team_name', "'".$tn."'")[0] :
    ['id' => -1, 'team_name' => 'Команда не найдена :(', 'topic' => 'Возможно, допущена ошибка в написании названия команды', 'url' => ''];

$members = ($team_info['id'] == -1) ? [] : $db->GetRow('users', 'team_id', $team_info['id']);


require 'content.html';

?>