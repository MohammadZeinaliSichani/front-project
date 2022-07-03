<?php
 
$table = "articles";
$mysqli = new mysqli("localhost", "root", "", "posts");
$mysqli->set_charset("utf8");
$stmt = $mysqli->stmt_init();
 
function get_posts($id = false) {
    global $table;
    global $mysqli;
    global $stmt;
 
    $where_statment = "";
    $rows = [];
 
    if (!empty($id)) {
        if (is_row_exits($id)) {
            $where_statment = "WHERE id=?";
        }else
         return $rows;
    }
 
    $query = "SELECT * FROM `{$table}` {$where_statment} ORDER BY id DESC";
 
    $stmt->prepare($query);
 
    if (!empty($where_statment)) {
        $stmt->bind_param("i", $id);
    }
 
    if ($stmt->execute() && $res = $stmt->get_result()) {
        if ($stmt->affected_rows || $res->num_rows) {
            while ($row_loop = $res->fetch_assoc()) {
                $rows[] = $row_loop;
            }
        }
    }
 
    return $rows;
}
 
function is_row_exits($id) {
 
    global $table;
    global $mysqli;
    global $stmt;
 
    $query = "SELECT id FROM {$table} WHERE id=?";
 
    $stmt->prepare($query);
 
    $stmt->bind_param('i', $id);
 
    $is_found = 0;
 
    if ($stmt->execute() && $stmt->store_result()) {
        $is_found = $stmt->affected_rows;
        $stmt->free_result();
    }
 
    return $is_found;
}
 
function like_post($post_id, $state) {
 
    global $table;
    global $mysqli;
    global $stmt;
 
    $row_updated = false;
 
    $operation = "";
 
    if ($state == "+" OR $state == "-") {
        $operation = $state;
    }
 
    $query = "UPDATE {$table} SET post_like = post_like {$operation} 1 WHERE id=?";
 
    $stmt->prepare($query);
 
    $stmt->bind_param('i', $post_id);
 
    if ($stmt->execute()) {
        $row_updated = $stmt->affected_rows ? $stmt->affected_rows : 1;
    }
 
    return $row_updated;
}
 
?>