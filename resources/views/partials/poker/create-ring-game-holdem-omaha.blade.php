<form
        class='create_ring_game' action='{{route('pokerCreateRingGame')}}'
        method='POST'
>
    {{csrf_field()}}
    <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
        <select
                name='game' title='Select a Game Type'
                class='mdl-selectfield__select' required
        >
            <option value='' disabled selected>Select a game type</option>
            <option value="Limit Hold'em">Limit Hold'em</option>
            <option value="Pot Limit Hold'em">Pot Limit Hold'em</option>
            <option value="No Limit Hold'em">No Limit Hold'em</option>
            <option value='Limit Omaha'>Limit Omaha</option>
            <option value='Pot Limit Omaha'>Pot Limit Omaha</option>
            <option value='No Limit Omaha'>No Limit Omaha</option>
            <option value='Limit Omaha Hi-Lo'>Limit Omaha Hi-Lo</option>
            <option value='Pot Limit Omaha Hi-Lo'>Pot Limit Omaha Hi-Lo
            </option>
            <option value='No Limit Omaha Hi-Lo'>No Limit Omaha Hi-Lo</option>
        </select>
    </div>
    <div class='config'>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='name' type='text' class='mdl-textfield__input'
                    pattern='.{1,40}'
                    title='Game name: 1 to 40 alpha-numeric characters, dashes or underscores'
                    required
            />
            <label for='name' class='mdl-textfield__label'>Name</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='seats' type='number' class='mdl-textfield__input'
                    title='Seats' min='2' max='10' required
            />
            <label for='seats' class='mdl-textfield__label'>Seats</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='smallBlind' type='number'
                    class='mdl-textfield__input' title='Small Blind' required
            />
            <label for='smallBlind' class='mdl-textfield__label'>Small
                Blind</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='bigBlind' type='number' class='mdl-textfield__input'
                    title='Big Blind' required
            />
            <label for='bigBlind' class='mdl-textfield__label'>Big
                Blind</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='minBuyIn' type='number' class='mdl-textfield__input'
                    title='Minimum Buy-In' required
            />
            <label for='minBuyIn' class='mdl-textfield__label'>Min
                Buy-In</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='maxBuyIn' type='number' class='mdl-textfield__input'
                    title='Maximum Buy-In' required
            />
            <label for='maxBuyIn' class='mdl-textfield__label'>Max
                Buy-In</label>
        </div>
        <div class='text-center'>
            <input
                    type='submit' value='Submit'
                    class='mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect'
            />
        </div>
        <input type='hidden' name='type' value='HoldEm/Omaha'/>
    </div>
</form>