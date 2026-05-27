# Path to PHP executable
$phpPath = "C:\wamp64\bin\php\php7.1.9\php.exe"

# Path to your PHP script
#$phpScriptPath = "C:\wamp64\www\ComfortTechnoNew\cronjobs\footages_path_new_files_uploaded.php"
$phpScriptZipPath = "C:\wamp64\www\mainDbBackup\deleteaialertsalivesql.php"

# Log file paths
$outputLogFile = "C:\wamp64\www\mainDbBackup\cronjobs\script_aialertsalive_output.txt"
$errorLogFile = "C:\wamp64\www\mainDbBackup\cronjobs\script_aialertsalive_error.txt"

# Ensure the log file directory exists
$logDir = [System.IO.Path]::GetDirectoryName($outputLogFile)
if (-not (Test-Path $logDir)) {
    New-Item -Path $logDir -ItemType Directory
}

# Execute the PHP script and redirect output and errors to separate log files
#Start-Process -FilePath $phpPath -ArgumentList $phpScriptPath -NoNewWindow -Wait -RedirectStandardOutput $outputLogFile -RedirectStandardError $errorLogFile
Start-Process -FilePath $phpPath -ArgumentList $phpScriptZipPath -NoNewWindow -Wait -RedirectStandardOutput $outputLogFile -RedirectStandardError $errorLogFile

# Check the output log file for any results
if (Test-Path $outputLogFile) {
    Write-Output "Output Log:"
    Get-Content $outputLogFile
} else {
    Write-Output "Output log file not found."
}

# Check the error log file for any errors
if (Test-Path $errorLogFile) {
    Write-Output "Error Log:"
    Get-Content $errorLogFile
} else {
    Write-Output "Error log file not found."
}
