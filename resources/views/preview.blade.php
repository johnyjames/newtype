@extends('layout')

@section('background',backgroundChooser())

@section('content')
    <div class="center">
        <div class="scene">
            <div> <span id="vader"></span><span id="luke" style="display: none;"></span></div>
        </div>
        <div class="row col-md-4" id="share" style="display: none;text-align: center">
            <div id="shareBox">
                <h2>Create your own <a href="{{url()}}">here</a></h2>
                <h4>or</h4>
                <div class="form-group">
                    <input   type="text" class="form-control" id="link" name="Link" value="{!! url($link->link) !!}">
                </div>
                {{--<button  onclick="alert('how to share, johny?')" type="button" class="btn btn-info">Share</button>--}}
                <share-button></share-button>
            </div>
        </div>
    </div>

@endsection

@section('page-scripts')
    <script src="js/theater.js"></script>
    <script>
        (function () {
            "use strict";


            var theater = new TheaterJS();

            theater
                    .describe("Vader", {speed: 0.6, accuracy: 1, invincibility: 4}, "#vader")
                    .describe("Luke", {speed: 0.6, accuracy: 1, invincibility: 4}, "#luke")

            theater
                    .write("Vader:{{ $link->vader }}",600)
                    .write({
                        name: "call",
                        args: [
                            function () {
                                var self = this;
                                    if(ValidURL("{{ $link->luke }}"))
                                    {
                                        window.location="{{ $link->luke }}";
                                    }

                                $( "#vader" ).fadeOut( 1000, function() {
                                    $( "#luke" ).show('fast',function(){
                                        self.next();
                                    } );
                                });

//                                setTimeout(function () {
//                                    $('#vader').hide('slow',function()
//                                    {
//                                        $('#luke').show();
//                                        self.next();
//                                        console.log('going to second');
//                                    });
//                                }, 1000);
                            },
                            true
                        ]
                    });

            //second scene
            theater
                    .write("Luke:{{ $link->luke }}",600)
                    .write({
                        name: "call",
                        args: [
                            function () {
                                //theater.stop();
                                $( "#share" ).fadeIn( 3000, function() {
                                    $( "#shareBox" ).fadeIn( 100 );
                                });

                               // $('#share').show(3000);
                                console.log('completed');
                            },
                            true
                        ]
                    })
                    .write(function () {
                        theater.play(false);
                    });


            function ValidURL(str) {
                var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                '(\\:\\d+)?(\/[-a-z\\d%_.~+]*)*'+ // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                '(\\#[-a-z\\d_]*)?$','i'); // fragment locater
                if(!pattern.test(str)) {
                    return false;
                } else {
                    return true;
                }
            }

            window.theater = theater;
        })();
    </script>

    <script>
        var shareButton = new ShareButton();
    </script>

@endsection
