<!--@extends('layouts/app')-->

<!--@section('content')-->
<!--<h2>Hello, {{ $name }}!</h2>-->
<!--@endsection-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hello {{ $name }}</h1>
    <h2>If condition:</h2>
    <span>
        @if($name === 'Bloom')
            <p>Hi Bloom!</p>
        @elseif($name === 'Jane' or $name == 'John')
            <p>Hi Jane or {{ $name }}!</p>
        @else
            <p>Hi Stranger!</p>
        @endif
    </span>

    <h2>Foreach loop:</h2>
    <ul>
        @foreach($someArray as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</body>
</html>