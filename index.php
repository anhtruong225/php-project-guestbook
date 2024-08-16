<?php
require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ .'/inc/functions.php';

$perPage = 2;
$currentPage = max(1, @(int) ($_GET['page'] ?? 1));


$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROm `entries`');
$stmtCount->execute();

$countTotal = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];


$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `id` DESC LIMIT :offset, :perPage');
$stmt->bindValue('perPage', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', ($currentPage - 1) * $perPage, PDO::PARAM_INT);
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ .'/views/index.view.php';