<?php
    function send_api_request($endpoint, $method, $data = null) {
        $apiserver = getenv('API_URL');
        $debug = false;
        if(empty($apiserver)) {
            return [
                'error' => 'API server URL not configured.'
            ];
        }
        $curl = curl_init("$apiserver$endpoint");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Auth: super-secret-key'
            ]);
        $curldata = null;
        switch($method) {
            case 'GET':
                $query = http_build_query($data);
                $curldata = $query;
                curl_setopt($curl, CURLOPT_URL, "$apiserver$endpoint?$query");
                break;
            case 'POST':
                $curldata = json_encode($data);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Auth: super-secret-key'
                ]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }
        if($debug) {
            echo "data: ". $curldata . "\n";
        }
        $curl_ret = curl_exec($curl);
        if(curl_error($curl)) {
            return [
                'error' => curl_error($curl)
            ];
        }
        return [
            'status' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
            'response' => $curl_ret
        ];
    }
?>