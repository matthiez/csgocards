@extends('master')
@section('head')
    <meta
            name="description"
            content="View your Steam tradeoffers from our site, both active and completed | {{env('APP_NAME')}}"
    />
    <title>History | {{config('app.name')}}</title>
    <style>
        .trade-done {
            color: green;
        }

        .trade-waiting {
            color: red;
        }

        .deposits, .withdrawals {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col"></div>
        <div class="mdl-cell mdl-cell--8-col mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <h1>History</h1>
            </div>
            <p>
                An overview of completed and ongoing tradeoffers.<br>
                In case of missing tradeoffers you are more than welcome to <a
                        href="{{ url('tickets') }}"
                        title='Send us a Ticket'
                >send us a
                    ticket</a>.
            </p>
            <div class="mdl-cell mdl-cell--12-col">
                <h2>Deposits</h2>
                <table
                        id='deposits'
                        class='mdl-data-table mdl-shadow--6dp wide'
                >
                    <thead>
                    <tr>
                        <th class='mdl-data-table__cell--non-numeric'>Date</th>
                        <th class='mdl-data-table__cell--non-numeric'>ID</th>
                        <th class='mdl-data-table__cell--non-numeric'>Items
                        </th>
                        <th class='mdl-data-table__cell--non-numeric'>Chips
                        </th>
                        <th class='mdl-data-table__cell--non-numeric'>Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (empty($deposits[0]))
                        <tr>
                            <td
                                    colspan='5'
                                    class='mdl-data-table__cell--non-numeric'
                            >You have not made any deposits
                                yet.
                            </td>
                        </tr>
                    @else
                        @foreach($deposits as $deposit)
                            <tr>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $deposit->created_at }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $deposit->trade_offer_id }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $deposit->item_names }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $deposit->items_value }}</td>
                                <td class='mdl-data-table__cell--non-numeric {{ ($deposit->status == 'DONE') ? 'trade-done' : 'trade-waiting' }}'>{{ $deposit->status }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="mdl-cell mdl-cell--12-col">
                <h2>Withdrawals</h2>
                <table
                        id='withdrawals'
                        class='mdl-data-table mdl-shadow--6dp wide'
                >
                    <thead>
                    <tr>
                        <th class='mdl-data-table__cell--non-numeric'>Date</th>
                        <th class='mdl-data-table__cell--non-numeric'>ID</th>
                        <th class='mdl-data-table__cell--non-numeric'>Items
                        </th>
                        <th class='mdl-data-table__cell--non-numeric'>Chips
                        </th>
                        <th class='mdl-data-table__cell--non-numeric'>Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (empty($withdrawals[0]))
                        <tr>
                            <td
                                    colspan='5'
                                    class='mdl-data-table__cell--non-numeric'
                            >You have not made any withdrawals
                                yet.
                            </td>
                        </tr>
                    @else
                        @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $withdrawal->created_at }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $withdrawal->trade_offer_id }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $withdrawal->item_names }}</td>
                                <td class='mdl-data-table__cell--non-numeric'>{{ $withdrawal->items_value }}</td>
                                <td class='mdl-data-table__cell--non-numeric {{ ($deposit->status == 'DONE') ? 'trade-done' : 'trade-waiting' }}'>{{ $withdrawal->status }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--2-col"></div>
    </div>
@endsection