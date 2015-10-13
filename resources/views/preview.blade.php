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
                    .describe("Vader", {speed: .8, accuracy: .6, invincibility: 4}, "#vader")
                    .describe("Luke", .6, "#luke");

            theater
                    .on("*", function (eventName, originalEvent, sceneName, arg) {

                    })
                    .on("say:start, erase:start", function (eventName) {
                        var self = this,
                                current = self.current.voice;

                        self.utils.addClass(current, "saying");
                    })
                    .on("say:end, erase:end", function (eventName) {
                        var self = this,
                                current = self.current.voice;

                        self.utils.removeClass(current, "saying");
                    });

            theater
                    .write("Vader:How's that little novel you have been ", -3,"working on?")
                    .write("Luke:Yeah i thought so")
                 //   .write({ name: "call", args: [kill, true] })
                    .write(function () {
                        theater.play(true);
                    });

            var body = document.getElementsByTagName("BODY")[0];

            function toggleClass (className) {
                if (typeof className !== "string") className = "red";

                if (theater.utils.hasClass(body, className)) theater.utils.removeClass(body, className);
                else theater.utils.addClass(body, className);
            }


            function kill () {
                console.log('killing');
                var self    = this,
                        delay   = 300,
                        i       = 0,
                        timeout = setTimeout(function blink () {
                            toggleClass("background-color-red");
                            if (++i < 6) timeout = setTimeout(blink, delay);
                            else self.next();
                        }, delay);

                return self;
            }
            window.theater = theater;
        })();
    </script>
@endsection
