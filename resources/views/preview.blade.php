@extends('layout')

@section('background',backgroundChooser())
@section('page-styles')
    <link rel="stylesheet" href="/css/share-button.css">
@endsection
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
    <script src="/js/share-button.js"></script>
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
                                var url ="{{ $link->luke }}";
                                    if(ValidURL(url))
                                    {
                                        if (url.toLowerCase().indexOf("http://") < 0) // a url without http? add it.
                                            url= 'http://'+url;

                                        //Indicator of redirection
                                        //$('#vader').html('Redirecting...');


                                        window.location=url;



                                    }
                                    else //not a url, play animation
                                    {
                                        $( "#vader" ).fadeOut( 1000, function() {
                                            $( "#luke" ).show('fast',function(){
                                                self.next();
                                            } );
                                        });
                                    }



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
