<?php
    require_once('../../core/init.php');
    function db_get_max_ordinal($project) {
        global $pdo;
        $str = "SELECT max(ordinal) FROM task WHERE project_id = :project";
        if ($project == null) {
            $str = str_replace("= :project", "is null", $str);
            $stmt = $pdo->prepare($str);
        }
        else {
            $stmt = $pdo->prepare($str);
            $stmt->bindParam(":project", $project);
        }
        $stmt->execute();
        return $stmt->fetchColumn(0) ?: 0;
    }

    function db_get_task($id) {
        global $pdo;

        $str = "SELECT * FROM task WHERE id = :id";
        $stmt = $pdo->prepare($str);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    function db_update_task_project($id, $project, $ordinal) {
        global $pdo;

        $now = (new DateTime("now"))->format('Y-m-d H:i:s');

        $str = "UPDATE task SET project_id = :project, ordinal = :ordinal, ordinal_priority = :priority WHERE id = :id";
        $stmt = $pdo->prepare($str);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":project", $project);
        $stmt->bindParam(":ordinal", $ordinal);
        $stmt->bindParam(":priority", $now);
        $stmt->execute();
    }

    function db_compact_ordinals($project) {
        $children = db_get_tasks($project);
        $size = count($children);
        for ($i = 0; $i < $size; $i++) {
            $row = $children[$i];
            db_update_task_ordinal($row["id"], $i);
        }
    }

    function db_update_task_ordinal($id, $ordinal) {
        global $pdo;

        $now = (new DateTime("now"))->format('Y-m-d H:i:s');

        $str = "UPDATE task SET ordinal = :ordinal, ordinal_priority = :priority WHERE id = :id";
        $stmt = $pdo->prepare($str);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ordinal", $ordinal);
        $stmt->bindParam(":priority", $now);
        $stmt->execute();
    }

    function db_update_task($id, $start, $end) {
        global $pdo;

        $str = "UPDATE task SET start = :start, end = :end WHERE id = :id";
        $stmt = $pdo->prepare($str);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":start", $start);
        $stmt->bindParam(":end", $end);
        $stmt->execute();
    }

    function db_update_task_full($id, $start, $end, $name, $complete, $milestone) {
        global $pdo;

        $str = "UPDATE task SET start = :start, end = :end, name = :name, complete = :complete, milestone = :milestone WHERE id = :id";
        $stmt = $pdo->prepare($str);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":start", $start);
        $stmt->bindParam(":end", $end);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":complete", $complete);
        $stmt->bindParam(":milestone", $milestone);
        $stmt->execute();
    }

    function db_get_tasks($project) {
        global $pdo;

        $str = 'SELECT * FROM task WHERE project_id = :project ORDER BY ordinal, ordinal_priority desc';
        if ($project == null) {
            $str = str_replace("= :project", "is null", $str);
            $stmt = $pdo->prepare($str);
        }
        else {
            $stmt = $pdo->prepare($str);
            $stmt->bindParam(':project', $project);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
