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
    $sel_data = $this->pdo->prepare('SELECT user_id,status,created,tato_id,likes_count FROM tatos ORDER BY created DESC LIMIT 10');

    $sel_data->execute();
    $result = $sel_data->fetchAll();
    foreach ($result as $row) {
      $user_data = User::getUserFromId($row['user_id']);
      echo "
                <p><a href=\"profile.php?id={$row['user_id']}\" class=\"username\">{$user_data->username}</a>:</p>
                <p>{$row['status']} </p>
                <div>
                    <script>
                        // Function to update tato like and refresh page
                        function sendLikedTatoId(tato_id) {
                            // On button click, call php script to update the likes for tatos
                            $.ajax({
                                url: \"home.php\",
                                type:\"post\",
                                data:{ liked_tato_id : tato_id },                                
                                // On success, refresh page
                                success: function(){
                                    window.location.reload();
                                }
                            });
                        }
                    </script>
                    <span class=\"badge\">{$row['created']}</span>
                    <div class=\"center\">
                        <button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"sendLikedTatoId({$row['tato_id']})\">
                            <span class=\"glyphicon glyphicon-thumbs-up\"></span> Like
                            <!-- To display the number of likes for a tato fetched from table -->
                            <span class=\"tatolikecount\"> {$row['likes_count']} </span>
                        </button>
                        
                    </div>
                    <div class=\"pull-right\">
                        <span class=\"label label-default\">category</span>
                        <span class=\"label label-primary\">category</span>
                        <span class=\"label label-success\">category</span>
                        <span class=\"label label-info\">category</span>
                        <span class=\"label label-warning\">category</span>
                        <span class=\"label label-danger\">category</span>
                    </div>
                </div>
                <hr />";
    }
  }
}

?>