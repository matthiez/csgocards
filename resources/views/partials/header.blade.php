<header class="mdl-layout__header mdl-color--white">
    <div class="mdl-layout__header-row">
		<span class="mdl-layout-title">
			<a href="/"><img
                        id="logo"
                        src="{{env('APP_STATIC_URL')}}img/ace-of-hearts.svg"
                        alt="{{env('APP_NAME')}} logo"
                /></a>
		</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            @if (Auth::check())
                @if ($isRegged)
                    <a
                            id="header_poker"
                            class="mdl-navigation__link hover-no-title"
                            href="{{ url('poker') }}"
                            title="Poker"
                    >
                        <i
                                class="material-icons mdl-color-text--red"
                                role="presentation"
                        >grade</i>
                    </a>
                    <div data-mdl-for="header_poker" class="mdl-tooltip">
                        Poker
                    </div>
                    <a
                            id="header_deposit"
                            class="mdl-navigation__link hover-no-title"
                            href="{{ url('deposit') }}"
                            title="Deposit"
                    >
                        <i
                                class="material-icons mdl-color-text--red"
                                role="presentation"
                        >add</i>
                    </a>
                    <div data-mdl-for="header_deposit" class="mdl-tooltip">
                        Deposit
                    </div>
                    <a
                            id="header_withdraw"
                            class="mdl-navigation__link hover-no-title"
                            href="{{ url('withdrawal') }}"
                            title="Withdrawal"
                    >
                        <i
                                class="material-icons mdl-color-text--red"
                                role="presentation"
                        >remove</i>
                    </a>
                    <div data-mdl-for="header_withdraw" class="mdl-tooltip">
                        Withdrawal
                    </div>
                @else
                    <a
                            id="header_registration"
                            class="mdl-navigation__link hover-no-title"
                            href="{{ url('registration') }}"
                            title="Registration"
                    >
                        <i
                                class="material-icons mdl-color-text--red"
                                role="presentation"
                        >grade</i>
                    </a>
                    <div
                            data-mdl-for="header_registration"
                            class="mdl-tooltip"
                    >Registration
                    </div>
                @endif
            @endif
            <a
                    id="header_helpdesk"
                    class="mdl-navigation__link hover-no-title"
                    href="{{ url('helpdesk') }}"
                    title="Helpdesk"
            >
                <i
                        class="material-icons mdl-color-text--red"
                        role="presentation"
                >help</i>
            </a>
            <div data-mdl-for="header_helpdesk" class="mdl-tooltip">Helpdesk
            </div>
            @if (Auth::check())
                <div class='mdl-chip mdl-chip--contact mdl-color--grey'>
                    <a
                            id='header_dashboard' href='{{route('dashboard')}}'
                            title='Dashboard' class='hover-no-title'
                    >
                        <img
                                alt='Avatar for SteamID64 {{$user['steam']['id']}}'
                                class='mdl-chip__contact'
                                src='{{$user['steam']['avatar']}}'
                        />
                        <span class='mdl-chip__text mdl-color-text--white'>{{$user['steam']['personaName']}}</span>
                    </a>
                </div>
                <div data-mdl-for='header_dashboard' class='mdl-tooltip'>Go to
                    Dashboard
                </div>
            @else
                @include ('partials.login-through-steam')
            @endif
        </nav>
    </div>
</header>