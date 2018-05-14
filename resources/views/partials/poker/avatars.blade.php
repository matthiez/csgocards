<form action='{{route('pokerSetAvatar')}}' method='POST'>
    {{csrf_field()}}
    @for ($i = 1; $i < Config::get('poker.avatarMax'); $i++)
        <div class='inline'>
            <input
                    id='avatar{{$i}}' type='radio' class='avatar-input'
                    name='avatar' value='{{$i}}'
                    @if ((int)old('avatar') === $i || $i === 1) checked @endif />
            <label
                    class='avatar-label' for='avatar{{$i}}'
                    style='background: url("{{Config::get('poker.avatarsUrl')}}") no-repeat -{{($i * Config::get('poker.avatarSize'))}}px 0; @if ((int)old('avatar') === $i) outline: 1px dotted grey; @endif'
            ></label>
        </div>
    @endfor
</form>