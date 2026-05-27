<?php

date_default_timezone_set('Asia/Kolkata');
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$yesterdaydate = date('Y-m-d', strtotime('-1 days'));

$delfile = "backupsql/common_table_dump.sql";
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
$table    = 'ac_1 alert_assign ai_alerts_diebold ai_sites alarms alertscount alerts_acup alerts_acup_new alert_ticket_raise alert_ticket_raise_history allmonitorsites all_dvr_live archive_alert atmdata atm_power atm_upload_images atm_upload_images_test aws_bucket_upload back_room_light bajajdvronline bank branches broadbanddetails buffer_alerts buffer_alerts_crt buttonaction bypassatmdetails bypass_sites bypass_sites1 by_pass_sites cache cache_locks change_password_details circle_master cities clouddvr_health comfort comfort_diebold comfort_hdfc comfort_sbitom2 commands1 comments common_customer_email common_region_email cts_branch currentalerts custdatamaintainremark customer customerdatamaintain customer_atm_email customer_codes daily_downsite_table daily_downsite_table_test dbsync_details delegation_sites demo demo_testing download_zip_excel down_communication dvrcommunicationdetails dvrcommunicationdetailsdvr dvrcommunicationdetails_test dvronline dvrsite dvr_files dvr_missed_records dvr_name eazyinfra_login_access email_id email_send_reports employee ems_login_access ems_login_access_panel_health ems_login_access_panel_health_new escalation_matrix esurveillance_penalty_master esurvsites esurv_camera_penalty_master esurv_camera_penalty_master_new esurv_network_penalty_master esurv_network_penalty_master_new failed_jobs footage_details_available_start_zip footage_details_available_start_zip_new gpssites gpssites_details healthstatus_menu healthstatus_roll healthstatus_sites historybroadbanddetails ip_camera_details jobs job_batches live_info_details live_talk location_latlong location_latlong_1 loginusers login_user_otp loginaudit log_audit_mail mailsentaudit main_incomer main_menu migrations mis_details monitorsites network_log_records network_report_list network_report_site_status newalerttesting newcommands1 newnetwork_report_new newnetwork_report_new_test north_alerts panel_activity_tracker panel_health panel_health_api_response panel_health_api_response_history panel_health_api_response_new panel_health_orgid_list panel_health_update panel_history panel_macid_orgid panel_make_tbl passwordbuffer password_reset_tokens permissions permission_role pnb_wall pnb_wall1 pnb_wall2 pnb_wall3 pnb_wall4 projectsites qrt_arrange qrt_update rass rass_boi rass_cloud rass_pnb rass_sbi raxx region_email rms_update rnmcalls roles securico securico_gx4816 sec_sbi sessions settimeoutid sheet1 signage_board sites sites_details sites_diebold sites_info sites_log sites_server_ip sites_server_wise1 sites_siminfo sites_zones site_attachment site_circle site_circle_zonal site_testing_log site_test_log_details smarti smartialarms smartinew smarti_boi smarti_hdfc32 smarti_pnb state sub_menu tanishqsites tani_common_region_email tani_region_email temperature testingsites testingcount test_cron test_query theft_ticket_raise ticket_raise ticket_raise_history tmp_sites unique_atm_codes users user_activity_logs videodownloadiplist viewsitesmenu zonebypass_mail zonecameras zones'; // table to dump  

$dumpPath = "F:\\Prabir\\23serverEsurvDB_Backup\\backupsql/common_table_dump.sql";


//$pastDate = date('Y-m-d', strtotime('-15 days'));
//echo $pastDate; die;

// --- Build the mysqldump command ---
if ($password === '') {
    // No password provided
    $cmd = sprintf(
	    'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s %s %s > %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($db),
        $table,
        escapeshellarg($dumpPath)
    );
} else {
    // Password provided
    $cmd = sprintf(
        'C:\\wamp64\\bin\\mysql\\mysql5.7.19\\bin\\mysqldump.exe -h %s -u %s --password=%s %s %s > %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($password),
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
