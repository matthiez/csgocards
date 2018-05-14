@extends('master')
@section('head')
    <meta name='robots' content='noindex, nofollow'/>
    <meta name='description' content='User Profile - get player information'/>
    <title>Profile for {{ $player }} ({{ $steamId }})
        | {{config('app.name')}}</title>
@endsection
@section('content')
    <div class='mdl-grid'>
        <div class='mdl-cell mdl-cell--2-col'></div>
        <div class='mdl-cell mdl-cell--8-col'>
            <h1 class='text-center'>User Profile</h1>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--8dp wide">
                <caption class='mdl-typography--title'>Public Information
                </caption>
                <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Nickname</td>
                    <td>{{ $player or Auth::user()->player }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">SteamID64
                    </td>
                    <td>{{ $steamId or Auth::user()->steamid }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Avatar</td>
                    <td><span
                                class='float-right'
                                style='background: url("{{ Config::get('poker.avatarsUrl') }}") no-repeat -{{(($user['poker']['avatar']-1) * Config::get('poker.avatarSize'))}}px 0px; width: 32px; height: 32px;'
                        ></span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class='space-medium'></div>
            @if ($steamId == $user['steam']['id'])
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--8dp wide">
                    <caption class='mdl-typography--title'>Private
                        Information
                    </caption>
                    <tbody>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">E-Mail
                        </td>
                        <td>{{ $user['poker']['email'] }}</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Last
                            known IP
                        </td>
                        <td>{{ $user['general']['ip'] }}</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">First
                            Login
                        </td>
                        <td>{{ $user['poker']['firstLogin'] }}</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Last
                            Login
                        </td>
                        <td>{{ $user['poker']['lastLogin'] }}</td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Total
                            Balance
                        </td>
                        <td class='chips-after'>{{ $user['poker']['balance'] }}
                            <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips'
                                    class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">InPlay
                            (Cashgame)
                        </td>
                        <td>{{ $user['poker']['ringChips'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">InPlay
                            (Tourney)
                        </td>
                        <td>{{ $user['poker']['regChips'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Equal
                            Rake
                        </td>
                        <td>{{ $user['poker']['eRake'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">
                            Proportional Rake
                        </td>
                        <td>{{ $user['poker']['pRake'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">
                            Tournament Fees
                        </td>
                        <td>{{ $user['poker']['tourneyFees'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Times
                            Deposited
                        </td>
                        <td>{{ $user['poker']['timesDeposited'] }} <img
                                    src='{{env('APP_STATIC_URL')}}heartbeat-16x16.png'
                                    alt='Times'
                                    class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">In
                            Value
                        </td>
                        <td>{{ $user['poker']['amountDeposited'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips'
                                    class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Times
                            Withdrawn
                        </td>
                        <td>{{ $user['poker']['timesWithdrawn'] }} <img
                                    src='{{env('APP_STATIC_URL')}}heartbeat-16x16.png'
                                    alt='Times'
                                    class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">In
                            Value
                        </td>
                        <td>{{ $user['poker']['amountWithdrawn'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips'
                                    class='profile-mini-img'
                            /></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Profit
                        </td>
                        <td>{{ $user['poker']['profit'] }} <img
                                    src='{{env('APP_STATIC_URL')}}poker-chip-16.png'
                                    alt='Chips' class='profile-mini-img'
                            /></td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
        <div class='mdl-cell mdl-cell--2-col'></div>
    </div>
@endsection