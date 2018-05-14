<div class="mdl-card mdl-shadow--16dp @isset($wide) wide @endisset">
    <div class="mdl-card__title">
        <img
                alt="Userpanel" src="{{env('APP_STATIC_URL')}}chipbar-256.png"
                class="center"
        >
    </div>
    <div class="mdl-card__supporting-text">
        <a id='update_my_poker' href='#' class="float-right" title='Refresh'>
            <i class="material-icons">autorenew</i>
        </a>
        <br><br>
        <p id='my_poker_overview'>
            Username: <span
                    class="float-right"
            >{{ $user['poker']['player'] }}</span><br>
            Total Balance: <span
                    class="float-right balance"
            >{{ $user['poker']['balance'] }}</span><br>
            InPlay (Cashgame): <span
                    class="float-right inplay-cg"
            >{{ $user['poker']['ringChips'] }}</span><br>
            InPlay (Tourney): <span
                    class="float-right inplay-tourney"
            >{{ $user['poker']['regChips'] }}</span><br>
            First Login: <span
                    class="float-right"
            >{{ $user['poker']['firstLogin'] }}</span><br>
            Last Login: <span
                    class="float-right"
            >{{ $user['poker']['lastLogin'] }}</span><br>
            Equal Rake: <span
                    class="float-right equal-rake"
            >{{ $user['poker']['eRake'] }}</span><br>
            Proportional Rake: <span
                    class="float-right prop-rake"
            >{{ $user['poker']['pRake'] }}</span><br>
            Tournament Fees: <span
                    class="float-right tourney-fees"
            >{{ $user['poker']['tourneyFees'] }}</span><br>
            Deposits: <span
                    class="float-right"
            >{{ $user['bank']['timesDeposited'] }}</span><br>
            In Value: <span
                    class="float-right"
            >{{ $user['bank']['amountDeposited'] }}</span><br>
            Withdrawals: <span
                    class="float-right"
            >{{ $user['bank']['timesWithdrawn'] }}</span><br>
            In Value: <span
                    class="float-right"
            >{{ $user['bank']['amountWithdrawn'] }}</span><br>
            Profit: <span
                    class="float-right"
            >{{ $user['poker']['profit'] }}</span>
        </p>
    </div>
</div>