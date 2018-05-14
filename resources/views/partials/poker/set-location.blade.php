<form action='{{route('pokerSetLocation')}}' method='POST'>
    {{csrf_field()}}
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @isset ($wide) wide @endisset">
        <input
                id='location' name='location' type='text'
                class='mdl-textfield__input' pattern='.{1,30}'
                title='Location: 1 to 30 characters'
                value='{{$user['poker']['location']}}' required
        />
        <label for='location' class='mdl-textfield__label'>Set Location</label>
    </div>
</form>