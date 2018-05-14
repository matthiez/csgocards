<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, minimum-scale=1.0"
    />
    <meta name="mobile-web-app-capable" content="yes"/>
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="theme-color" content="#ffffff"/>
    <meta
            name="msapplication-config"
            content="{{public_path('browserconfig.xml')}}"
    />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <link rel="icon" href="{{public_path('favicon.ico')}}"/>
    <link
            rel="icon" type="image/png"
            href="{{public_path('favicon-32x32.png')}}" sizes="32x32"
    />
    <link
            rel="icon" type="image/png"
            href="{{public_path('favicon-16x16.png')}}" sizes="16x16"
    />
    <link rel="manifest" href="{{public_path('manifest.json')}}"/>
    <link
            rel="mask-icon" href="{{public_path('safari-pinned-tab.svg')}}"
            color="#000000"
    />
    <link
            rel="apple-touch-icon" sizes="180x180"
            href="{{public_path('apple-touch-icon.png')}}"
    />
    <link rel="stylesheet" href="{{mix('css/app.css')}}"/>

    <script>
      !function (e, t, a, n, c, s, o) {
        e.GoogleAnalyticsObject = c, e[c] = e[c] || function () {
          (e[c].q = e[c].q || []).push(arguments)
        }, e[c].l = 1 * new Date, s = t.createElement(a), o = t.getElementsByTagName(a)[0], s.async = 1, s.src = n, o.parentNode.insertBefore(s, o)
      }(window, document, "script", "https://www.google-analytics.com/analytics.js", "ga"), ga("create", "UA-87922703-1", "auto"), ga("send", "pageview")

      window.App = {
        staticUrl: '{!! env('APP_STATIC_URL') !!}'
      }

      window.UserData = {
        Bank: {@isset ($user['bank']) @foreach ($user['bank'] as $k => $v) '{{ $k }}': '{{ $v }}', @endforeach @endisset },
        General: {@isset ($user['general']) @foreach ($user['general'] as $k => $v) '{{ $k }}': '{{ $v }}', @endforeach @endisset },
        Steam: {@isset ($user['steam']) @foreach ($user['steam'] as $k => $v) '{{ $k }}': '{{ $v }}', @endforeach @endisset },
        Poker: {@isset ($user['poker'])  @foreach ($user['poker'] as $k => $v) '{{ $k }}': '{{ $v }}', @endforeach @endisset },
        Inventory: []
      }
    </script>
    @yield('head')
</head>
<body>
<div class="mdl-layout mdl-js-layout">
    @include('partials.header')
    @include('partials.drawer')
    <main class='mdl-layout__content' role='main'>
        <div id='top'></div>
        @if (count($errors) > 0)
            <div class='error'>
                <span
                        class='closebtn'
                        onclick='this.parentElement.style.display="none";'
                >&times;</span>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class='error'>
                <span
                        class='closebtn'
                        onclick='this.parentElement.style.display="none";'
                >&times;</span>
                <p>{{ session('error') }}</p>
                @php Session::forget('error') @endphp
            </div>
        @endif
        @if (session('info'))
            <div class='info'>
                <span
                        class='closebtn'
                        onclick='this.parentElement.style.display="none";'
                >&times;</span>
                <p>{{ session('info') }}</p>
                @php Session::forget('info') @endphp
            </div>
        @endif
        @yield('content')
    </main>
    @yield('footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>
</html>