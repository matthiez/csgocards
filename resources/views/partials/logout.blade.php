<form action='logout' method='POST'>
    {{csrf_field()}}
    <input
            value='{{trans('Logout')}}'
            class='mdl-button mdl-js-button mdl-button--accent center'
            type='submit'
    />
</form>