<h3 class="header">{{ Lang::get('weather.message_daily') }}</h3>

<div id="weather-daily">
    @for($i=0; $i<$count_days; )
        <div class="row">
        @for($j=0; $j<3 && $i<$count_days; $j++, $i++ )
            <?php 
            $item = $weather->list[$i];
            $date = date('Y-m-d', $item->dt);
            ?>
            <div class="col-md-4 weather-daily-day">
                <div class="weather-daily-date">
                    @if($date == date('Y-m-d'))
                    {{ trans('common.today') }}
                    @elseif($date == date('Y-m-d', strtotime('+1 day')))
                    {{ trans('common.tommorow') }}
                    @else
                    {{ trans('common.choice_day.' . date('N', strtotime($date))) }}
                    @endif
                    <small>{{ date('d/m', strtotime($date)) }}</small>
                </div>
                <div class="row">
                    <div class="col-md-8 weather-daily-main">
                        <img src="http://openweathermap.org/img/w/{{ $item->weather[0]->icon }}.png" alt="{{ $item->weather[0]->description }}" />
                        <div class="weather-daily-description">
                            {{ $item->weather[0]->description }}
                        </div>
                        <div class="row">
                            <div class="col-md-6 weather-daily-temp-day">
                                <div class="weather-daily-temp">
                                    <small>{{ trans('weather.max') }}: </small>{{ round($item->temp->max - 273.15, 1) }}&#176;C
                                </div>
                                <div class="weather-daily-temp-main">
                                    {{ round($item->temp->day - 273.15, 1) }}&#176;C
                                </div>
                                <div class="weather-daily-temp">
                                    <small>{{ trans('weather.min') }}: </small>{{ round($item->temp->min - 273.15, 1) }}&#176;C
                                </div>
                            </div>
                            <div class="col-md-6 weather-daily-temp-night">
                                <div class="weather-daily-temp">
                                    <small>{{ trans('weather.eve') }}: </small>{{ round($item->temp->eve - 273.15, 1) }}&#176;C
                                </div>
                                <div class="weather-daily-temp-main">
                                    {{ round($item->temp->night - 273.15, 1) }}&#176;C
                                </div>
                                <div class="weather-daily-temp">
                                    <small>{{ trans('weather.morn') }}: </small>{{ round($item->temp->morn - 273.15, 1) }}&#176;C
                                </div>
                            </div>
                        </div>
                        <div class="weather-daily-clouds"><span class="wd-label">{{ trans('weather.label_clouds') }}: </span> {{ $item->clouds }}%</div>
                        <div class="weather-daily-speed"><span class="wd-label">{{ trans('weather.label_wind') }}: </span> {{ $item->speed }} m/s</div>
                    </div>
                </div>
            </div>
        @endfor
        </div>
    @endfor
</div>