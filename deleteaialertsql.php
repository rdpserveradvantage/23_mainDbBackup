<?php
// Config C:\wamp64\bin\mysql\mysql5.7.19\bin
$mysqlPath = '"C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysql.exe"'; // full path to mysql.exe (adjust if needed)
$user      = 'root';
$password  = '';          // empty password or set your password here
$database  = 'esurv';
$table     = 'ai_alerts';
$date      = '2025-07-01'; // date to delete records for

$date = date('Y-m-d', strtotime('-3 days'));

$script_run_time = date('Y-m-d H:i:s');


// Build the DELETE SQL command
$sql = "DELETE FROM ai_alerts WHERE CAST(receivedtime AS DATE) < CURDATE() - INTERVAL 3 DAY ORDER BY id ASC LIMIT 5000;";

// Build the full mysql command
if ($password === '') {
    $cmd = sprintf(
        '%s -u %s %s -e %s',
        $mysqlPath,
        escapeshellarg($user),
        escapeshellarg($database),
        escapeshellarg($sql)
    );
} else {
    $cmd = sprintf(
        '%s -u %s --password=%s %s -e %s',
        $mysqlPath,
        escapeshellarg($user),
        escapeshellarg($password),
        escapeshellarg($database),
        escapeshellarg($sql)
    );
}

// Execute the command and capture output and return code
exec($cmd, $output, $returnVar);

if ($returnVar === 0) {
    echo "Records deleted successfully for before 15 days datetime $script_run_time.";
} else {
    echo "Failed to delete records. Return code: $returnVar\n";
    echo "Output:\n" . implode("\n", $output);
}
