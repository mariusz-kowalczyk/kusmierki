
<h3 class="header">{{ Lang::get('user.message_edit') }}</h3>

<div class="row" >
    <div class="col-md-8">
        <form class="form-horizontal" role="form" method="post" action="{{ route('user_do_edit') }}" id="user-edit-form">
            @include('user._form')
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('common.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('footer-script')
@parent
<script type="text/javascript">
    $(function() {
        $('#user-edit-form').validationEngine();
    });
</script>
@stop