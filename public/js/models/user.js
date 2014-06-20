
User = {
    register: {
        setBirthday: function() {
            var date = $('#birthday-year').val() + '-' + $('#birthday-month').val() + '-' + $('#birthday-day').val();
            $('#user-birthday').val(date);
        }
    }
}