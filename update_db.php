<?php
require_once 'DBConnection.php';
require_once 'quickstart.php';

function GetBiggestSubarrayLength(array $a) {
    return max(array_map(function ($item) { return count($item); }, $a));
}

function GetDataFromRow($row, $title, $converter): array
{
    $data = array();
    for ($i = 0; $i < count($row); $i++) {
        if (array_key_exists($title[$i], $converter['teams'])) {
            $data[$converter['teams'][$title[$i]]][] = $row[$i];
        }
        if (array_key_exists($title[$i], $converter['users'])) {
            $data[$converter['users'][$title[$i]]][] = $row[$i];
        }
    }
    return $data;
}

function GetTeam($data, $db) {
    $url = $data['url'][0] ?? '';
    $team = $db->GetRow('teams', 'url', "'$url'");
    if (!$team) {
        $tn = $data['team_name'][0] ?? '';
        $topic = $data['topic'][0] ?? '';
        $db->Query("INSERT INTO teams VALUES (NULL, '$tn', '$topic', '$url')");
        $team = $db->GetRow('teams', 'url', "'$url'")[0];
    }
    else {
        $team = $team[0];
    }
    return $team;
}

$db = new DBConnection('trelloanalyzer', 'trello_analyzer_db');

$config = json_decode(file_get_contents('config.json'), true);
$values = getValues($config['range'], $config['sheet_id']);
$title = array_shift($values);
$users = array();

foreach ($values as $row) {
    if (!$row){
        continue;
    }

    $data = GetDataFromRow($row, $title, $config);
    $team = GetTeam($data, $db);

    $repeats = GetBiggestSubarrayLength($data);
    for($i = 0; $i < $repeats; $i++) {
        if (!isset($data['name'][$i])) {
            continue;
        }
        $role = $data['role'][$i] ?? '';
        $users[] = array(
            "name" => $data['name'][$i],
            "team_id" => $team['id'],
            "role" => $role
        );
    }
}
$ids_t = $db->GetColumns('teams', array('id'));
$ids_u = $db->GetColumns('users', array('id'));

for ($i = 0; $i < count($ids_u) && $i < count($users); $i++) {
    $name = $users[$i]['name'];
    $ti = $users[$i]['team_id'];
    $role = $users[$i]['role'];
    $id = $ids_u[$i]['id'];
    $query = "UPDATE users SET name='$name', team_id=$ti, role='$role' WHERE id=$id";

    $db->Query($query);
}

for ($i = count($users); $i < count($ids_u); $i++) {
    $id = $ids_u[$i]['id'];
    $query = "DELETE FROM users WHERE id=$id";
    $db->Query($query);
}

for ($i = count($ids_u); $i < count($users); $i++) {
    $name = $users[$i]['name'];
    $ti = $users[$i]['team_id'];
    $role = $users[$i]['role'];
    $query = "INSERT INTO users VALUES (NULL, '$name', $ti, '$role')";
    $db->Query($query);
}

$user_ti = $db->GetColumns('users', array('team_id'));

foreach ($ids_t as $id) {
    $del = true;
    foreach ($user_ti as $team_id) {
        if ($team_id['team_id'] == $id['id']) {
            $del = false;
        }
    }
    if (!$del){
        continue;
    }
    $del_id = $id['id'];
    $query = "DELETE FROM teams WHERE id=$del_id";
    $db->Query($query);
}
