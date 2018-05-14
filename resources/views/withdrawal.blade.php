@extends('master')
@section('head')
    <meta
            name="description"
            content="Withdraw your poker winnings and get yourself some nice Counter-Strike:Global Offensive skins"
    />
    <title>Withdraw CS:GO items - spend your winnings!
        | {{config('app.name')}}</title>
@endsection
@section('content')
    <h1 class="inline">Withdraw Items</h1>
    <form action='{{route('withdrawalGetInventory')}}' method='POST'>
        {{csrf_field()}}
        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label pull-right">
            <label for="select_inventory">Which inventory do you want to
                load?</label>
            <select
                    id="select_inventory" name='inventory'
                    class="mdl-selectfield__select" required
            >
                <option value='' disabled selected>Select an Inventory</option>
                @foreach ($bots as $key => $value)
                    <option value='{{$key}}'>{{$key}}</option> @endforeach
            </select>
        </div>
    </form>
    <div
            id="inventory" class="mdl-grid" style='clear: both;'
    >{{-- AJAX --}}</div>
    <div
            id="toolbar"
            class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone mdl-typography--text-center nomargin"
    >
        <div id="selected">{{-- JS --}}</div>
        <form id='withdraw' action='{{route('withdrawItems')}}' method='POST'>
            {{csrf_field()}}
            <input type='hidden' value='' name='inventory'/>
            <input type='hidden' value='' name='items'/>
            <button
                    type='submit'
                    class='mdl-button mdl-js-button mdl-button--raised mdl-button--accent'
            >Withdraw
            </button>
        </form>
    </div>
@endsection
@section('js')
@endsection