<table id="my_custom_games" class="mdl-data-table mdl-shadow--8dp wide">
    <thead>
    <tr>
        <th>
            <label
                    for="select_all_custom_games"
                    class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select"
            >
                <input
                        id="select_all_custom_games" type="checkbox"
                        class="mdl-checkbox__input"
                />
            </label>
        </th>
        <th>Type</th>
        <th>Game</th>
        <th>Name</th>
        <th>Created at</th>
    </tr>
    </thead>
    <tbody>
    @if (count($customGamesDb))
        @foreach ($customGamesDb as $customGameDb)
            <tr data-id="{{ $customGameDb->id }}">
                <td>
                    <label
                            for="custom_game_{{ $customGameDb->id }}"
                            class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select"
                            data-id="{{ $customGameDb->id }}"
                    >
                        <input
                                id="custom_game_{{ $customGameDb->id }}"
                                class="mdl-checkbox__input" type="checkbox"
                                data-id='{{ $customGameDb->id }}'
                        />
                    </label>
                </td>
                <td>{{ $customGameDb->type }}</td>
                <td>{{ $customGameDb->game }}</td>
                <td>{{ $customGameDb->name }}</td>
                <td>{{ $customGameDb->created_at->setTimezone($user['general']['timezone'])->toDateTimeString() }}</td>
            </tr>
        @endforeach
    @else
        {{--        <tr data-id=''>
                    <td>
                        <label for="custom_game_0" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" data-id="0">
                            <input id="custom_game_0" class="mdl-checkbox__input" type="checkbox" data-id='0' />
                        </label>
                    </td>
                    <td>Type</td>
                    <td>Game</td>
                    <td>Name</td>
                    <td>Created At</td>
                </tr>--}}
    @endif
    </tbody>
</table>
<form
        id='delete_my_custom_games'
        action='{{route('pokerDeleteCustomGames')}}' method='POST'
>
    {{csrf_field()}}
    <input type='hidden' name='customGameIds' value=''/>
    <button
            type='submit'
            class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent float-right"
            disabled
    >
        Delete Selected
    </button>
</form>