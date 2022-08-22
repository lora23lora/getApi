<?php

$apis = [
    "acountsFinance" => "127.0.0.1:8000/api/report/accounts_finance?dir_id=1",
    "ApplicationsByFee" => "127.0.0.1:8000/api/report/applications_by_fee?dir_id=1&from_date=2021-01-01&to_date=2022-08-13",
    "amountCollected" => "127.0.0.1:8000/api/report/amount_collected?dir_id=1&from_date=2020-08-01&to_date=2022-08-01",
    "ApplicationCount" => "127.0.0.1:8000/api/report/application_count?dir_id=1&from_date=2021-08-01&to_date=2022-08-01",
    "GeneralAccountsCount" => "127.0.0.1:8000/api/report/general_accounts_count?dir_id=1&from_date=2021-08-01&to_date=2022-08-10",
    "ItemCollected" => "127.0.0.1:8000/api/report/item_collected?dir_id=1&from_date=2021-08-01&to_date=2022-08-10",
    "ReportUserSalary" => "127.0.0.1:8000/api/report/user_salary?dir_id=1&from_date=2021-01-01&to_date=2022-08-13",

];

$api_times = [
    "acountsFinance" => 0,
    "ApplicationsByFee" => 0,
    "amountCollected" => 0,
    "ApplicationCount" => 0,
    "GeneralAccountsCount" => 0,
    "ItemCollected" => 0,
    "ReportUserSalary" => 0,

];
for($i = 0; $i < 10; $i++){
    foreach ($apis as $key => $api) {

        $start_time = microtime(true);
        $apiCall = apiCall($api);
        $end_time = microtime(true);
        $execution_time = round(($end_time - $start_time), 2);
        $api_times[$key] += $execution_time;
    }
}

foreach ($api_times as $key => $time) {

    echo " Execution time of  $key = " . ($time / 10) . " sec" ;
    echo "\n";
    
   
}

function apiCall($url)
{
    $curl_init = curl_init();

    curl_setopt($curl_init, CURLOPT_URL, $url);
    curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($curl_init);

    if ($e = curl_error($curl_init)) {
        echo $e;
    } else {
        return  json_decode($resp, true);
        // print_r($decoded);
    }
    curl_close($curl_init);
}
