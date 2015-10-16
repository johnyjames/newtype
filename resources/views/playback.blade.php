@extends('layout')
@section('background',backgroundChooser())
@section('header')
    {{--@include('partials.header')--}}
    <style>
        #playback {
            border: none;
            overflow: auto;
            outline: none;

            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;

            background: transparent;
            resize: none;
        }
    </style>
@endsection

@section('content')
    <h1>Playback Test</h1>
    <div class="scene">
        <textarea id="playback" readonly  ></textarea>
    </div>
    <div class="form-group">
        <label for="vader">First Part</label>
        <input type="text" class="form-control" id="recorder" name="recorder" placeholder="How are you today?">
    </div>

    <p>Complete the typing and click outside the box</p>
@endsection

@section('page-scripts')
    <script>
        var Playback = {
            //store the time an action occured and the resulting state in an object
            //don't use an array because they are not sparce - interstitial keys
            //will have to be iterated over
            record: {},
            init: function( recorderId, playbackId ) {
                this.recorder = document.getElementById( recorderId );
                this.playback = document.getElementById( playbackId );

                this.recorder.addEventListener( 'focus', function() {
                    Playback.record = {};
                    this.value = '';
                }, false );

                this.recorder.addEventListener( 'keyup', function( e ) {
                    Playback.record[ (new Date()).getTime() ] = this.value;
                }, false );

                this.recorder.addEventListener( 'blur', function( e ) {
                    Playback.playback.value = '';
                    //store the time the sequence started
                    //so that we can subtract it from subsequent actions
                    var mark = null;
                    for( var t in  Playback.record ) {
                        if( mark ) {
                            var timeout = t - mark;
                        } else {
                            var timeout = 0;
                            mark = t;
                        }
                        // We need to create a callback which closes over the value of t
                        // because t would have changed by the time this is run
                        setTimeout( Playback.changeValueCallback( Playback.record[t] ), timeout );
                    }
                }, false );

            },

            changeValueCallback: function( val ) {
                return function() { Playback.playback.value = val }
            }
        }

        Playback.init( 'recorder', 'playback' );
    </script>
@endsection