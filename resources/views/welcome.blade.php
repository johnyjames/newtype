@extends('layout')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6">

            @if(isset($link))
                <div>
                    <div class="form-group">
                        <a href="/" class=" pull-right btn btn-default">Back</a>
                        <label></label>
                    </div>
                    <div class="form-group">
                        <label for="vader">First Part</label>
                        <input class="form-control" value="{{ $link->vader }}" readonly>
                        <p class="help-block">This is required field.</p>
                    </div>
                    <div class="gap-90"></div>
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
                        <label></label>
                    </div>
                    <div class="form-group">
                        <label for="vader">First Part</label>
                        <input type="text" class="form-control" id="vader" name="vader" placeholder="How are you today?">
                        <p class="help-block">This is required field.</p>
                    </div>
                    <div class="gap-90"></div>
                    <div class="form-group">
                        <label for="luke">Second Part</label>
                        <input type="text" class="form-control" id="luke" name="luke" placeholder="Not too bad!">
                        <p class="help-block" style="height: 25px;">Note: In second part, you can also paste a url to redirect.</p>
                    </div>
                    <div style="text-align: center;width: 470px;">
                        <button type="submit" class="btn btn-success btn-lg ">Create Link to share</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

@section('page-scripts')
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
</script>
@endsection
