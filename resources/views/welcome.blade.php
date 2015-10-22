@extends('layout')

@section('header')
    @include('partials.header')
@endsection
@section('page-styles')

@endsection
@section('content')
    <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6">

            @if(isset($link))
                <div>
                    <div class="form-group">
                        <label for="vader">First Part</label>
                        <input class="form-control" value="{{ $link->vader }}" readonly>
                        <p class="help-block">This is required field.</p>
                    </div>
                    <div class="gap"></div>
                    <div class="form-group">
                        <label for="luke">Second Part</label>
                        <input class="form-control" value="{{ $link->luke }}" readonly>
                        <p class="help-block">Note: In second part, you can also paste a url to redirect.</p>
                    </div>

                    <div>
                        <input  style="width: 206px;margin-left: 125px;margin-bottom: 14px;" class="form-control" id="link" value="{!! url($link->link) !!}" readonly>
                        <div style="text-align: center;width: 206px;margin-left: 125px;" >
                            <button  style="width: 96px;"  onclick="copyToClipboard('#link')" type="button" class="btn btn-info btn-lg">Copy</button>
                            <a       style="margin-left: 10px;width: 96px;"     href="{!! url($link->link) !!}" target="_blank" class="btn btn-primary btn-lg">Preview</a>
                        </div>
                   </div>

                </div>
                <div style="padding: 10px;display: none;" id="copy-alert">
                    <p class="bg-info" style="padding: 10px;">Link has been copied to your clipboard.</p>
                </div>
            @else

                <form method="post" action="/">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="vader">First Part</label>
                        <input type="text" onpaste="return false;" class="form-control" id="vader" name="vader" placeholder="How are you today?">
                        <p class="help-block">This is required field.</p>
                    </div>
                    <div class="gap"></div>
                    <div class="form-group">
                        <label for="luke">Second Part</label>
                        <input type="text" class="form-control"  onpaste="return checkValue(this)" id="luke" name="luke" placeholder="Not too bad!">
                        <p class="help-block" style="height: 25px;">Note: In second part, you can also paste a url to redirect.</p>
                    </div>
                    <div style="text-align: center;width: 470px;">
                        <input type="hidden" id="keyStrokes" name="keyStrokes">
                        <button type="submit" onclick="collectStrokesData()" class="btn btn-success btn-lg ">Create Link to share</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

@section('page-scripts')

<script>
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

    function checkValue(me)
    {
        // Short pause to wait for paste to complete
            setTimeout( function() {
                var text = $(me).val();
                console.log(text);
                if (!ValidURL(text))
                {
                    $(me).val('');
                    console.log('You can paste only a valid url.')
                }

            }, 100);


    };


    function copyToClipboard(element) {

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();


        $('#copy-alert').show();
        setTimeout(function() {
            $('#copy-alert').hide();
        }, 1500);
    }


    @if(!isset($link))

        var Recorder = {
            //store the time an action occurred and the resulting state in an object
            //don't use an array because they are not sparse - interstitial keys
            //will have to be iterated over
            record: {},

            init: function( recorderId,disk) {
                this.recorder = document.getElementById( recorderId );
                this.recorder.addEventListener( 'focus', function() {
                    Recorder.record = {};
                    this.value = '';//clear on re focus? not sure
                }, false );

                this.recorder.addEventListener( 'keyup', function( e ) {
                    Recorder.record[ (new Date()).getTime() ] = this.value;
                }, false );

//                this.recorder.addEventListener( 'focus', function( e ) {
//                    this.recorder.value='';
//                }, false );

                this.recorder.addEventListener( 'blur', function( e ) {
                    disk.push(Recorder.record);
                    //console.log('Recording stored.',keyStrokes);
                }, false );
            }

        };

        //Record first part key strokes
        var keyStrokes=[];

        //First Part Recording
        Recorder.init('vader',keyStrokes);

        //Second Part Recording
        Recorder.init('luke',keyStrokes);

        function collectStrokesData()
        {
            $('#keyStrokes').val(JSON.stringify(keyStrokes));
            console.log(keyStrokes);

        }
    @endif

</script>
@endsection
