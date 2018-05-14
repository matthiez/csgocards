@extends('master')
@section('head')
    <title>Play poker online with CS:GO skins | {{config('app.name')}}</title>
    <style>
        #poker_action {
            position: absolute;
            height: 100%;
        }

        #toggle_cinema {
            z-index: 1;
        }
    </style>
@endsection
@section('content')
    @if ($sessionKey)
        <button
                id='toggle_cinema'
                class='mdl-button mdl-js-button mdl-button--icon float-right'
                type='button'
        ><i
                    class='material-icons'
            >local_movies</i></button>
        <div
                data-mdl-for='toggle_cinema'
                class='mdl-tooltip mdl-tooltip--left'
        >Toggle Cinema Mode
        </div>
        <object
                id='poker_action' type='application/javascript' class='wide'
                data='//{{config('pm.url')}}?LoginName={{ $user['poker']['player'] }}&SessionKey={{ $sessionKey }}'
        ></object>
    @else
        @php logger('Poker: SessionKey not set', ['sessionKey' => $sessionKey, 'user' => $user]) @endphp
        <div class='mdl-cell mdl-cell--12-col mdl-typography--text-center'>
            <strong>Whoops!</strong>
            <p>
                Authentification Error. Try to reload the page.<br>
                Otherwise, feel free to <a
                        href='mailto:{{env('APP_WEBMASTER_MAIL')}}?subject=Bug Report'
                        title='Bug Report'
                >contact an admin</a>.
            </p>
        </div>
    @endif
@endsection

@section('js')
@endsection