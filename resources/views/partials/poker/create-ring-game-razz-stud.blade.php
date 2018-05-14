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
            <option value='Limit Razz'>Limit Razz</option>
            <option value='Limit Stud'>Limit Stud</option>
            <option value='Limit Stud Hi-Lo'>Limit Stud Hi-Lo</option>
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
                    title='Seats' min='2' max='8' required
            />
            <label for='seats' class='mdl-textfield__label'>Seats</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='smallBet' type='number' class='mdl-textfield__input'
                    title='Small Bet' required
            />
            <label for='smallBet' class='mdl-textfield__label'>Small
                Bet</label>
        </div>
        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide'>
            <input
                    name='bigBet' type='number' class='mdl-textfield__input'
                    title='Big Bet' required
            />
            <label for='bigBet' class='mdl-textfield__label'>Big Bet</label>
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
        <input type='hidden' name='type' value='Razz/Stud'/>
    </div>
</form>