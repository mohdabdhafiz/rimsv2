<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Random Image Slideshow</title>
    <style>
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
        }
        .mySlides {
            display: none;
        }
        img {
            width: 100%;
            height: auto;
        }
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }
        @-webkit-keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }
        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }
    </style>
</head>
<body>

<div class="slideshow-container">
    <?php
    $images = glob("./assets/img/gambarProgram/*.{jpg,png,gif}", GLOB_BRACE);
    shuffle($images);

    foreach ($images as $image) {
        echo '<div class="mySlides fade">';
        echo '<img src="' . $image . '">';
        echo '</div>';
    }
    ?>
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}
</script>

</body>
</html>
