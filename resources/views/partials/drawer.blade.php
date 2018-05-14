<div class="mdl-layout__drawer mdl-color--white">
        <span class="mdl-layout-title mdl-color--white">
                <a
                        href="{{env('APP_SOCIAL_FB')}}" target="_blank"
                        title="{{env('APP_NAME')}} on Facebook"
                        style='text-decoration: none;'
                >
                    <i
                            class="fa fa-facebook-square fa-fw fa-2x mdl-color-text--grey"
                            aria-hidden="true"
                            role="presentation"
                    ></i>
                </a>
                <a
                        href="{{env('APP_SOCIAL_REDDIT')}}" target="_blank"
                        title="{{env('APP_NAME')}} on Reddit"
                        style='text-decoration: none;'
                >
                    <i
                            class="fa fa-reddit-square fa-fw fa-2x mdl-color-text--grey"
                            aria-hidden="true"
                            role="presentation"
                    ></i>
                </a>
                <a
                        href="{{env('APP_SOCIAL_TWITTER')}}" target="_blank"
                        title="{{env('APP_NAME')}} on Twitter"
                        style='text-decoration: none;'
                >
                    <i
                            class="fa fa-twitter-square fa-fw fa-2x mdl-color-text--grey"
                            aria-hidden="true"
                            role="presentation"
                    ></i>
                </a>
        </span>
    <nav class="mdl-navigation mdl-color--white">
        <a class="mdl-navigation__link" href="/" title="Home">
            <i class="material-icons mdl-color-text--red" role="presentation">home</i>Home
        </a>
        @if (Auth::check())
            @if ($isRegged)
                <a
                        class="mdl-navigation__link" href="{{ url('poker') }}"
                        title="Poker"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >grade</i>Poker
                </a>
                <a
                        class="mdl-navigation__link"
                        href="{{ url('deposit') }}" title="Deposit"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >add</i>Deposit
                </a>
                <a
                        class="mdl-navigation__link"
                        href="{{ url('withdrawal') }}" title="Withdrawal"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >remove</i>Withdrawal
                </a>
                {{--History derives from SteamID - technically a registration is not needed - we require it anyways--}}
                <a
                        class="mdl-navigation__link"
                        href="{{ url('history') }}" title="History"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >import_contacts</i>History
                </a>
                <a
                        class="mdl-navigation__link"
                        href="{{ url('statistics') }}" title="Statistics"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >show_chart</i>Statistics
                </a>
            @else
                <a
                        class="mdl-navigation__link"
                        href="{{ url('registration') }}" title="Registration"
                >
                    <i
                            class="material-icons mdl-color-text--red"
                            role="presentation"
                    >grade</i>Registration
                </a>
            @endif
        @endif
        <a
                class="mdl-navigation__link" href="{{ url('helpdesk') }}"
                title="Helpdesk"
        >
            <i class="material-icons mdl-color-text--red" role="presentation">help</i>Helpdesk
        </a>
        <a class="mdl-navigation__link" href="{{ url('info') }}" title="Info">
            <i class="material-icons mdl-color-text--red" role="presentation">info</i>Info
        </a>
        <hr>
        <a
                class="mdl-navigation__link" href="{{ url('csgo-news') }}"
                title="Info"
        >
            <i class="material-icons mdl-color-text--red" role="presentation">radio</i>CS:GO
            News
        </a>
    </nav>
    <div class="mdl-layout-spacer"></div>
    @if (Auth::check()) @include('partials.logout')
    @else @include('partials.login-through-steam')
    @endif
</div>