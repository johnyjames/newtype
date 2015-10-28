@extends('layout')

@section('background',backgroundChooser())
@section('page-styles')
    <link rel="stylesheet" href="/css/share-button.css">
@endsection
@section('content')
    <div style="margin-top: 10%;">
        <div class="row" id="scene">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="scene">
                    <span id="playback0"></span>
                    <span id="playback1"></span>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row" id="share" style="display: none;">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="shareBox">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Create your own <a href="{{url()}}">here</a></h2>
                        <h4>or</h4>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <center>
                            <div class="form-group" >
                                <input type="text" class="form-control" id="link" name="Link" value="{!! url($link->link) !!}">
                            </div>
                        </center>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <share-button></share-button>
                    </div>
                </div>
                {{--<button  onclick="alert('how to share, johny?')" type="button" class="btn btn-info">Share</button>--}}
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

@section('page-scripts')

    <script src="/js/share-button.js"></script>

    <script>
        var shareButton = new ShareButton();

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

        //*************Playback System********************************
        var Recordings = <?php echo json_encode($link->keyStrokes ); ?>;
        var slide = 0;


        var Player = {
            play: function(recording,slideIndex)
            {
               // console.log('playing slide:',slide);
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
                    setTimeout(Player.changeValueCallback( recording ,t,slideIndex), timeout );
                }
            },
            changeValueCallback: function( recording,t,slideIndex ) {
                return function() {
                    var text = recording[t],
                        length=Object.keys(recording).length,
                        lastText =recording[Object.keys(recording)[length-1]];

                    var el = '#playback'+slideIndex;
                    $(el).html(text);

                    if(text==lastText)
                    {
                        slide++;
                        //if part two is a url? redirect it
                        var url ="{{ $link->luke }}";
                        if(ValidURL(url))
                        {
                            if (url.toLowerCase().indexOf("http") < 0) // a url without http? add it.
                                url= 'http://'+url;

                            $('#playback0').fadeOut(1000,function(){
                                window.location=url;
                            });
                        }
                        else
                        {
                            if(Recordings.length>=slide)
                            {
                                // console.log('Slide completed:',slide,'of',Recordings.length);
                                clearTimeout(recording.length);
                                $('#playback0').fadeOut(500,function(){
                                    $('#playback1').fadeIn(100,function(){
                                        Player.play(Recordings[1],1);
                                    });
                                });

                            }
                            else
                            {
                                // console.log('Recordings.length>slide:',Recordings.length,slide,Recordings.length>slide);
                                $('#playback1').fadeOut(1000,function(){
                                    $( "#scene" ).fadeOut( 100, function() {
                                        $( "#share" ).fadeIn( 2000, function() {
                                            $("#shareBox").fadeIn( 100 );
                                        });
                                    });
                                });

                            }
                        }


                    }

                }
            }
        };

        if(Recordings)
        {
            Recordings=JSON.parse(Recordings);
           // console.log(Recordings);
            //Play first part
            Player.play(Recordings[slide],slide);
        }


    </script>

@endsection
