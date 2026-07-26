<?php 
    require_once dirname(__DIR__) . '/exceptions/RequestException.php';

    class BotHttpRequestService {
        public function makeRequest(string $url, string $method = 'GET', string $query = '', $bodyReq = []) {
            if(!$url) return 'Wrong url';

            $urlOptions = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_ENCODING => "",
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "User-Agent: WeatherAggregator/1.0",
                ],
            ];

            if($method == 'GET') {
                $url .= $query;
            }

            if($method == 'POST') {
                $urlOptions[CURLOPT_POST] = true;
                $urlOptions[CURLOPT_POSTFIELDS] = $bodyReq;
            }

            $ch = curl_init($url);

            curl_setopt_array($ch, $urlOptions,);

            $res = curl_exec($ch);

            $curlCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if($curlCode !== 200) {
                throw new RequestException('Http code result is not 200');
            }

            $resArray = json_decode($res, true);

            if(json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonException(json_last_error_msg());
            }

            return $resArray;
        }
    }