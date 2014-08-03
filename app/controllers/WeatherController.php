<?php

use MK\Weather;

/**
 * Description of WeatherController
 *
 * @author Mariusz Kowalczyk
 */
class WeatherController extends BaseController {
    
    public function index() {
        $weather = Weather::forecast();
        $weather_days = array();
        foreach ($weather->list as $i) {
            $date = date('Y-m-d', $i->dt);
            if(!isset($weather_days[$date])) $weather_days[$date] = array();
            $weather_days[$date][] = $i;
        }
        
        $this->view
                ->with('weather', $weather)
                ->with('weather_days', $weather_days);
    }
    
}
