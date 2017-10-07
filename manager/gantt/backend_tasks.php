<?php
require_once('_db.php');

class Task {}

$result = tasklist($pdo, db_get_tasks(1));

header('Content-Type: application/json');
echo json_encode($result);

function tasklist($pdo, $items) {
    $result = array();

    foreach($items as $item) {
      $r = new Task();

      // rows
      $r->id = $item['id'];
      $r->text = htmlspecialchars($item['name']);
      $r->start = $item['start'];
      $r->end = $item['end'];
      $r->complete = $item['complete'];
      if ($item['milestone']) {
          $r->type = 'Milestone';
      }

      $project = $r->id;

      $children = db_get_tasks($project);

      if (!empty($children)) {
          $r->children = tasklist($pdo, $children);
      }

      $result[] = $r;
    }
    return $result;
}
?>
