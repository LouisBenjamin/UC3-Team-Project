<?php

require_once __DIR__.'/../core/init.php';



/** @var PDO $pdo */
$pdo = Dbh::getInstance()->dbh;

$tato_id = $_POST['liked_tato_id'] ?? '';

$fan_id = $_POST['liker_id'] ?? '';

//UPDATE LIKE_FLAG
$query = '
INSERT INTO `likes` (`tato_id`, `fan_id`, `like_flag`) VALUES (?, ?, 1)
ON DUPLICATE KEY UPDATE like_flag=NOT like_flag;
';
$stmt = $pdo->prepare($query);
$stmt->execute(array($tato_id,$fan_id));

//UPDATE LIKE COUNT BASED ON FLAG
$query = 'UPDATE `tatos`
  INNER JOIN `likes` on `tatos`.tato_id = `likes`.tato_id
SET likes_count =
      CASE
        WHEN like_flag = 1
          THEN likes_count + 1
        ELSE likes_count - 1
        END
WHERE `tatos`.tato_id = ?';
$stmt = $pdo->prepare($query);
$stmt->execute(array($tato_id));

//RETRIEVE LIKE INFO
$stmt = $pdo->prepare('
SELECT `tatos`.likes_count, `likes`.like_flag
FROM tatos INNER JOIN `likes` ON `tatos`.tato_id = `likes`.tato_id
WHERE `tatos`.tato_id = ?
LIMIT 1');
$stmt->execute(array($tato_id));
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res['like_flag']) echo '<img src="assets/images/unlike.png" alt="unlike" width="30px">';
else echo '<img src="assets/images/like.png" alt="like" width="30px">';
echo $res['likes_count'];