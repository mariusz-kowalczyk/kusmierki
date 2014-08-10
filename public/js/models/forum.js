
$(function() {
    $('#save-new-forum-topic').click(function() {
        $('#create-topic-forum-form').submit();
    });
    $('#create-topic-forum-form').submit(function() {
        if(!$(this).validationEngine('validate')) {
           return false;
        }
    });
    $('.forum-row-time').each(function() {
        var time = $(this).attr('data-time');
        Forum.showRowTime($(this), new Date(time * 1000));
    });
});

Forum = {
    showRowTime: function($el, date) {
        var now = new Date();
        var s = (now.getTime() - date.getTime()) / 1000;
        var d = s / 3600 / 24;
        if(s < 60) {
            $el.html(trans('common.time_ago', {ago: Math.round(s) + 's'}));
            setTimeout(Forum.showRowTime, 1000, $el, date);
        }else if(s < 3600) {
            $el.html(trans('common.time_ago', {ago: Math.round(s/60) + 'min'}));
            setTimeout(Forum.showRowTime, 60000, $el, date);
        }else if(d < 1) {
            $el.html(trans('common.today') + ' ' + date.toLocaleTimeString());
        }else if(d < 2) {
            $el.html(trans('common.yesterday') + ' ' + date.toLocaleTimeString());
        }else {
            $el.html(date.toLocaleString());
        }
    }
}


