<?php
require __DIR__ . '/vendor/autoload.php';

function getValues($range, $spreadsheetId)
{
// Наш ключ доступа к сервисному аккаунту
    $googleAccountKeyFilePath = __DIR__ . '/key.json';
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

// Создаем новый клиент
    $client = new Google_Client();
// Устанавливаем полномочия
    $client->useApplicationDefaultCredentials();

// Добавляем область доступа к чтению, редактированию, созданию и удалению таблиц
    $client->addScope('https://www.googleapis.com/auth/spreadsheets');

    $service = new Google_Service_Sheets($client);

// ID таблицы
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    return $response->getValues();
}