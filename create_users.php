<?php
    require_once 'dbconnection.php';
    $conn = DBConnection::instantiate();
    $coll = $conn->getCollection('users');

    $users = [
        [
            'name' => 'Luke Skywalker',
            'username' => 'jedimaster23',
            'password' => md5('usetheforce'),
            'birthday' => new MongoDB\BSON\UTCDateTime(strtotime('1971-09-29 00:00:00')),
            'address' => [
                'town' => 'Mos Eisley',
                'planet' => 'Tatooine'
            ]
        ],
        [
            'name' => 'Leia Organa',
            'username' => 'princessleia',
            'password' => md5('eviltween'),
            'birthday' => new MongoDB\BSON\UTCDateTime(strtotime('1976-10-21 00:00:00')),
            'address' => [
                'town' => 'Aldera',
                'planet' => 'Alderaan'
            ]
        ],
        [
            'name' => 'Chewbacca',
            'username' => 'chewiethegreat',
            'password' => md5('loudgrowl'),
            'birthday' => new MongoDB\BSON\UTCDateTime(strtotime('1974-05-19 00:00:00')),
            'address' => [
                'town' => 'Kachiro',
                'planet' => 'Kashyyk'
            ]
        ]
    ];

    $coll->insertmany($users);

    echo "Users created successfully";
?>