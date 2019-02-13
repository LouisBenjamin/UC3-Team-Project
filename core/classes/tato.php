<?php
class Tato {
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function postTato($uid,$text) {
        $ins_db = $this->pdo->prepare("INSERT INTO tatos (user_id,status,created) VALUES (:uid,:text,:created)");
        $user = 
        $ins_db->execute(array(
            ':uid' => $uid,
            ':text' => $text,
            ':created' => date("Y-m-d H:i:s", time())
        ));
    }

    public function showTatoes() {
        $sel_data = $this->pdo->prepare("SELECT * FROM tatos");
        $sel_data->execute();
        $result = $sel_data->fetchAll();

        foreach ($result as $row) {
            echo '<p>' . $row['user_id'].':'. '</p><p>' . $row['status'] . '</p><div><span class="badge">' . $row['created'].'</span>
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