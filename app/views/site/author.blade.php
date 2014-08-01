<h3 class="header">{{ trans('site.message_author') }}</h3>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-primary">{{ trans('site.message_about_author') }}</h3>
        {{ HTML::image('images/author.jpg', trans('site.message_about_author'), array('class' => 'img-thumbnail')) }}
        <br/><br/>
        inż. <b>Mariusz Kowalczyk</b>
        <br/><br/>
        Tel. <b>691 776 670</b>
        <br/>
        Email: <b>m.kowalczyk44446@gmail.com</b>
    </div>
    <div class="col-md-6">
        <h3 class="text-primary">{{ trans('site.message_question_to_author') }}</h3>
        <form class="form-horizontal" role="form" method="post" action="{{ route('site_author') }}" id="contact-form">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="question-content">{{ trans('site.question_content') }}</label>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control validate[required]" rows="6" id="question-content" name="question[content]"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="question-reply-contact">{{ trans('site.question_reply_contact') }}</label>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control validate[required]" rows="2" id="question-reply-contact" name="question[contact]"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-lg btn-success">{{ trans('common.send') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('footer-script')
@parent
<script type="text/javascript">
    $(function() {
        $('#contact-form').validationEngine();
    });
</script>
@stop