<?php
// --- Configuration ---
$user     = 'root';
$password = ''; // Empty if no password
$host     = 'localhost';
$db       = 'esurv';
$table    = 'alerts'; // table to dump
$date     = '2025-07-01'; // Optional filter by date
$dumpPath = "backupsql/alerts_table_dump_{$date}.sql";

// Optional WHERE condition (set to "" to dump everything)
$whereClause = "CAST(receivedtime AS DATE)= '$date'";


//$pastDate = date('Y-m-d', strtotime('-15 days'));
//echo $pastDate; die;

// --- Build the mysqldump command ---
if ($password === '') {
    // No password provided
    $cmd = sprintf(
        'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s %s %s --where=%s > %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($db),
        escapeshellarg($table),
        escapeshellarg($whereClause),
        escapeshellarg($dumpPath)
    );
} else {
    // Password provided
    $cmd = sprintf(
        'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s --password=%s %s %s --where=%s > %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($password),
        escapeshellarg($db),
        escapeshellarg($table),
        escapeshellarg($whereClause),
        escapeshellarg($dumpPath)
    );
}

// --- Execute the command ---
exec($cmd, $output, $returnVar);

// --- Output result ---
if ($returnVar === 0 && file_exists($dumpPath) && filesize($dumpPath) > 0) {
    echo "SQL dump created: $dumpPath";
} else {
    echo "Failed to create SQL dump.\n";
    echo "Output:\n" . implode("\n", $output);
}
?>
