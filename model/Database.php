<?php

/*
$data = [
    "table" => 'jobs',
    "fields" => [],
    "condition" => [
        ['title', 'web', true],
        ['company', 'tech', true],
        ['location', 'france', true],
    ]
    "values" => ['NULL', 'anass']
];
*/

class Database
{
    protected $db;

    public function __construct() {
        $dsn = 'mysql:host=localhost;user=root;dbname=jobify';
        $this->db = new PDO($dsn);
    }

    public function close () {
        $this->db = NULL;
    }
}
