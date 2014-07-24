<footer id="footer">
    <div class="container">
        @if(!Cookie::get('cookie_agree', false))
        <div id="info-cookie">
            <p>
                {{ trans('common.info_cookie') }}
                <button type="button" id="cookie-agree" class="btn btn-sm btn-success">{{ trans('common.cookie_agree') }}</button> 
            </p>
            <hr/>
        </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <ul class="footer-menu-list">
                    <li>
                        <a href="{{ route('home_index') }}" class="btn-link">{{ trans('common.nav_home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('gallery_index') }}" class="btn-link">{{ trans('common.nav_gallery') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('notice_index') }}" class="btn-link">{{ trans('common.nav_notices') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-menu-list">
                    @foreach(Site::where('visibility', '=', 1)->get() as $site)
                    <li><a href="{{ route('site_show', array('site_link' => $site->link)) }}">{{ $site->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-menu-list">
                    <li><b>{{ trans('common.we_recommend') }}</b></li>
                    <li>{{ trans('common.place_your_website') }}</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-menu-list">
                    @if(Auth::check())
                    <li>
                        <a href="{{ route('user_logout') }}" class="btn-link">{{ trans('common.nav_logout') }}</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('user_login') }}" class="btn-link">{{ trans('common.nav_login') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('user_register') }}" class="btn-link">{{ trans('common.nav_register') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>