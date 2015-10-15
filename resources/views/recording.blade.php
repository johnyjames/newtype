@extends('layout')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <h1>Recording</h1>
    @foreach( json_decode($link->keyStrokes) as $part)
        {{--<h4>First Part: {{ $link->vader }}</h4>--}}
        <table class="table">
            <tr>
                <td>Key Code</td>
                <td>Time Stamp</td>
            </tr>
            @foreach($part as $stroke)
                <tr>
                    <td>{{ characterName($stroke->key) }}</td>
                    <td>
                        {{  $stroke->timeStamp  }}
                    </td>
                </tr>
            @endforeach
        </table>
        <hr>
    @endforeach

@endsection