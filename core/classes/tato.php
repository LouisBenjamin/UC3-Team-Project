<?php
require_once('user.php');

class Tato
{
  /** @var PDO */
  protected $pdo;

  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function postTato($uid, $text) {
    $ins_db = $this->pdo->prepare('INSERT INTO tatos (user_id,status,created) VALUES (:uid,:text,:created)');
    $ins_db->execute(array(
        ':uid' => $uid,
        ':text' => $text,
        ':created' => date("Y-m-d H:i:s", time()),
    ));
  }

  public function showTatoes() {
    // Select all info from tatos table
    $sel_data = $this->pdo->prepare('
SELECT user_id,status,created,t.tato_id,likes_count FROM tatos t ORDER BY created DESC LIMIT 10;
');
    $sel_data->execute();
    $result = $sel_data->fetchAll();
    foreach ($result as $row) {
      $user_data = User::getUserFromId($row['user_id']);
        $stmt = $this->pdo->prepare('
SELECT like_flag FROM tatos t INNER JOIN likes l on t.tato_id = l.tato_id AND t.tato_id= ? AND l.fan_id = ?;
');
        $stmt->execute(array($row['tato_id'],$_SESSION['user_id']));
        $liked = $stmt->fetch(PDO::FETCH_OBJ)->like_flag;
      echo "
                <p><a href=\"profile.php?id={$row['user_id']}\" class=\"username\">{$user_data->username}</a>:</p>
                <p>{$row['status']} </p>
                <div>
                    <script>
                        // Function to update tato like and refresh count
                        function sendLikedTatoId(tato_id, fan_id) {
                            // On button click, call php script to update the likes for tatos
                            $('#tato-like-'+tato_id).load('includes/liketato.php',{ liked_tato_id : tato_id, liker_id : fan_id});
                        }
                    </script>
                    <span class=\"badge\">{$row['created']}</span>
                    <div class=\"center\">
                        <button type=\"button\" id=\"like-btn\" class=\"btn btn-default btn-sm\" onclick=\"sendLikedTatoId({$row['tato_id']},{$_SESSION['user_id']})\">
                            <span class=\"glyphicon glyphicon-thumbs-up\"></span>
                            <!-- To display the number of likes for a tato fetched from table -->
                            <span id=\"tato-like-{$row['tato_id']}\">";
      if($liked)
          echo 'Liked ';
      else echo 'Like ';
      echo "{$row['likes_count']} </span>
                        </button>
                        
                    </div>
                </div>
                <hr />";
    }
  }
}

?>