@extends('layouts.home')

@section('content')
    <form action="{{ route('home.convert') }}" method="POST" id="text_to_convert">
        @csrf
        <label>
            <input type="text" name="num" value="" id="numBtn" placeholder="Enter a number">
        </label>
    </form>
    <div id="words_result"></div>
    <div id="dollar_result"></div>
@endsection