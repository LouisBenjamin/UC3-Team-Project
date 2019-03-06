<?php

require_once __DIR__.'/../core/init.php';

/** @var PDO $pdo */
$pdo = Dbh::getInstance()->dbh;

$idol_id = $_POST['idol_id'] ?? '';
$fan_id = $_POST['fan_id'] ?? '';

//UPDATE FOLLOW FLAG
$query = 'INSERT INTO `follows` (`idol_id`, `fan_id`, `f_flag`) VALUES (:idol_id, :fan_id, 1)
ON DUPLICATE KEY UPDATE f_flag=NOT f_flag;';
$stmt = $pdo->prepare($query);
$stmt->execute(array(
    ':idol_id' => $idol_id,
    ':fan_id' => $fan_id));

//RETRIEVE FOLLOW FLAG
$stmt = $pdo->prepare('SELECT f_flag
FROM follows WHERE fan_id = :fan_id AND idol_id = :idol_id
LIMIT 1');
$stmt->execute(array(
    ':idol_id' => $idol_id,
    ':fan_id' => $fan_id));
$res = $stmt->fetch(PDO::FETCH_ASSOC)['f_flag'];

//UPDATE FOLLOW COUNT BASED ON FLAG (?)
if($res) echo 'Followed';
else echo 'Follow';