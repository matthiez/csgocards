@extends('master')
@section('head')
    <meta name="robots" content="noindex, nofollow"/>
    <meta name='description' content='Administration Area'/>
    <title>Administration | {{config('app.name')}}</title>
    <style>
        .mdl-mini-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 8px 8px;
        }
    </style>
@endsection
@section('content')
    <h1 class='text-center'>Administration</h1>

    <div class='mdl-grid mdl-color--grey-50'>
        <div class='mdl-cell mdl-cell--3-col mdl-cell--4-col-phone mdl-typography--text-center mdl-cell--middle'>
            <a
                    id="update_pricelist"
                    href="{{env('APP_URL')}}bossarea/update-pricelist"
                    title="Update Pricelist"
            >
                <i
                        class="material-icons mdl-color-text--red mdl-icon-48p"
                        role="presentation"
                >autorenew</i>
            </a>
            <div data-mdl-for="update_pricelist" class="mdl-tooltip">Update
                Pricelist from external API
            </div>
        </div>
        <div class='mdl-cell mdl-cell--9-col mdl-cell--4-col-phone mdl-typography--text-center'>
            <table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp wide'>
                <caption>System Stats</caption>
                <thead>
                <tr>
                    <th>Logins</th>
                    <th>Filled Seats</th>
                    <th>Occupied Tables</th>
                    <th>Uptime</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $systemStats->Logins or 'Error' }}</td>
                    <td>{{ $systemStats->FilledSeats or 'Error'}}</td>
                    <td>{{ $systemStats->OccupiedTables or 'Error'}}</td>
                    <td>{{ $systemStats->UpTime or 'Error'}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <footer class='mdl-mini-footer mdl-color--grey-50'>
        <div class='mdl-mini-footer__left-section'>
            <small>
                © 2016 - {{ date("Y") }} {{env('APP_NAME')}} - all rights
                reserved
            </small>
        </div>
        <div class="mdl-mini-footer__right-section">
            <small>Not associated with Valve Corporation</small>
            <address class="inline"><a
                        href="mailto:{{env('APP_WEBMASTER_MAIL')}}"
                >
                    <small>mail</small>
                </a></address>
        </div>
    </footer>
@endsection
@section('js')
    <script>
      $("#update_pricelist").on("click", function (ev) {
        ev.preventDefault()
        $.ajax({
          url: "admin/update-pricelist",
          method: "POST",
          dataType: "json",
          success: function (data) {
            App.notice(data, "success")
          },
          error: function (data) {
            App.notice(data, "error")
          }
        })
      })
    </script>
@endsection