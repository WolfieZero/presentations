<?php

$slidesJson = file_get_contents('slides.json');
$slides = json_decode($slidesJson);

$slideNumber = 0;
$numberOfSlides = count($slides);
if (isset($_GET['slide']) && $_GET['slide'] > 0) {
    $slideNumber = $_GET['slide'];
    if ($slideNumber > $numberOfSlides - 1) {
        header('Location: /?slide=' . ($numberOfSlides - 1));
        exit;
    }
}

$slide = $slides[$slideNumber];

?><!DOCTYPE html>
<html>
    <head>
        <title>Fluff and Razor Blades</title>
        <link rel="stylesheet" href="/fonts/sansation/face.css">
        <style>
            html,
            body {
                background: #555;
                width: 100%;
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                display: table;
                font-weight: 100;
                font-family: 'Sansation-light';
                background-size: cover;
            }

            body,
            a {
                color: #a34d88;
            }

            .container {
                background-image: linear-gradient( 45deg, rgba(10,10,10,.9), rgba(20,20,20,.9));
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }

            .content > * {
                margin-bottom: 1em;
                text-shadow: 0 0 10px rgba(0,0,0,.5);
            }

            .presentation-title
            .slide-title {
                text-transform: uppercase;
            }

            .presentation-title {
                font-size: 5em;
            }

            .slide-title {
                font-size: 4em;
            }

            .slide-title-sub {
                font-weight: 100;
                margin-top: 1em;
                font-size: 2.5em;
            }

            .slide-title-sub__minus-top {
                margin-top: -2em;
            }

            .slide-0 {
                background-image: url('img/gears.jpg');
            }

            .slide-11 {
                background-image: url('img/star.svg');
            }
        </style>
    </head>
    <body class="slide-<?php echo $slideNumber; ?>">
        <div class="container">
            <div class="content">
                <?php foreach ($slide as $key => $value) : ?>
                    <div class="<?php echo $key; ?>"><?php echo $value; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            const goToSlide = function (slideNumber) {
                window.location.href = '?slide=' + slideNumber;
            }

            const keyPress = function (e) {

                e = e || window.event;

                if (e.keyCode == '38') {
                    // up arrow
                } else if (e.keyCode == '40') {
                    // down arrow
                } else if (e.keyCode == '37') {
                   // left arrow
                   goToSlide(<?php echo $slideNumber - 1; ?>);
                } else if (e.keyCode == '39') {
                   // right arrow
                   goToSlide(<?php echo $slideNumber + 1; ?>);
                }

            }

            document.onkeydown = keyPress;

        </script>
    </body>
</html>
