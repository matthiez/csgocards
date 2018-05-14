@extends('master')
@section('head')
    <meta
            name='description'
            content='Deposit Counter-Strike:Global Offensive skins and play poker online with CS:GO skins'
    />
    <title>Deposit CS:GO items and start playing
        | {{config('app.name')}}</title>
    <script>
        @foreach($inventory as $i)
        window.UserData.Inventory.push({!! json_encode($i) !!})
        @endforeach
    </script>
@endsection
@section('content')
    <div id='inventory-value' class='text-center'>{{-- JS --}}</div>
    <button
            id='reload' type='button'
            class='mdl-button mdl-js-button mdl-button--raised mdl-button--accent'
            onclick='location.reload();'
    >Reload
    </button>
    <div class='text-center'>
        <h1>Deposit Items</h1>
        <b>Only CS:GO items accepted.</b>
    </div>
    <div class='mdl-grid'>
        @if ($steamDown)
            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--4-col-phone mdl-typography--text-center'>
                <p>
                    The Steam API is not reachable at this point.<br>
                    Please try again in a couple of minutes.
                    <a
                            href='https://support.steampowered.com/kb_article.php?ref=4113-YUDH-6401'
                            target='_blank'
                            class='' title='Guide: Steam Profile Privacy'
                    >Is your inventory private?</a>
                </p>
            </div>
        @elseif (count($inventory) === 0)
            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--4-col-phone mdl-typography--text-center'>
                <p>
                    Your inventory is empty or set to private.<br>
                    <a
                            href='https://support.steampowered.com/kb_article.php?ref=4113-YUDH-6401'
                            target='_blank'
                            class='' title='Guide: Steam Profile Privacy'
                    >Is your inventory private?</a>
                    Please try again later.
                </p>
            </div>
        @else
            <div id='inventory' class='mdl-grid'></div>
            {{--            <div id='inventory' class='mdl-grid'> @foreach ($inventory as $item)
                                @php $value = \App\Deposit::getItemValue($item['market_hash_name']); @endphp
                                @if ($value != 0)
                                    <div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--4-col-phone item-container' data-markethashname='{{ $item['market_hash_name'] }}' data-value='{{ $value }}' data-selected='0' data-assetid='{{ $item['assetid'] }}'>
                                        <div class='rarity' style='border-top: 3px solid #{{ \App\Traits\Helper::getHexColorForItemRarity($item['type']) }};'></div>
                                        <div class='helper'>
                                            <span class='value'>{{ $value }}</span>
                                            <span><img src='{{env('APP_STATIC_URL')}}poker-chip-16.png' alt='value'/></span>
                                        </div>
                                        <div class='thumb'>
                                            <img src='http://steamcommunity-a.akamaihd.net/economy/image/{{ $item['icon_url'] }}/150fx150f' alt='{{ $item['market_hash_name'] }}' class='center'/>
                                        </div>
                                        <div class='name text-center'>{{ $item['market_hash_name'] }}</div>
                                    </div>
                                @endif
                        @endforeach</div>--}}
            <div
                    id='toolbar'
                    class='mdl-cell mdl-cell--12-col-desktop mdl-cell--4-col-phone mdl-typography--text-center nomargin'
            >
                <div id='selected'></div>
                <form
                        id='deposit' action='{{route('depositItems')}}'
                        method='POST'
                >
                    {{csrf_field()}}
                    <input type='hidden' value='' name='items'/>
                    <button
                            type='submit'
                            class='mdl-button mdl-js-button mdl-button--raised mdl-button--accent'
                    >
                        Deposit
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection