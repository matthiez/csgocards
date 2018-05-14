<?php
Route::get('faq.php', function() {
    return Redirect::to('helpdesk#faq', 301);
});

Route::get('home', function() {
    return Redirect::to('/', 301);
});

Route::get('register', function() {
    return Redirect::to('registration', 301);
});

Route::get('withdraw', function() {
    return Redirect::to('withdrawal', 301);
});

Route::get('tickets', function() {
    return Redirect::to('/', 301);
});

Route::get('tos.php', function() {
    return Redirect::to('info#tos', 301);
});

Route::get('withdraw', function() {
    return Redirect::to('withdrawal', 301);
});

Route::get('/', function() {
    return view('home');
})->name('home');

Route::get('csgo-news', function() {
    return view('csgo-news');
})->name('csgoNews');

Route::get('helpdesk', function() {
    return view('helpdesk');
})->name('helpdesk');

Route::get('info', function() {
    return view('info');
})->name('info');

Route::get('login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'auth.steam'], function() {
    Route::get('bossarea',
        'AdminController@index'); /* TODO: add admin middleware */

    Route::get('bossarea/update-prices',
        'AdminController@updatePrices')
        ->name('updatePrices');  /* TODO: add admin middleware */

    Route::post('deposit/go', 'DepositController@deposit')
        ->name('depositItems');

    Route::post('registration/createAccount',
        'UserController@createAccount')->name('createAccount');

    Route::post('user/setTradeLink', 'UserController@setTradeLink')
        ->name('userSetTradeLink');

    Route::post('user/setTimezone', 'UserController@setTimezone')
        ->name('userSetTimezone');

    Route::post('withdrawal/go',
        'WithdrawalController@withdrawItems')
        ->name('withdrawItems');

    Route::post('withdrawal/getInventory',
        'WithdrawalController@getInventory')
        ->name('withdrawalGetInventory');

    Route::post('logout', function() {
        Request::session()->flush();
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::group(['middleware' => 'check.reg'], function() {
        Route::get('deposit', function() {
            return view('deposit');
        })->name('deposit');

        /*History derives from SteamID - reg is technically not needed, we require it anyways*/
        Route::get('history', function() {
            return view('history');
        })->name('history');

        Route::get('withdrawal', function() {
            return view('withdrawal');
        })->name('withdrawal');

        Route::get('dashboard', function() {
            return view('dashboard');
        })->name('dashboard');

        Route::get('poker', function() {
            return view('poker');
        })->name('poker');

        Route::get('pokerProfile',
            'UserController@pokerProfile')->name('pokerProfile');

        Route::get('profile/{steamId}',
            'UserController@getProfile')->name('getProfile');

        Route::get('registration', function() {
            return view('registration');
        })->name('registration');

        Route::get('statistics', function() {
            return view('statistics');
        })->name('statistics');

        Route::post('enterGiveaway',
            'GiveawayController@enter')
            ->name('enterGiveaway');

        Route::post('poker/createRingGame',
            'CustomGameController@createRingGame')
            ->name('pokerCreateRingGame');

        Route::post('poker/createRingGameHoldEmOmaha',
            'CustomGameController@createRingGameHoldEmOmaha')
            ->name('pokerCreateRingGameHoldEmOmaha');

        Route::post('poker/createRingGameRazzStud',
            'CustomGameController@createRingGameRazzStud')
            ->name('pokerCreateRingGameRazzStud');

        Route::post('poker/deleteCustomGames',
            'CustomGameController@deleteCustomGames')
            ->name('pokerDeleteCustomGames');

        Route::post('poker/setAvatar',
            'PokerController@setAvatar')
            ->name('pokerSetAvatar');

        Route::post('poker/setAvatarCustom',
            'PokerController@setAvatarCustom')
            ->name('pokerSetAvatarCustom');

        Route::post('poker/setLocation',
            'PokerController@setLocation')
            ->name('pokerSetLocation');
    });
});