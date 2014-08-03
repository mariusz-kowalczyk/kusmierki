<h3 class="header">{{ Lang::get('weather.message_index') }}</h3>

<div class="weather-main-div">
    @foreach($weather_days as $date => $w_day)
    <div class="well">
        <span class="item-dey">
            @if($date == date('Y-m-d'))
            {{ trans('common.today') }}
            @elseif($date == date('Y-m-d', strtotime('+1 day')))
            {{ trans('common.tommorow') }}
            @else
            {{ trans('common.choice_day.' . date('N', strtotime($date))) }}
            @endif
            <small>{{ date('d/m', strtotime($date)) }}</small>
        </span>
    </div>
    <div class="weather-day">
        <div class="row weather-main-info">
            <div class="col-md-1"></div>
            @foreach($w_day as $item)
            <div class="col-md-1">
                <div class="weather-hour">{{ date('H:i', $item->dt) }}</div>
                <img src="http://openweathermap.org/img/w/{{ $item->weather[0]->icon }}.png" alt="{{ $item->weather[0]->description }}" />
                <div class="weather-temp">
                    {{ round($item->main->temp - 273.15, 1) }}&#176;C
                </div>
                <div class="weather-temp-max">
                    <small>{{ trans('weather.max') }}: </small>{{ round($item->main->temp_max - 273.15, 1) }}&#176;C
                </div>
                <div class="weather-temp-min">
                    <small>{{ trans('weather.min') }}: </small>{{ round($item->main->temp_min - 273.15, 1) }}&#176;C
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary" onclick="$('#weather-main-details-{{ $date }}').slideToggle()">{{ trans('weather.details') }}</button>
        <div class="weather-main-details" id="weather-main-details-{{ $date }}">
            @foreach($w_day as $item)
            <div class="weather-details-item">
                <div class="weather-details-hour">{{ date('H:i', $item->dt) }}</div>
                <div class="weather-details-labels">
                    <div><span class="wd-label">{{ trans('weather.label_temp') }}: </span> {{ round($item->main->temp - 273.15, 1) }}&#176;C</div>
                    <div><span class="wd-label">{{ trans('weather.label_description') }}: </span> {{ $item->weather[0]->description }}</div>
                    <div><span class="wd-label">{{ trans('weather.label_clouds') }}: </span> {{ $item->clouds->all }}%</div>
                    <div><span class="wd-label">{{ trans('weather.label_wind') }}: </span> {{ $item->wind->speed }} m/s</div>
                    <div><span class="wd-label">{{ trans('weather.label_atmospheric_pressure') }}: </span> {{ $item->main->pressure }} hPa</div>
                </div>
            </div>
            @endforeach
        </div>
        @if(count($w_day) > 1)
        <div class="weather-charts-temp">
            <div id="container-chart-temp-{{ $date }}" style="width:100%; height:300px;"></div>
            @section('footer-script')
            @parent
            <script type="text/javascript">
                $(function() {
                    $('#container-chart-temp-{{ $date }}').highcharts({                        
                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: '{{ trans('weather.message_temp_charts_title') }}'
                        },
                        xAxis: {
                            type: 'datetime',
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        yAxis: {
                            title: {
                                text: '{{ trans('weather.label_temp_charts_y') }}'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' °C'
                        },
                        plotOptions: {
                            spline: {
                                lineWidth: 4,
                                states: {
                                    hover: {
                                        lineWidth: 5
                                    }
                                },
                                marker: {
                                    enabled: false
                                },
                                pointInterval: 3600000 * 3, // one hour
                                pointStart: Date.UTC({{ date('Y, m, d, H, i, s', $w_day[0]->dt) }})
                            }
                        },
                        series: [
                            {
                                name: '{{ trans('weather.label_temp_charts_info') }}',
                                data: [@foreach($w_day as $item) {{ round($item->main->temp - 273.15, 1) }}, @endforeach]

                            }
                        ]
                        ,
                        navigation: {
                            menuItemStyle: {
                                fontSize: '10px'
                            }
                        }
                    });
                });
            </script>
            @stop
        </div>
        @endif
    </div>
    @endforeach
</div>
@section('header-script')
@parent
{{ HTML::script('libs/highcharts/js/highcharts.js') }}
@stop