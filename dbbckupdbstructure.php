<?php

date_default_timezone_set('Asia/Kolkata');
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$yesterdaydate = date('Y-m-d', strtotime('-1 days'));

$delfile = "backupsql/dbstructurefew_table_dump.sql";
if (file_exists($delfile)) {
    if (unlink($delfile)) {
        echo "File '$delfile' has been deleted.";
    } 
}

// --- Configuration ---
$user     = 'root';
$password = ''; // Empty if no password
$host     = 'localhost';
$db       = 'esurv';
$table    = 'ai_alerts_alive exception_alerts wsites'; // table to dump

$dumpPath = "F:\\Prabir\\23serverEsurvDB_Backup\\backupsql/dbstructurefew_table_dump.sql";

// Optional WHERE condition (set to "" to dump everything)
//$whereClause = "CAST(rtime AS DATE)= '$yesterdaydate'";


//$pastDate = date('Y-m-d', strtotime('-15 days'));
//echo $pastDate; die;

// --- Build the mysqldump command ---
if ($password === '') {
    // No password provided
    $cmd = sprintf(
		'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s %s %s --no-data > %s 2>&1',
		escapeshellarg($host),
		escapeshellarg($user),
		escapeshellarg($db),
		$table,
		escapeshellarg($dumpPath)
	);
} else {
    // Password provided
    $cmd = sprintf(
		'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s %s %s --no-data > %s 2>&1',
		escapeshellarg($host),
		escapeshellarg($user),
		escapeshellarg($db),
		$table,
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
