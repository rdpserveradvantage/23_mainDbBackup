<?php
// --- Configuration ---
$user     = 'root';
$password = ''; // Empty if no password
$host     = 'localhost';
$db       = 'esurv';
$table    = 'alerts'; // table to dump
$date     = '2022-12-30'; // Optional filter by date
//$sqlFile = "backupsql/network_history_table_dump_{$date}.sql";
$sqlFile = "backupsql/alerts.sql";

// Check if dump file exists
if (!file_exists($sqlFile)) {
    die("SQL file not found: $sqlFile\n");
}

// Build the mysql command
// Note: for empty password, omit -p flag entirely, else use --password=
// Also include host with -h flag
if ($password === '') {
    $cmd = sprintf(
        'C:\\xampp\\mysql\\bin\\mysql.exe -h %s -u %s %s < %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($db),
        escapeshellarg($sqlFile)
    );
} else {
    $cmd = sprintf(
        'C:\\xampp\\mysql\\bin\\mysql.exe -h %s -u %s --password=%s %s < %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($password),
        escapeshellarg($db),
        escapeshellarg($sqlFile)
    );
}

// Run the command
exec($cmd, $output, $returnVar);

// Output result
if ($returnVar === 0) {
    echo "Database restored successfully from $sqlFile\n";
} else {
    echo "Restore failed with code $returnVar\n";
    echo "Output:\n" . implode("\n", $output) . "\n";
}

