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
    <p>Complete the typing and click play button</p>
    <button type="button" class="btn btn-lg btn-default" onclick="Play()">Play</button>
@endsection

@section('page-scripts')
    <script>
        var Recording;
        var Player = {
            init: function(playbackId)
            {
                this.playback = document.getElementById( playbackId );
            },

            play: function(recording)
            {
                //store the time the sequence started
                //so that we can subtract it from subsequent actions
                var mark = null;
                for( var t in  recording ) {
                    if( mark ) {
                        var timeout = t - mark;
                    } else {
                        var timeout = 0;
                        mark = t;
                    }
                    // We need to create a callback which closes over the value of t
                    // because t would have changed by the time this is run
                    setTimeout( Player.changeValueCallback( recording[t] ), timeout );
                }
            },
            changeValueCallback: function( val ) {
                return function() { Player.playback.value = val }
            }
        };

        var Recorder = {
            //store the time an action occurred and the resulting state in an object
            //don't use an array because they are not sparse - interstitial keys
            //will have to be iterated over
            record: {},
            init: function( recorderId) {
                this.recorder = document.getElementById( recorderId );

                this.recorder.addEventListener( 'focus', function() {
                    Recorder.record = {};
                    this.value = '';
                }, false );

                this.recorder.addEventListener( 'keyup', function( e ) {
                    Recorder.record[ (new Date()).getTime() ] = this.value;
                }, false );

                this.recorder.addEventListener( 'blur', function( e ) {
                    Player.playback.value = '';
                    Recording=JSON.stringify(Recorder.record);
                    console.log('Recording stored');
                }, false );

            }

        };

        Recorder.init( 'recorder');
        Player.init( 'playback');


        function Play()
        {
            var data=JSON.parse(Recording);

            Player.play(data);

            //console.log(JSON.parse(Recording));
        }

    </script>
@endsection