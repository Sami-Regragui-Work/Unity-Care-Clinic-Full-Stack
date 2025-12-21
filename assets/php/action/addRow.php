<?php
session_start();
require_once __DIR__ . "/../dbLink.php";

$allowedTables = ["patients", "doctors", "departments"];

$table = htmlspecialchars($_POST["table"] ?? "", ENT_QUOTES, "UTF-8");
if (!in_array($table, $allowedTables, true)) {
    http_response_code(400);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        "row" => "",
        "error" => "Invalid table",
    ]);
    exit;
}

$searchableCols = $_SESSION[$table]['searchableCols'];
$insertFieldsArr = array_slice($searchableCols, 1);

$rowValues = array_map(fn($field) => htmlspecialchars(trim($_POST[$field] ?? ''), ENT_QUOTES, "UTF-8"), $insertFieldsArr);

$placeHoldersStr = implode(", ", array_fill(0, count($insertFieldsArr), '?'));
$insertFieldsStr = implode(", ", $insertFieldsArr);

$rowPrep = <<<SQL
INSERT INTO {$table} ({$insertFieldsStr})
VALUES ({$placeHoldersStr})
SQL;
$rowStmt = $dbLink->prepare($rowPrep);

if ($rowStmt) {
    $rowTypes = str_repeat("s", count($insertFieldsArr));
    $rowStmt->bind_param($rowTypes, ...$rowValues);
    if ($rowStmt->execute()) {
        $rowId = (int)$rowStmt->insert_id;
    }
    $rowStmt->close();
}

array_unshift($rowValues, (string)$rowId);

ob_start();
?>
<tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
    <?php foreach ($rowValues as $value): ?>
        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
            <?= (string)($value ?? '') ?>
        </td>
    <?php endforeach; ?>

    <td class="px-4 py-3 whitespace-nowrap text-right text-xs font-medium space-x-2">
        <?php $id = (int)($rowValues[0] ?? 0); ?>
        <button
            type="button"
            class="inline-flex items-center rounded-md bg-blue-500 px-3 py-2 text-xs font-medium text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-900"
            data-role="table-edit"
            data-table="<?= $table ?>"
            data-id="<?= $id ?>">
            Edit
        </button>
        <button
            type="button"
            class="inline-flex items-center rounded-md border border-red-300 bg-white px-2 py-1 text-xs font-medium text-red-700 hover:bg-red-50 dark:border-red-700 dark:bg-gray-900 dark:text-red-300 dark:hover:bg-red-950"
            data-role="table-delete"
            data-table="<?= $table ?>"
            data-id="<?= $id ?>">
            Delete
        </button>
    </td>
</tr>
<?php
$rowHtml = ob_get_clean();

header("Content-Type: application/json; charset=utf-8");
echo json_encode([
    "row"   => $rowHtml,
    "error" => "",
]);
