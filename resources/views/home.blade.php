@extends('master')
@section('head')
    <meta
            name='description'
            content="Play Poker online with Counter-Strike:Global Offensive Skins. Hold'Em, Omaha, Razz, Stud."
    />
    <title>Play poker online with CS:GO skins | {{config('app.name')}}</title>
    <style>
        .giveaway.mdl-card {
            width: 360px;
            height: 360px;
            background: url('{{env('APP_STATIC_URL')}}img/tec9-toxic-mw-360fx360f.png') center / cover;
        }

        .giveaway > .mdl-card__actions {
            height: 52px;
            padding: 16px;
            background: rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
@section('content')
    {{--    {{dd(config('database.connections.mysql'))}}--}}
    <h1 class='font-nunito text-center'>{{config('app.name')}}<span
                class="block"
        >gamble with cs:go skins</span></h1>
    <p class='text-center'>
        @if (Auth::check())
            @if ($isRegged)
                <span class='mdl-color--red mdl-color-text--white font-anton roller smooth'><a
                            href='{{route('poker')}}'
                            title='Play Poker'
                            style='color: #fff;'
                    >Go straight to the action!</a></span>
            @else
                <span class='mdl-color--red mdl-color-text--white font-anton roller smooth'><a
                            href='{{route('registration')}}' title='Register'
                            style='color: #fff;'
                    >Register now</a> and get started!</span>
            @endif
        @else
            <span class='mdl-color--red mdl-color-text--white font-anton roller smooth'><a
                        href='{{route('login')}}'
                        title='Login and sign up'
                        style='color: #fff;'
                >Log in</a> and sign up!</span>
        @endif
    </p>
    <section>
        <h2 class="mdl-typography--headline text-center">You have the Choice:
            Poker or Roulette</h2>
        <div class='mdl-grid mdl-color--grey-50'>
            <div class='mdl-cell mdl-cell--6-col mdl-cell--4-col-phone mdl-typography--text-center'>
                <figure>
                    <a
                            href='{{ (Auth::check() && $isRegged) ? route('poker') : route('registration') }}'
                            title='{{ (Auth::check() && $isRegged) ? 'Play Poker Now' : 'Register an Account' }}'
                    >
                        <img
                                src='{{env('APP_STATIC_URL')}}img/poker-chip.svg'
                                class='half' alt='Poker'
                        />
                    </a>
                    <figcaption><h3 class='mdl-typography--headline'>Play Poker
                            with Skins</h3></figcaption>
                </figure>
                <div class='mdl-card center mdl-color--red-50 half'>
                    <ul class='mdl-list'>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>(No)-Limit Hold'em, Omaha, Razz & Stud</span>
                        </li>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>Single table and multi table tournaments</span>
                        </li>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>Daily freerolls to get your bankroll rolling</span>
                        </li>
                    </ul>
                    <div class='mdl-card__actions mdl-card--border mdl-color--grey-300'>
                        <a
                                class='mdl-button mdl-button--colored mdl-js-button mdl-color-text--black'
                                href='{{ (Auth::check() && $isRegged) ? route('poker') : route('registration') }}'
                        ><b>Play
                                Poker Now</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class='mdl-cell mdl-cell--6-col mdl-cell--4-col-phone mdl-typography--text-center '>
                <figure>
                    <a
                            href='http://www.csgo-gamer.de/' target='_blank'
                            title='Play Jackpot at our partner site'
                    >
                        <img
                                src='{{env('APP_STATIC_URL')}}img/roulette.svg'
                                class='half' alt='Jackpot'
                        />
                    </a>
                    <figcaption>
                        <h3 class='mdl-typography--headline'>Play Jackpot with
                            Skins</h3>
                    </figcaption>
                </figure>
                <div class='mdl-card center mdl-color--red-50 half'>
                    <ul class='mdl-list'>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>Gamble with your friends all day and night</span>
                        </li>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>Get rid of your cases and turn keys into skins</span>
                        </li>
                        <li class='mdl-list__item'>
                            <span class='mdl-list__item-primary-content'>Guaranteed secure withdrawals and deposits</span>
                        </li>
                    </ul>
                    <div class='mdl-card__actions mdl-card--border mdl-color--grey-300'>
                        <a
                                class='mdl-button mdl-button--colored mdl-js-button mdl-color-text--black'
                                href='http://www.csgo-gamer.de/'
                                target='_blank'
                                title='Play Jackpot at our partner site'
                        ><b>Play
                                Jackpot Now</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 class="mdl-typography--headline text-center">Features and
            Benefits</h2>
        <div class='mdl-grid'>
            <div class='mdl-cell mdl-cell--9-col'>
                <ul class='mdl-list'>
                    <li class='mdl-list__item mdl-list__item--three-line'>
                        <div class='mdl-list__item-primary-content'>
                            <i class='material-icons mdl-list__item-avatar'>stars</i>
                            <h3 class='reset'>Secure Deposits</h3>
                            <span class='mdl-list__item-text-body'>
                            Your security will always have highest priority when depositing Counter-Strike: Global Offensive items. Before starting to process the actual request it will always be verified that you in return receive the right amount of coins onto your account.
                            </span>
                        </div>
                    </li>
                    <li class='mdl-list__item mdl-list__item--three-line'>
                        <div class='mdl-list__item-primary-content'>
                            <i class='material-icons  mdl-list__item-avatar'>stars</i>
                            <h3 class='reset'>Fast Withdrawals</h3>
                            <span class='mdl-list__item-text-body'>
                                All CS:GO items you can see on the withdraw page after refreshing it are currently available for withdrawal. All trades happen in real-time to guarantee fastest possible withdrawals at any given time. You won't ever get charged for non-available items.
                            </span>
                        </div>
                    </li>
                    {{--                    <li class='mdl-list__item mdl-list__item--three-line'>
                                            <div class='mdl-list__item-primary-content'>
                                                <i class='material-icons  mdl-list__item-avatar'>stars</i>
                                                <h3 class='reset'>Fair Rakebacks</h3>
                                                <span class='mdl-list__item-text-body'>
                                                    If you frequently use our services, your account will periodically and automatically be credited with a certain amount of coins depending on how much you have played for in a given period of time. Our return gift for regular users.
                                                </span>
                                            </div>
                                        </li>--}}
                    <li class='mdl-list__item mdl-list__item--three-line'>
                        <div class='mdl-list__item-primary-content'>
                            <i class='material-icons  mdl-list__item-avatar'>stars</i>
                            <h3 class='reset'>Custom Games</h3>
                            <span class='mdl-list__item-text-body'>
                                Create your own password-protected poker table protected with a password. This way you can play private games with your friends and nobody else will be able to join. Choose a game, levels and seats and you are good to go within just a single minute. It doesn't take more than that.
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class='mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-phone mdl-cell--middle'>
                <div class="mdl-card mdl-shadow--4dp giveaway">
                    <h3 class="mdl-card__title-text mdl-typography--body-1 nomargin center">
                        Giveaway</h3>
                    <h4 class='mdl-card__title-text mdl-color--grey-300 center'>
                        Tec-9 Toxic (Minimal Wear)</h4>
                    <div class='mdl-card__title mdl-card--expand'>
                    </div>
                    <div class='mdl-card__actions text-center'>
                        <form
                                id='enter_giveaway'
                                action='{{route('enterGiveaway')}}'
                                method='POST'
                        >
                            {{csrf_field()}}
                            <button
                                    type='submit' class='reset wide'
                                    @if (!$isRegged) disabled @endif >Enter
                                this
                                Giveaway!
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <img
            src='{{env('APP_STATIC_URL')}}img/lem-1920x272.jpg'
            class="mdl-cell--hide-phone" alt='Legendary Eagle Master'
    />
@endsection
@section('js')
@endsection