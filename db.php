<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$env = getenv('ENV');

if(!$env || $env === 'dev') {
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '/.env');
}

$db = new mysqli(
    getenv('DB_HOST'), 
    getenv('DB_USER'), 
    getenv('DB_PASSWORD'), 
    getenv('DB_NAME'), 
    getenv('DB_PORT')
);

if($db->connect_errno) {
    throw new Exception($db->connect_error);
}

$db->query('CREATE TABLE IF NOT EXISTS `team`(
    team_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    team_name VARCHAR(255)
    )'
);
$db->query('CREATE TABLE IF NOT EXISTS `player`(
    player_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    last_name VARCHAR(255),
    first_name VARCHAR(255),
    team INT FOREIGN KEY REFERENCES team(team_id)
    )'
);
$db->query('CREATE TABLE IF NOT EXISTS `match`(
    match_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    team_one INT FOREIGN KEY REFERENCES team(team_id),
    team_two INT FOREIGN KEY REFERENCES team(team_id),
    score_one INT,
    score_two INT
    )'
);
$db->query('CREATE TABLE IF NOT EXISTS `tournament`(
    tournament_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tournament_name VARCHAR(255)
    )'
);

if ($db->errno) {
    throw new Exception($db->error);
}