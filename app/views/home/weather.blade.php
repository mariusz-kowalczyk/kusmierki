<div class="row weather-home">
    <?php
        $sum_w = 0;
        $day = 0;
        $date = date('Y-m-d');
        $i = 0;
        $nw = 0;
    ?>
    @while($sum_w < 12)
    <?php
        $count_items = \MK\Weather::getCountItemsForDay($date, $weather->list);
        if($sum_w + $count_items > 12) {
            $count_items = 12 - $sum_w;
        }
        $sum_w += $count_items;
    ?>
    <div class="col-md-{{ $count_items }} wether-day-div">
        <p class="text-center wether-day">
            @if($day == 0)
            {{ trans('common.today') }}
            @elseif($day == 1)
            {{ trans('common.tommorow') }}
            @else
            {{ trans('common.choice_day.' . date('N', strtotime($date))) }}
            @endif
            <br/>
            <small>{{ date('d/m', strtotime($date)) }}</small>
        </p>
        <div class="row">
            @for($k = 0; $k < $count_items; $k++)
            <?php if($weather->list[$i]->dt < strtotime($date)) { $k--; $i++; continue; } ?>
            <div class="col-md-1 weather-item" style="width: {{ 100 / $count_items }}%">
                <div class="weather-hour">{{ date('H:i', $weather->list[$i]->dt) }}</div>
                <img src="http://openweathermap.org/img/w/{{ $weather->list[$i]->weather[0]->icon }}.png" alt="{{ $weather->list[$i]->weather[0]->description }}" />
                <div class="weather-temp">
                    {{ round($weather->list[$i]->main->temp - 273.15, 1) }}&#176;C
                </div>
            </div>
            <?php $i++ ?>
            @endfor
        </div>
    </div>
    <?php
        $day++;
        $date = date('Y-m-d', strtotime('+' . $day . ' day'));
    ?>
    @endwhile
</div>