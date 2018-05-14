@extends('master')
@section('head')
    <meta name="robots" content="noindex, nofollow"/>
    <meta name='description' content='Counter-Strike Global:Offensive News'/>
    <title>Counter-Strike Global:Offensive News
        | {{config('app.name')}}</title>
@endsection
@section('content')
    <h1 class='text-center'>CS:GO News</h1>
    <h2 class="mdl-typography--headline text-center">News around
        Counter-Strike: Global Offensive</h2>
    <div class='mdl-grid'>
        @foreach ($news as $single)
            <div class='mdl-cell mdl-cell--6-col'>
                <h3 class='mdl-typography--caption text-center'><a
                            href='{!! $single->url !!}'
                            target='_blank'
                    >{{ $single->title }}</a></h3>
                <div class="news">
                    {!! $single->contents !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection