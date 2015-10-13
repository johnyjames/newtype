@extends('layout')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div class="row" style="margin-top: 5%;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="Vader">First Part</label>
                    <input type="text" class="form-control" id="Vader" name="Vader" placeholder="How are you today?">
                </div>
                <div class="form-group">
                    <label for="Luke">Second Part</label>
                    <input type="text" class="form-control" id="Luke" name="Luke" placeholder="Not too bad!">
                </div>

                <button type="submit" class="btn btn-success">Create Link to share</button>
            </form>

            <div style="display: none;">
                <div class="form-group">
                    <input type="text" class="form-control" id="link" name="Link">
                </div>
                <button type="button" class="btn btn-info">Copy</button>
                <button type="button" class="btn btn-primary">Preview</button>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

@section('page-scripts')


@endsection
