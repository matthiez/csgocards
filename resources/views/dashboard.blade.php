@extends('master')
@section('head')
    <meta name='robots' content='noindex, nofollow'/>
    <meta name='description' content='View and edit your own custom games'/>
    <title>Dashboard | {{config('app.name')}}</title>
@endsection
@section('content')
    <div class='mdl-grid'>
        <div class='mdl-cell mdl-cell--2-col'>
        </div>
        <div class='mdl-cell mdl-cell--8-col'>
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#panel_overview" class="mdl-tabs__tab is-active">Overview</a>
                    <a href="#panel_general" class="mdl-tabs__tab">General</a>
                    <a href="#panel_poker" class="mdl-tabs__tab">Poker</a>
                    <a href="#panel_custom_games" class="mdl-tabs__tab">Custom
                        Games</a>
                </div>
                <p class='text-center'>All changes will be applied
                    immediately.</p>
                <div id='panel_overview' class="mdl-tabs__panel is-active">
                    @include('partials.poker.overview', ['wide' => true])
                </div>
                <div id="panel_general" class="mdl-tabs__panel">
                    <h4>Set Timezone</h4>
                    @include('partials.select-timezone')
                    <h4>Set Tradelink</h4>
                    @include('partials.set-tradelink')
                </div>
                <div id="panel_poker" class="mdl-tabs__panel">
                    <h4>Set Location</h4>
                    @include('partials.poker.set-location', ['wide' => true])
                    <h4>Change Avatar</h4>
                    <div>@include('partials.poker.avatars')</div>
                    @include('partials.poker.custom-avatar')
                </div>
                <div id="panel_custom_games" class="mdl-tabs__panel">
                    <h4>My Custom Games</h4>
                    @include('partials.poker.my-custom-games')
                    <h4>Create ring game Hold'Em/Omaha</h4>
                    @include('partials.poker.create-ring-game-holdem-omaha')
                    <h4>Create ring game Razz/Stud</h4>
                    @include('partials.poker.create-ring-game-razz-stud')
                </div>
            </div>
        </div>
        <div class='mdl-cell mdl-cell--2-col'>
        </div>
    </div>
@endsection
@section('js')
@endsection