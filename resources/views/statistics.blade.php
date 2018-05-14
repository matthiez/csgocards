@extends('master')
@section('head')
    <meta
            name="description"
            content="Take a look at your own statistics as well as public statistics."
    />
    <title>Statistics - see yourself how you well are doing
        | {{config('app.name')}}</title>
@endsection
@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col">
        </div>
        <div class="mdl-cell mdl-cell--8-col mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <h1 class="text-center">Statistics</h1>
                <table class='mdl-data-table mdl-shadow--4dp wide'>
                    <caption>
                        <h2 class="mdl-typography--title text-center">Chip
                            Leaders</h2>
                    </caption>
                    <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($chipLeaders as $player => $chips)
                        @php $rank++ @endphp
                        @if (!in_array($player, Config::get('poker.systemAccounts')))
                            <tr>
                                <td>{{ $rank }}</td>
                                <td>{{ $player }}</td>
                                <td>{{ $chips }}</td>
                            </tr>
                        @endif
                    </tbody>
                    @endforeach
                </table>
                <hr>
                {{ Form::open(['url' => 'statistics/select-tourney', 'id' => 'select_tourney', 'class' => 'text-center']) }}
                <div
                        id='tourneys'
                        class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'
                >
                    <label for="tourney">Select Tourney</label>
                    <select
                            id='tourney' name='tourney'
                            class='mdl-selectfield__select'
                    >
                        @if (isset($tourneys['options']))
                            @foreach ($tourneys['options'] as $option) {
                            {!! $option !!}
                            @endforeach
                        @endif
                    </select>
                    <input
                            type='submit'
                            class='mdl-button mdl-js-button mdl-button--raised mdl-button--accent'
                            value='Submit' disabled
                    />
                </div>
                {{ Form::close() }}
                <table class='mdl-data-table mdl-shadow--4dp wide'>
                    <caption>
                        <h2 class="mdl-typography--title">Tourney Results</h2>
                    </caption>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>BuyIn</th>
                        <th>Entrants</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Placings</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6"><b>Soon!</b></td>
                    </tr>
                    <!-- AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--2-col">
        </div>
    </div>
@endsection