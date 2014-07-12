
function wait() {
    
}

function unwait() {
    
}

$(function() {
    context.init({
        fadeSpeed: 100,
        filter: function ($obj){},
        above: 'auto',
        preventDoubleContext: true,
        compress: false
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