<?php
class Tato {
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function postTato($uid,$text) {
        $stmt = $this->pdo->prepare("INSERT INTO tatos (user_id,status) VALUES (:uid,:text)");
        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":text", $text);
        $stmt->execute();
    }

    public function showTatoes() {
        $stmt = $this->pdo->prepare("SELECT * FROM tatos");
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            echo '<h1>' . $row['user_id'] . '</h1><p>' . $row['status'] . '</p><div><span class="badge">' . $row['created'].'</span>
                   <div class="pull-right">
                   
                   <button type="button" class="btn btn-default btn-sm">
                   <span class="glyphicon glyphicon-thumbs-up"></span> Like
                   </button> 
                   
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
