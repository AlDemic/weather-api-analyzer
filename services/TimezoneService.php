<?php 
    require_once 'ApiRequestService.php';

    class TimezoneService {
        private ApiRequestService $httpReq;

        public function __construct(ApiRequestService $httpReq) {
            $this->httpReq = $httpReq;
        }

        public function getUtcOffsetSeconds($placeLat, $placeLon): int {
            $lat = urlencode($placeLat);
            $lon = urlencode($placeLon);

            $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&timezone=auto&forecast_days=1";

            $res = $this->httpReq->makeRequest($url);

            return (int)($res['utc_offset_seconds'] ?? 0);
        }
    }
