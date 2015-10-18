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
                        <input type="text" class="form-control"  onpaste="return false;" id="luke" name="luke" placeholder="Not too bad!">
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
    // Register onpaste on inputs and textareas in browsers that don't
    // natively support it.
    (function () {
        var onload = window.onload;

        window.onload = function () {
            if (typeof onload == "function") {
                onload.apply(this, arguments);
            }

            var fields = [];
            var inputs = document.getElementsByTagName("input");
            var textareas = document.getElementsByTagName("textarea");

            for (var i = 0; i < inputs.length; i++) {
                fields.push(inputs[i]);
            }

            for (var i = 0; i < textareas.length; i++) {
                fields.push(textareas[i]);
            }

            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];

                if (typeof field.onpaste != "function" && !!field.getAttribute("onpaste")) {
                    field.onpaste = eval("(function () { " + field.getAttribute("onpaste") + " })");
                }

                if (typeof field.onpaste == "function") {
                    var oninput = field.oninput;

                    field.oninput = function () {
                        if (typeof oninput == "function") {
                            oninput.apply(this, arguments);
                        }

                        if (typeof this.previousValue == "undefined") {
                            this.previousValue = this.value;
                        }

                        var pasted = (Math.abs(this.previousValue.length - this.value.length) > 1 && this.value != "");

                        if (pasted && !this.onpaste.apply(this, arguments)) {
                            this.value = this.previousValue;
                        }

                        this.previousValue = this.value;
                    };

                    if (field.addEventListener) {
                        field.addEventListener("input", field.oninput, false);
                    } else if (field.attachEvent) {
                        field.attachEvent("oninput", field.oninput);
                    }
                }
            }
        }
    })();
</script>
<script>

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

                this.recorder.addEventListener( 'blur', function( e ) {
                    disk.push(Recorder.record);
                    console.log('Recording stored.',keyStrokes);
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
