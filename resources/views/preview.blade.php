@extends('layout')

@section('background',backgroundChooser())

@section('content')
    <div class="center scene">
        <div> <span id="vader"></span></div>
        <div> <span id="luke"></span></div>
    </div>
@endsection

@section('page-scripts')
    <script src="js/theater.js"></script>
    <script>
        (function () {
            "use strict";


            var theater = new TheaterJS();

            theater
                    .describe("Vader", {speed: .8, accuracy: 1, invincibility: 4}, "#vader")
                    .describe("Luke", .6, "#luke");

            theater
                    .write("Vader:{{ $link->vader }} ")
                    .write({
                        name: "call",
                        args: [
                            function () {
                                var self = this;
                                $('body').animate({backgroundColor: "#fff"}, 'slow');
                                setTimeout(function () {
                                    self.next();
                                    console.log('going to second');
                                }, 1000);
                            },
                            true
                        ]
                    })
                    .write(function () {
                        theater.play(false);
                    });
            theater
                    .write("Vader:{{ $link->luke }} ")
                    .write({
                        name: "call",
                        args: [
                            function () {
                                setTimeout(function () {
                                    theater.stop();
                                    console.log('completed');
                                }, 1000);
                            },
                            true
                        ]
                    })
                    .write(function () {
                        theater.play(false);
                    });



            window.theater = theater;
        })();
    </script>
@endsection
