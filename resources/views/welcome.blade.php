@extends('layout')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6">

            @if(isset($link))
                <div >
                    <div class="form-group">
                        <a href="/" class=" pull-right btn btn-default">Back</a>
                        <label></label>
                    </div>
                    <div class="form-group">
                        <label for="vader">First Part</label>
                        <label class="form-control">{{ $link->vader }}</label>
                    </div>
                    <div class="form-group">
                        <label for="luke">Second Part</label>
                        <label class="form-control">{{ $link->luke }}</label>
                        <p class="help-block">Note: In second part, you can also paste a url to redirect.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-control" id="link">{!! url($link->link) !!}</label>
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <button  onclick="copyToClipboard('#link')" type="button" class="btn btn-info btn-lg">Copy</button>
                        <a href="{!! url($link->link) !!}" target="_blank" class="btn btn-primary btn-lg">Preview</a>
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
                    </div>
                    <div class="form-group">
                        <label for="luke">Second Part</label>
                        <input type="text" class="form-control" id="luke" name="luke" placeholder="Not too bad!">
                        <p class="help-block">Note: In second part, you can also paste a url to redirect.</p>
                    </div>
                    <div class="form-group" style="text-align: center;">
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
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();


        $('#copy-alert').show();
        setTimeout(function() {
            $('#copy-alert').hide();
        }, 1500);
    }
</script>
@endsection
