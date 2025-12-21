<?php
session_start();
require_once __DIR__ . "/../dbLink.php";

$allowedTables = ["patients", "doctors", "departments"];

$table = htmlspecialchars($_POST["table"] ?? "", ENT_QUOTES, "UTF-8");
if (!in_array($table, $allowedTables, true)) {
    http_response_code(400);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        "success" => false,
        "error"   => "Invalid table",
    ]);
    exit;
}

$searchableCols = $_SESSION[$table]['searchableCols'];


$idName = $searchableCols[0];

$updateFieldsArr = array_slice($searchableCols, 1);

$rowId = (int)($_POST[$idName] ?? 0);

$rowValues = array_map(
    fn($field) => htmlspecialchars(trim($_POST[$field] ?? ''), ENT_QUOTES, "UTF-8"),
    $updateFieldsArr
);

$setParts = array_map(fn($col) => "{$col} = ?", $updateFieldsArr);
$setStr   = implode(", ", $setParts);

$rowPrep = <<<SQL
UPDATE {$table}
SET {$setStr}
WHERE {$idName} = ?
SQL;

$rowStmt = $dbLink->prepare($rowPrep);

if ($rowStmt) {
    $rowTypes = str_repeat("s", count($updateFieldsArr)) . "i";
    $bindVals = [...$rowValues, $rowId];

    $rowStmt->bind_param($rowTypes, ...$bindVals);
    $rowStmt->execute();
    $affected = $rowStmt->affected_rows;
    $rowStmt->close();
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode([
    "success"  => true,
    "affected" => $affected ?? 0,
    "error"    => "",
]);
