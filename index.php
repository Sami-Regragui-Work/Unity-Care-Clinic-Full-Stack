<?php
// index.php
session_start();

$urlStart = "assets/php/";
require_once "{$urlStart}dbLink.php";

// might need this url start
$_SESSION["urlStart"] = $urlStart;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/tw.css" />
    <title>Admin Dashboard - UCC</title>

    <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script type="importmap">
        {
            "imports": {
                "@kurkle/color": "/node_modules/@kurkle/color/dist/color.esm.js"
            }
        }
    </script> -->
    <!-- CRUD logic (generic for all tables) -->
    <script src="assets/js/crud.js" type="module" defer></script>
    <!-- Sidebar navigation + section loading -->
    <script src="assets/js/sidebar.js" type="module" defer></script>
</head>

<body class="bg-[#030712]">
    <div class="flex min-h-screen">
        <?php require "{$urlStart}component/sidebar.php"; ?>

        <main class="body__main w-full transition-all duration-300 flex flex-col">
            <div class="p-4">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <!-- dashboard/tables wrapper -->
                    <article id="dynamic-content" class="content rounded-lg overflow-hidden">
                        <!-- updated by AJAX -->
                    </article>
                </div>
            </div>
        </main>

        <!-- modal wrapper -->
        <article id="hidden-modal">
            <!-- updated by AJAX if needed -->
        </article>
    </div>
</body>

</html>
<?php
$dbLink->close();
?>