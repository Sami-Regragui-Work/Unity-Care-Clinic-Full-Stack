<?php
session_start();
require_once __DIR__ . "/../dbLink.php";

$tables = ['patients', 'doctors', 'departments'];
$rowsNum = [];

foreach ($tables as $table) {
    $query = <<<SQL
    SELECT COUNT(*) AS rowsNum
    FROM {$table}
    SQL;

    $res = $dbLink->query($query);
    $row = $res ? $res->fetch_assoc() : ['rowsNum' => 0];
    $rowsNum[$table] = (int)$row['rowsNum'];
    if ($res) $res->free();
}

ob_start();
?>
<section id="dashboard" class="p-4 space-y-6"
    data-patients="<?= $rowsNum['patients'] ?>"
    data-doctors="<?= $rowsNum['doctors'] ?>"
    data-departments="<?= $rowsNum['departments'] ?>">
    <header>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Dashboard
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Overview of rows per table.
        </p>
    </header>

    <div class="grid gap-4 sm:grid-cols-3 [&>div]:overflow-hidden">
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Patients</h2>
            <p class="mt-2 text-2xl font-semibold text-gray-900 dark:text-[#3b82f6]">
                <?= $rowsNum['patients'] ?>
            </p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Doctors</h2>
            <p class="mt-2 text-2xl font-semibold text-gray-900 dark:text-[#22c55e]">
                <?= $rowsNum['doctors'] ?>
            </p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Departments</h2>
            <p class="mt-2 text-2xl font-semibold text-gray-900 dark:text-[#eab308]">
                <?= $rowsNum['departments'] ?>
            </p>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="mb-4 text-sm font-medium text-gray-500 dark:text-gray-400">
            Rows per table
        </h2>
        <canvas id="chart" height="120"></canvas>
    </div>
</section>
<?php
$content = ob_get_clean();

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'content' => $content,
    'modal'   => null,
]);
