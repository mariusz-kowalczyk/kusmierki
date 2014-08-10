
function wait() {
    
}

function unwait() {
    
}

function initFooter() {
    var content_height = $('body > div.wrap').height() + parseInt($('body > div.wrap').css('marginTop')) + parseInt($('body > div.wrap').css('marginBottom'));
    var window_height = $(window).height();
    var footer_height = $('#footer').height();

    if(content_height + footer_height > window_height) {
        $('#footer').css('position', 'relative');
    }else {
        $('#footer').css('position', 'fixed');
    }
}

$(function() {
    context.init({
        fadeSpeed: 100,
        filter: function ($obj){},
        above: 'auto',
        preventDoubleContext: true,
        compress: false
    });
    
    //footer
    initFooter();
    $(window).resize(function() {
        initFooter();
    });
    
    //cookie agree
    $('#cookie-agree').click(function() {
        $('#info-cookie').slideUp();
        $.ajax({
            url: 'cookie'
        });
        return false;
    });
});

function in_array(needle, haystack) {
    for(var i in haystack) {
        if(needle == haystack[i]) {
            return true;
        }
    }
    return false;
}

function trans (key, params) {
    var t = key.split('.');
    var tmp = Lang;
    for(var i in t) {
        tmp = tmp[t[i]];
    }
    if(params) {
        for(var i in params) {
            tmp = tmp.replace(':' + i, params[i]);
        }
    }
    return tmp;
}