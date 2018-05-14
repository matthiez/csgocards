@extends('master')
@section('head')
    <meta
            name='description'
            content='Play poker online for Counter-Strike:Global Offensive skins'
    />
    <title>Play poker online with CS:GO skins | {{config('app.name')}}</title>
@endsection
@section('content')
    <div class='mdl-grid'>
        <div class='mdl-cell mdl-cell--2-col'>
        </div>
        <div class='mdl-cell mdl-cell--8-col'>
            <h1>Information</h1>
            <h2 id='tos'>ToS</h2>
            <p>By using {{env('APP_NAME')}} you are deemed to have read and
                agreed to the following terms and
                conditions. The
                terms and conditions set out below apply to any services used
                by you, the user, on the website
                {{env('APP_NAME')}}. By using {{env('APP_NAME')}} you are
                therefore agreeing with those Terms of Service
                and you are
                responsible for compliance with any applicable local laws.</p>
            <h3>Items</h3>
            <p>{{env('APP_NAME')}} currently only allows Counter-Strike: Global
                Offensive items to be deposited and
                withdrawn. If
                an item you have in your inventory does not show up on the
                deposit page, the item most likely is not
                accepted by our house standards. <a
                        href='{{ url('tickets') }}'
                        title='Contact {{env('APP_NAME')}}'
                >Contact
                    us</a> if you think this item should pass
                through.</p>
            <h3>Losses</h3>
            <p>If any loss occur during a bet caused by a software issue, you
                have 7 days to make a claim by
                <a href='{{ url('tickets') }}' title='Send a Ticket'>sending a
                    ticket</a>. After this period all lost
                items or coins will be considered
                abandoned. They will not be refunded. We advise you to withdraw
                your winnings as soon as possible to
                avoid any issues.</p>
            <h3>Rake</h3>
            <p>{{env('APP_NAME')}} takes 5% of the total value of each pot.
                This does not apply for tournaments with a
                fixed entry
                fee.</p>
            <h3>Bans</h3>
            <p>{{env('APP_NAME')}} reserves the right to remove any user at any
                given time without having to specify a
                particular
                reason. Simply follow the rules and you should be fine.</p>
            <h3>Trades</h3>
            <p>Do not send us trade offers. If you request a deposit or
                withdrawal, we will send you a trade offer. Our
                steam accounts will never add you as a friend. Ignore friend
                requests from users who claim to be
                affiliated with {{env('APP_NAME')}} as there is a high risk of
                an ongoing scam.</p>
            <h3>License</h3>
            <p>{{env('APP_NAME')}} and its licensors own the intellectual
                property rights published on this website. You
                are not
                allowed to republish, sell, reproduce, duplicate completely or
                partially material on this website for a
                commercial purpose. {{env('APP_NAME')}} is not affiliated with
                Valve Corporation, Counter-Strike: Global
                Offensive
                or any other trademarks of the Valve Corporation.</p>
            <h4 id='credits'>Credits</h4>
            <p>
                Icons made
                by&nbsp;<a
                        href='http://www.flaticon.com/authors/freepik'
                        class='external-link' title='Freepik'
                        target='_blank'
                >Freepik</a>
                from <a
                        href='http://www.flaticon.com' title='Flaticon'
                        class='external-link' target='_blank'
                >www.flaticon.com</a>
                are licensed by
                <a
                        href='http://creativecommons.org/licenses/by/3.0/'
                        class='external-link'
                        title='Creative Commons BY 3.0' target='_blank'
                >CC
                    3.0 BY</a>
            </p>
        </div>
        <div class='mdl-cell mdl-cell--2-col'>
        </div>
    </div>
@endsection