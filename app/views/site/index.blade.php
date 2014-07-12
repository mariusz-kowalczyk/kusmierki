
<h3 class="header">{{ Lang::get('site.message_index') }}</h3>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>{{ trans('site.label_title') }}</th>
                <th>{{ trans('site.label_link') }}</th>
                <th style="width: 80px;">{{ trans('site.label_visibility') }}</th>
                <th>{{ trans('common.label_created_by') }}</th>
                <th>{{ trans('common.label_created_at') }}</th>
                <th>{{ trans('common.label_updated_at') }}</th>
                <th style="width: 200px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $site)
            <tr>
                <td>{{ $site->title }}</td>
                <td>{{ $site->link }}</td>
                <td>@if($site->visibility) {{ trans('common.yes') }} @else {{ trans('common.no') }} @endif</td>
                <td>{{ $site->user->__toString() }}</td>
                <td>{{ $site->created_at }}</td>
                <td>{{ $site->updated_at }}</td>
                <td>
                    <a href="{{ route('site_edit', array('site' => $site->id)) }}" class="btn-link">{{ trans('common.edit') }}</a> |
                    <a href="{{ route('site_preview', array('site' => $site->id)) }}" target="_blank" class="btn-link">{{ trans('common.preview') }}</a> |
                    <a href="{{ route('site_delete', array('site' => $site->id)) }}" class="btn-link">{{ trans('common.delete') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>