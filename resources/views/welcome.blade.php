<!DOCTYPE html>
<html>
<head>
    <title>Small App</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Cutive">
    <link rel="stylesheet" href="css/app.css">

</head>
<body>

<div class="outer">
    <div class="inner">
        <div class="wrapper">
            <div class="scene">
                <div>- <span id="vader"></span></div>
                <div>- <span id="luke"></span></div>
            </div>
            <pre id="nodebug"><code>
                    theater.write(
                    <span id="log"></span>
                    );
                </code>
            </pre>
        </div>
    </div>
</div>

<script src="js/theater.js"></script>
<script>
    //        // Instantiation
    //        var theater = new TheaterJS();
    //
    //        // Describe actors
    //        theater
    //                .describe("Vader", .8, "#vader")
    //                .describe("Luke", .6, "#luke");
    //
    //        // Write the scenario
    //        theater
    //                .write("Vader:Luke.", 600)
    //                .write("Luke:What?", 400)
    //                .write("Vader:I am...", 400, " your father.");
    //
    //        // Listen to theater's events
    //        theater
    //                .on("say:start, erase:start", function () {
    //                    // add blinking caret
    //                })
    //                .on("say:end, erase:end", function () {
    //                    // remove blinking caret
    //                })
    //                .on("*", function () {
    //                    // do something
    //                });

    (function () {
        "use strict";

        var $log = document.querySelector("#log");
        var theater = new TheaterJS();

        theater
                .describe("Vader", {speed: .8, accuracy: .6, invincibility: 4}, "#vader")
                .describe("Luke", .6, "#luke");

        theater
                .on("*", function (eventName, originalEvent, sceneName, arg) {
                    var args = Array.prototype.splice.apply(arguments, [3]),
                            log = '{\n      name: "' + sceneName + '"';

                    log += ",\n      args: " + JSON.stringify(args).split(",").join(", ").replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    log += "\n    }";

                    $log.innerHTML = log;
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
                .write("Vader:Luke", 400, toggleClass)
                .write("Luke:What?", toggleClass)
                .write("Vader:I am your father.", toggleClass)
                .write({name: "call", args: [kill, true]})
                .write("Luke:Nooo...", -3, "!!! ", 400, "No! ", 400)
                .write("Luke:That's not true!", 400)
                .write("Luke:That's impossible!", toggleClass)
                .write("Vader:Search your feelings.", 1600)
                .write("Vader:You know it to be true.", 1000, toggleClass)
                .write("Luke:Noooooooo! ", 400, "No!", toggleClass)
                .write("Vader:Luke.", 800)
                .write("Vader:You can destroy the Emperor.", 1600)
                .write("Vader:He has foreseen this. ", 800)
                .write("Vader:It is your destiny.", 1600)
                .write("Vader:Join me.", 800)
                .write("Vader:Together we can rule the galaxy.", 800)
                .write("Vader:As father and son.", 1600)
                .write("Vader:Come with me. ", 800)
                .write("Vader:It is the only way.", 2000)
                .write(function () {
                    theater.play(true);
                });

        var body = document.getElementsByTagName("BODY")[0];

        function toggleClass(className) {
            console.log('function toggleClass(className):',className);
            if (typeof className !== "string") className = "light";

            if (theater.utils.hasClass(body, className)) theater.utils.removeClass(body, className);
            else theater.utils.addClass(body, className);
        }

        function kill() {
            var self = this,
                    delay = 300,
                    i = 0,
                    timeout = setTimeout(function blink() {
                        toggleClass("blood");
                        if (++i < 6) timeout = setTimeout(blink, delay);
                        else self.next();
                    }, delay);

            return self;
        }

        window.theater = theater;
    })();
</script>
</body>
</html>

