<?php

namespace MK;

/**
 * Description of Weather
 *
 * @author mariusz
 */
class Weather {
    
    /**
     * Zwraca czas po którym cache jest stary
     * 
     * @return int
     */
    private static function getTimeForRefreshCache() {
        return 300;
    }

    /**
     * Zwraca dane z cache, jeżeli nie ma lub są stare zwraca null
     * 
     * @param string $key
     * @param string $get_expired - zwraca dane nawet jeżeli wygasły
     * @return null|mixed
     */
    private static function getCache($key, $get_expired = false) {
        $path = storage_path('weather');
        if(!file_exists($path)) {
            mkdir($path);
        }
        $file_time = $path . '/' . sha1($key . 'time');
        $file_data = $path . '/' . sha1($key . 'data');
        if(!file_exists($file_time)) {
            return null;
        }
        $last_time = file_get_contents($file_time);
        if($get_expired || time() - self::getTimeForRefreshCache() < $last_time) {
            $data = file_get_contents($file_data);
            return json_decode($data);
        }else {
            return null;
        }
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $data
     */
    private static function setCache($key, $data) {
        $path = storage_path('weather');
        if(!file_exists($path)) {
            mkdir($path);
        }
        $file_time = $path . '/' . sha1($key . 'time');
        $file_data = $path . '/' . sha1($key . 'data');
        file_put_contents($file_time, time());        
        file_put_contents($file_data, json_encode($data));
    }
    
    /**
     * Zwraca warunek dla lokalizacji pogody
     * 
     * @return string
     */
    private static function getLocationForApi() {
        return 'q=Kuśmierki';
    }

    /**
     * Zwraca pogodę na przyszłe dni
     * 
     * @return mixed
     */
    public static function forecast() {
        $data = self::getCache('forecast');
        if(empty($data)) {
            $url = 'http://api.openweathermap.org/data/2.5/forecast?' . self::getLocationForApi() . '&lang=pl&mode=json';
            try {
                $data_json = file_get_contents($url);
                $data = json_decode($data_json);
                self::setCache('forecast', $data);
            }catch(\Exception $err) {
                $data = self::getCache('forecast', true);
                self::setCache('forecast', $data);
            }
        }
        return $data;
    }
    
    /**
     * Zwraca liczbę pozycji pogodowych w ciągu podanego dnia
     * 
     * @param string $date - Y-m-d
     * @param array $list
     * @return int
     */
    public static function getCountItemsForDay($date, $list) {
        $count = 0;
        foreach ($list as $row) {
            if(date('Y-m-d', $row->dt) == $date)
                $count++;
            elseif($count > 0 )
                break;
        }
        return $count;
    }
    
    /**
     * Zwraca pogodą długoterminową
     * 
     * @return mixed
     */
    public static function forecastDaily() {
        $data = self::getCache('forecast-daily');
        if(empty($data)) {
            try {
                $tmp_data;
                $max_cnt = 0;
                for($i=16;$i>11;$i--) {
                    $url = 'http://api.openweathermap.org/data/2.5/forecast/daily?' . self::getLocationForApi() . '&lang=pl&mode=json&cnt=' . $i;
                    $data_json = file_get_contents($url);
                    $data = json_decode($data_json);
                    if($max_cnt < $data->cnt) {
                        $max_cnt = $data->cnt;
                        $tmp_data = $data;
                    }
                    if($data->cnt >= $i) 
                        break;
                }
                $data = $tmp_data;
                self::setCache('forecast-daily', $data);
            }catch(\Exception $err) {
                $data = self::getCache('forecast-daily', true);
                self::setCache('forecast-daily', $data);
            }
        }
        return $data;
    }
    
}
