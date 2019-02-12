<?php
class Tato {
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function tatoes() {
        $stmt = $this->pdo->prepare("SELECT * FROM tatos");
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            echo '<h1>' . $row['user_id'] . '</h1><p>' . $row['status'] . '</p><div><span class="badge">' . $row['created'].'</span>
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