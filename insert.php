<?php

function insertContact($request)
{

    require 'db_connection.php';

    $params = [
        'id' => null,
        'name' => $request['name'],
        'email' => $request['email'],
        'contact' => $request['contact'],
        'created_at' => null,
    ];

    $count = 0;
    $columns = '';
    $values = '';

    foreach (array_keys($params) as $key) {
        if ($count++> 0) {
            $columns .= ',';
            $values .= ',';
        }
        $columns .= $key;
        $values .= ':' . $key;
    }

    $sql = 'insert into contacts (' . $columns . ')values(' . $values . ')';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}
