<?php

date_default_timezone_set('Asia/Kolkata');
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$yesterdaydate = date('Y-m-d', strtotime('-1 days'));

// --- Configuration ---
$user     = 'root';
$password = ''; // Empty if no password
$host     = 'localhost';
$db       = 'esurv';
$table    = 'alerts'; // table to dump

$dumpPath = "F:\\Prabir\\23serverEsurvDB_Backup\\backupsql/alerts/alerts_table_dump_{$yesterdaydate}.sql";

// Optional WHERE condition (set to "" to dump everything)
$whereClause = "CAST(receivedtime AS DATE)= '$yesterdaydate'";


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
