@extends('master')
@section('head')
    <meta
            name="description"
            content="Register an account and start to play poker online with CS:GO skins"
    />
    <title>Register an account and get ready to play poker
        | {{config('app.name')}}</title>
    <style>
        .mdl-button--file input {
            cursor: pointer;
            height: 100%;
            right: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 300px;
            z-index: 4;
        }

        .mdl-textfield--file .mdl-textfield__input {
            box-sizing: border-box;
            width: calc(100% - 32px);
        }

        .mdl-textfield--file .mdl-button--file {
            right: 0;
        }
    </style>
@endsection
@section('content')
    <div class='mdl-grid'>
        <div class="mdl-cell mdl-cell--2-col">
        </div>
        <div class="mdl-cell mdl-cell--8-col mdl-grid">
            <div class='mdl-cell mdl-cell--12-col mdl-typography--text-center'>
                <h1 class="center">Register Account</h1>
            </div>
            <form
                    action='{{route('createAccount')}}' method='POST'
                    enctype='multipart/form-data'
            >
                {{csrf_field()}}
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide">
                        <input
                                name='player' type='text'
                                class='mdl-textfield__input' pattern='.{3,12}'
                                title='Nickname: 3 to 12 alpha-numeric characters, dashes or underscores'
                                value='{{old('player')}}' required
                        />
                        <label for='player' class='mdl-textfield__label'>Username</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label wide">
                        <input
                                name='location' type='text'
                                class='mdl-textfield__input' pattern='.{1,30}'
                                title='Location: 1 to 30 characters'
                                value='{{old('location')}}' required
                        />
                        <label for='location' class='mdl-textfield__label'>Location</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <span style='color: #ff5252;'>Gender</span>
                    <span style='float: right;'>
                        <label
                                for='male'
                                class='mdl-radio mdl-js-radio mdl-js-ripple-effect'
                        >
                            <input
                                    id='male' name='gender' type='radio'
                                    class='mdl-radio__button' value='Male'
                                    @if (old('gender') === 'Male' || !old('gender')) checked @endif />
                            <span class="mdl-radio__label">Male</span>
                        </label>
                        <label
                                for='female'
                                class='mdl-radio mdl-js-radio mdl-js-ripple-effect'
                        >
                            <input
                                    id='female' name='gender' type='radio'
                                    class='mdl-radio__button' value='Female'
                                    @if (old('gender') === 'Female') checked @endif />
                            <span class="mdl-radio__label">Female</span>
                        </label>
                    </span>
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                    <span style='color: #ff5252;'>Avatar</span><span
                            style='float: right;'
                    >Upload your own or select an avatar to be displayed to others.</span>
                    <div class="mdl-file mdl-js-file mdl-file--floating-label wide">
                        <input
                                id="custom_avatar" type="file"
                                name="customAvatar" accept=".gif,.png"
                        >
                        <label for="custom_avatar" class="mdl-file__label">Upload
                            your own</label>
                    </div>
                    @for ($i = 1; $i < Config::get('poker.avatarMax'); $i++)
                        <div class='inline'>
                            <input
                                    id='avatar{{$i}}' type='radio'
                                    class='avatar-input' name='avatar'
                                    value='{{$i}}'
                                    @if ((int)old('avatar') === $i || $i === 1) checked @endif />
                            <label
                                    class='avatar-label' for='avatar{{$i}}'
                                    style='background: url("{{Config::get('poker.avatarsUrl')}}") no-repeat -{{($i * Config::get('poker.avatarSize'))}}px 0; @if ((int)old('avatar') === $i) outline: 1px dotted grey; @endif'
                            ></label>
                        </div>
                    @endfor
                </div>
                <div class="mdl-cell mdl-cell--12-col mdl-typography--text-center">
                    <input
                            type='submit'
                            class='mdl-button mdl-js-button mdl-button--raised mdl-button--accent'
                            value='Create Account'
                    />
                </div>
            </form>
        </div>
        <div class="mdl-cell mdl-cell--2-col">
        </div>
    </div>
@endsection
@section('js')
@endsection