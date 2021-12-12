<?php
require_once 'DBConnection.php';
require_once 'quickstart.php';

$db = new DBConnection('trelloanalyzer', 'trello_analyzer_db');

$values = getValues();
$converter = json_decode(file_get_contents('question_to_dbcolumn_config.json'), true);

$title = array_shift($values);

$users = array();

foreach ($values as $row) {
    if (!$row){
        continue;
    }
    $data = array();
    for ($i = 0; $i < count($row); $i++) {
        if (array_key_exists($title[$i], $converter['teams'])) {
            $data[$converter['teams'][$title[$i]]] = $row[$i];
        }
        if (array_key_exists($title[$i], $converter['users'])) {
            $data[$converter['users'][$title[$i]]] = $row[$i];
        }
    }
    $fn = $data['first_name'] ?? '';
    $ln = $data['last_name'] ?? '';
    $role = $data['role'] ?? '';
    $url = $data['url'] ?? '';
    $team = $db->GetRow('teams', 'url', "'$url'")[0];
    if (!$team) {
        $tn = $data['name'] ?? '';
        $topic = $data['topic'] ?? '';
        $db->Query("INSERT INTO teams VALUES (NULL, '$tn', '$topic', '$url')");
        $team = $db->GetRow('teams', 'url', "'$url'")[0];
    }
    $users[] = array(
        "first_name" => $fn,
        "last_name" => $ln,
        "team_id" => $team['id'],
        "role" => $role
    );
}
$ids_t = $db->GetColumns('teams', array('id'));
$ids_u = $db->GetColumns('users', array('id'));

for ($i = 0; $i < count($ids_u) && $i < count($users); $i++) {
    $fn = $users[$i]['first_name'];
    $ln = $users[$i]['last_name'];
    $ti = $users[$i]['team_id'];
    $role = $users[$i]['role'];
    $id = $ids_u[$i]['id'];
    $query = "UPDATE users SET first_name='$fn', last_name='$ln', team_id=$ti, role='$role' WHERE id=$id";
    $db->Query($query);
}

for ($i = count($users); $i < count($ids_u); $i++) {
    $id = $ids_u[$i]['id'];
    $query = "DELETE FROM users WHERE id=$id";
    $db->Query($query);
}

for ($i = count($ids_u); $i < count($users); $i++) {
    $fn = $users[$i]['first_name'];
    $ln = $users[$i]['last_name'];
    $ti = $users[$i]['team_id'];
    $role = $users[$i]['role'];
    $query = "INSERT INTO users VALUES (NULL, '$fn', '$ln', $ti, '$role')";
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
