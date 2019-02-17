<?php
class Tato {
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function postTato($uid,$text) {
        $ins_db = $this->pdo->prepare("INSERT INTO tatos (user_id,status,created) VALUES (:uid,:text,:created)");
        $ins_db->execute(array(
            ':uid' => $uid,
            ':text' => $text,
            ':created' => date("Y-m-d H:i:s", time()),
        ));
    }

    function getUnameFromUid($uid){
        $sel_user = $this->pdo->prepare("SELECT username FROM users WHERE user_id = ? limit 1");
        $sel_user->execute(array($uid));
        return $sel_user->fetch(PDO::FETCH_OBJ)->username;
    }

    public function showTatoes() {
        $sel_data = $this->pdo->prepare("SELECT * FROM tatos ORDER BY created DESC");
        $sel_data->execute();
        $result = $sel_data->fetchAll();

        foreach ($result as $row) {
            $uname = $this->getUnameFromUid($row['user_id']);
            echo '<p>' . $uname .':'. '</p><p>' . $row['status'] . '</p><div><span class="badge">' . $row['created'].'</span>
            <div class="center">
                <button type="button" class="btn btn-default btn-sm">
                	<span class="glyphicon glyphicon-thumbs-up"></span> Like
              	</button>
		    </div>
		    <div class="pull-right">
                        <span class="label label-default">category</span>
                        <span class="label label-primary">category</span>
                        <span class="label label-success">category</span>
                        <span class="label label-info">category</span>
                        <span class="label label-warning">category</span>
                        <span class="label label-danger">category</span>
                    </div>
		</div>
                <hr>';
        }
    }
}
?>
