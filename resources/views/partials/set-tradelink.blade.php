<form action='{{route('userSetTradeLink')}}' method='POST'>
    {{csrf_field()}}
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide">
        <input
                id='trade_link' name='tradeLink' type='url'
                class='mdl-textfield__input'
                value='{{$user['steam']['tradeLink']}}' required
        />
        <label for='trade_link' class='mdl-textfield__label'>Set
            Tradelink</label>
    </div>
</form>