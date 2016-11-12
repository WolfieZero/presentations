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
        <link rel="stylesheet" href="style.css">
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
                window.location.href = '/?slide=' + slideNumber;
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
