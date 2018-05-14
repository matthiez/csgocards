<form
        action='{{route('pokerSetAvatarCustom')}}' method='POST'
        enctype='multipart/form-data'
>
    {{csrf_field()}}
    <div class="mdl-file mdl-js-file mdl-file--floating-label wide">
        <input
                id='custom_avatar' type='file' name='customAvatar'
                accept=".gif,.png" required
        />
        <label for="custom_avatar" class="mdl-file__label">Upload your
            own</label>
    </div>
</form>