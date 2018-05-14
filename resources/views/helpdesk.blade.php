@extends('master')
@section('head')
    <meta name='description' content='Helpdesk: FAQs How-Tos, Support'/>
    <title>Helpdesk | {{config('app.name')}}</title>
    <style>
        @media (min-width: 1024px) {
            .inline-desktop {
                display: inline
            }
        }

        @media (max-width: 414px) {
            .text-center-small {
                text-align: center
            }
        }
    </style>
@endsection
@section('content')
    <h1 class='text-center'>Helpdesk</h1>
    <div class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-grid mdl-grid--no-spacing">
            <div class="mdl-cell mdl-cell--2-col">
                <div class="mdl-tabs__tab-bar">
                    <a
                            href="#faq" title='FAQ'
                            class="mdl-tabs__tab is-active text-center-small"
                    ><span
                                class="hollow-circle"
                        ></span>FAQ</a>
                    <a
                            href="{{ url('info#tos')  }}"
                            title='Terms of Service'
                            class="mdl-tabs__tab text-center-small"
                    >ToS</a>
                    <a
                            href="#custom_ring_games" title='Custom Ring Games'
                            class="mdl-tabs__tab text-center-small"
                    >Custom
                        Ring Games</a>
                    <a
                            href="#how_to_play_texas_holdem"
                            title="How to play Texas Hold'Em Poker"
                            class="mdl-tabs__tab text-center-small"
                    >How To: Texas Hold'em</a>
                    <a
                            href="#how_to_play_omaha"
                            title='How to play Omaha Poker'
                            class="mdl-tabs__tab text-center-small"
                    >How To: Omaha</a>
                    <a
                            href="#how_to_play_razz"
                            title='How to play Razz Poker'
                            class="mdl-tabs__tab text-center-small"
                    >How
                        To: Razz</a>
                    <a
                            href="#how_to_play_stud"
                            title='How to play Stud Poker'
                            class="mdl-tabs__tab text-center-small"
                    >How
                        To: Stud</a>
                    <a
                            href="{{ url('info#credits')  }}" title='Credits'
                            class="mdl-tabs__tab text-center-small"
                    >Credits</a>
                    {{--                    @if (Auth::check())
                                            <a href="{{ url('tickets')  }}" title='Tickets' class="mdl-tabs__tab text-center-small">Tickets</a>
                                        @endif--}}
                </div>
            </div>
            <div class="mdl-cell mdl-cell--10-col">
                <div id="faq" class="mdl-tabs__panel is-active">
                    <section>
                        <h2 class='text-center-small'>FAQ</h2>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            How can I get in touch with you?</h3>
                        <p>
                            You may use our internal ticket system or you can
                            also
                            <a href='mailto:{{env('APP_WEBMASTER_MAIL')}}'>send
                                us an email</a>.
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            Can I deposit/withdraw items if I'm affected by
                            trade holds?</h3>
                        <p>
                            If you do not have mobile authentication activated
                            and fully set up, you will not be able to
                            deposit or withdraw items.
                            <a
                                    href='https://support.steampowered.com/kb_article.php?ref=8078-TPHC-6195'
                                    class='external-link'
                                    title='Steam: All about Escrow'
                                    target='_blank'
                            >Read
                                more...</a>
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            Why are some of my items not showing up when trying
                            to deposit?</h3>
                        <p>
                            Only applicable items will be shown to you. We
                            accept most items but not all, due to high
                            fluctuation or bad availability.
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            Can I take part in giveaways without playing on the
                            site?</h3>
                        <p>
                            Yes you can. All you have to do is to make sure
                            that you are logged in in order to take part
                            in a giveaway. Good luck!
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            Do you take a fee for playing?</h3>
                        <p>
                            We do keep a maximum of 5% of each game. This
                            amount is also referred to as the rake amount.
                            This rule does not apply for poker tournaments,
                            where we will take a fixed fee instead.
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            Are there any items that you do not accept?</h3>
                        <p>
                            We are currently not accepting Souvenir items.
                            There may be other items we are not going to
                            accept as well. Items with very fluctuating prices
                            are the ones to be mostly affected by
                            this.
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            What poker variants do you offer?</h3>
                        <p>
                            We offer a wide range of various poker games. Below
                            you can see an overview of our cashgame
                            tables.
                        </p>
                        <figure>
                            <figcaption class="text-center">Poker Variants
                            </figcaption>
                            <table class='mdl-data-table mdl-shadow--8dp wide'>
                                <thead>
                                <tr>
                                    <th>Game</th>
                                    <th>No Limit</th>
                                    <th>Fixed Limit</th>
                                    <th>Pot Limit</th>
                                    <th>High/Low</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Hold'em</td>
                                    <td>yes</td>
                                    <td>yes</td>
                                    <td>yes</td>
                                    <td>no</td>
                                </tr>
                                <tr>
                                    <td>Omaha</td>
                                    <td>yes</td>
                                    <td>no</td>
                                    <td>yes</td>
                                    <td>yes</td>
                                </tr>
                                <tr>
                                    <td>Razz</td>
                                    <td>no</td>
                                    <td>no</td>
                                    <td>yes</td>
                                    <td>no</td>
                                </tr>
                                <tr>
                                    <td>Stud</td>
                                    <td>no</td>
                                    <td>no</td>
                                    <td>yes</td>
                                    <td>no</td>
                                </tr>
                                </tbody>
                            </table>
                            <p class='text-center'>On top of that we also offer
                                regular tournaments with fixed entry
                                fees as well as scheduled freerolls with no
                                buy-in fee and a guaranteed prize pool.</p>
                        </figure>
                    </section>
                </div>
                <div id="custom_ring_games" class="mdl-tabs__panel">
                    <section>
                        <h2 class='text-center-small'>Custom Games</h2>
                        <p>
                            Users are able to create their own private game.
                            Every custom table is password-protected so
                            nobody unwanted can join.
                        </p>
                        <h3 class='mdl-typography--body-2 mdl-color--red mdl-color-text--white roller smooth inline-desktop text-center-small'>
                            How to create my own custom game?</h3>
                        <ol>
                            <li>Navigate to <a
                                        href='{{ url('poker') }}' title='Poker'
                                >Poker</a>.
                            </li>
                            <li>Click on the red round button on the lower
                                right side of your screen.
                            </li>
                            <li>Go to 'Create a Ring Game' and select your game
                                of choice.
                            </li>
                            <li>A modal will pop up. Follow the steps as
                                explained there.
                            </li>
                            <li>Remember to save the password in a safe
                                place.
                            </li>
                            <li>You can now enter your own custom game just
                                like you enter a regular table, you only
                                need to enter the password.
                            </li>
                            <li>Good luck and have fun!</li>
                        </ol>
                    </section>
                </div>
                <div id="how_to_play_texas_holdem" class="mdl-tabs__panel">
                    <section>
                        <h2 class='text-center-small'>How to play Texas Hold'Em
                            Poker</h2>
                        <p>
                            The probably most popular poker variant. The best
                            5-card hand using any combination of the
                            five community cards and two hole cards wins.<br>
                            A standard deck of 52 playing cards is being used,
                            where '2' is the lowest and 'Ace' is the
                            highest valued card.<br>
                            We cover the three most popular Texas Hold'Em
                            variants:
                        </p>
                        <ul>
                            <li>Fixed Limit – each betting round has a fixed
                                bet size.
                            </li>
                            <li>Pot-Limit – bet any amount from the minimum bet
                                to the size of the pot.
                            </li>
                            <li>No-Limit – bet any amount from the minimum bet
                                to the maximum number of chips they
                                have.
                            </li>
                        </ul>
                        <p>
                            The pricinciple is the same for all three variants.
                            Only the maximum allowed bet size
                            differs.<br>
                            However, profitable players will adapt their
                            playstyle according to the played poker
                            variant.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Button</h4>
                        <p>
                            The button position is indicated by the so-called
                            dealer button.<br>
                            The button deals out cards to other players from
                            this position.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Blinds</h4>
                        <p>
                            Every single hand of Hold'em starts with two
                            blinds, the small blind and the big blind.<br>
                            Blinds are opening bets made by two players before
                            any cards are being dealt.<br>
                            They strongly encourage players to fight for the
                            pot, even with less good starting
                            hands.<br>
                            The small blind is usually the half of the big
                            blind. A big blind is also the minimum bet
                            for a round.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Betting</h4>
                        <p>
                            Every bet can be raised by another player.<br>
                            There may be a maximum number of allowed raises,
                            the so-called cap.<br>
                            In No Limit Hold'em one can bet all of his
                            available chips without limitations.
                            In Fixed Limit Hold'em one can bet the amount of
                            the big blind. Not more, not less. If
                            anyone wishes to raise then they can do so only in
                            increments of the big blind.
                            In Pot Limit Hold'em one can bet the maximum of the
                            pot value. Any raise has to be at least
                            the previous bet but again with a maximum of the
                            complete pot value.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Pre-Flop</h4>
                        <p>
                            Every player gets dealt two cards face down – also
                            referred to as 'hole cards'.<br>
                            This is the first betting round. There are no
                            community cards yet.<br>
                            Usually a player with a strong starting hand would
                            make an initial bet to protect his hand
                            against worse ones.<br>
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Flop</h4>
                        <p>
                            The second betting round.<br>
                            Three community cards will be dealt.<br>
                            All players who are still in the hand can place
                            their bets.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            Turn</h4>
                        <p>
                            The third betting round.<br>
                            This time only one community gets dealt.<br>
                            Players who are still in the hand may place bets.
                        </p>
                        <h4 class='mdl-typography--display-1-color-contrast text-center-small'>
                            River</h4>
                        <p>
                            The fourth and last betting round.<br>
                            Again, one community card gets dealt.<br>
                            And again, all players who are still in the hand
                            can make bets.<br>
                            After that, the players will show their cards and
                            the best 5-card combination wins.
                        </p>
                        <h3 id='omaha' class='text-center-small'>Omaha</h3>
                        <p>
                            We are working on some good content. You can expect
                            to see more very soon!
                        </p>
                        <h3 id='razz' class='text-center-small'>Razz</h3>
                        <p>
                            We are working on some good content. You can expect
                            to see more very soon!
                        </p>
                        <h3 id='stud' class='text-center-small'>Stud</h3>
                        <p>
                            We are working on some good content. You can expect
                            to see more very soon!
                        </p>
                    </section>
                </div>
                <div id="how_to_play_omaha" class="mdl-tabs__panel">
                    <section>
                        <h2 class='text-center-small'>How to play Omaha
                            Poker</h2>
                        <p>
                            We are busy working on some good content. You can
                            expect to see more very soon!
                        </p>
                    </section>
                </div>
                <div id="how_to_play_razz" class="mdl-tabs__panel">
                    <section>
                        <h2 class='text-center-small'>How to play Razz
                            Poker</h2>
                        <p>
                            We are busy working on some good content. You can
                            expect to see more very soon!
                        </p>
                    </section>
                </div>
                <div id="how_to_play_stud" class="mdl-tabs__panel">
                    <section>
                        <h2 class='text-center-small'>How to play Stud
                            Poker</h2>
                        <p>
                            We are busy working on some good content. You can
                            expect to see more very soon!
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection