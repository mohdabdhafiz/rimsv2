<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMS@GALERI</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

body{
    font-family: poppins;
    background-color: #000;
    color: #eee;
    margin: 0;
    font-size: 12px;
}

a{
    text-decoration: none;
    color: #eee;
}

header{
    width: 1140px;
    max-width: 80%;
    margin: auto;
    height: 50px;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 100;
}

header a{
    margin-right: 40px;
}

.carousel{
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    margin-top: -50px;
    position: relative;
}

.carousel .list .item{
    position: absolute;
    inset: 0 0 0 0;

}

.carousel .list .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.carousel .list .item .content{
    position: absolute;
    top: 20%;
    width: 1140px;
    max-width: 80%;
    left: 50%;
    transform: translateX(-50%);
    padding-right: 30%;
    box-sizing: border-box;
    color: #fff;
    text-shadow: 0 5px 10px #0004;

}

.carousel .list .item .content .author{
    font-weight: bold;
    letter-spacing: 10px;
}

.carousel .list .item .content .title,
.carousel .list .item .content .topic{
    font-weight: bold;
    font-size: 5em;
    list-style: 1.3em;
}

.carousel .list .item .content .topic{
    color: 	#FFC0CB;
}

.carousel .list .item .buttons{
    display: grid;
    grid-template-columns: repeat(2, 130px);
    grid-template-rows: 40px;
    gap: 5px;
    margin-top: 20px;
}
.carousel .list .item .buttons button{
    border: none;
    background-color: #eee;
    letter-spacing: 3px;
    font-family: Poppins;
    font-weight: 500;
}
.carousel .list .item .buttons button:nth-child(2){
    background-color: transparent;
    border: 1px solid #fff;
    color: #eee;
}

.thumbnail{
    position: absolute;
    bottom: 50px;
    left: 50%;
    width: max-content;
    z-index: 100;
    display: flex;
    gap: 20px;
}
.thumbnail .item{
    width: 150px;
    height: 220px;
    flex-shrink: 0;
    position: relative;
}
.thumbnail .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}
.thumbnail .item .content{
    color: #fff;
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
}
.thumbnail .item .content .title{
    font-weight: bold;
}

.arrows{
    position: absolute;
    top: 90%;
    right: 52%;
    width: 300px;
    max-width: 30%;
    display: flex;
    gap: 10px;
    align-items: center;
}

.arrows button{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #eee4;
    border: none;
    font-family: monospace;
    color: #fff;
    font-weight: bold;
    font-size: large;
    transition: .5s;
    z-index: 100;
}

.arrows button:hover{
    background-color: #eee;
    color: #555;
}

.carousel .list .item:nth-child(1){
    z-index: 1;
}

.carousel .list .item:nth-child(1) .author,
.carousel .list .item:nth-child(1) .title,
.carousel .list .item:nth-child(1) .topic,
.carousel .list .item:nth-child(1) .des,
.carousel .list .item:nth-child(1) .buttons{
    transform: translateY(50px);
    filter: blur(20px);
    opacity: 0;
    animation: showContent 0.5s 1s linear 1 forwards;
}

@keyframes showContent{
    to{
        opacity: 1;
        filter: blur(0);
        transform: translateY(0);
    }
}

.carousel .list .item:nth-child(1) .title{
    animation-delay: 1.2s;
}

.carousel .list .item:nth-child(1) .topic{
    animation-delay: 1.4s;
}

.carousel .list .item:nth-child(1) .des{
    animation-delay: 1.6s;
}

.carousel .list .item:nth-child(1) .buttons{
    animation-delay: 1.8s;
}

.carousel.next .list .item:nth-child(1) .img{
    width: 150px;
    height: 220px;
    position: absolute;
    left: 50%;
    bottom: 50px ;
    border-radius: 20px;
    animation: showImage 0.5s linear 1 forwards;
}
@keyframes showImage{
    to{
        width: 100%;
        height: 100%;
        left: 0;
        bottom: 0;
        border-radius: 0;
    }
}

.carousel.next .thumbnail .item:nth-last-child(1){
    width: 0;
    overflow: hidden;
    animation: showThumbnail 0.5s linear 1 forwards;
}

@keyframes showThumbnail{
    to{
        width: 150px;
    }
}

.carousel.next .thumbnail{
    transform: translateX(150px);
    animation: transformThumbnail 0.5s linear 1 forwards;
}

@keyframes transformThumbnail{
    to{
        transform: translateX(0);
    }
}

.carousel.prev .list .item:nth-child(2){
    z-index: 2;
}

.carousel.prev .list .item:nth-child(2) img{
    position: absolute;
    bottom: 0;
    left: 0;
    animation: outImage 0.5s linear 1 forwards;
}

@keyframes outImage{
    to{
        width: 150px;
        height: 220px;
        border-radius: 20px;
        left: 50%;
        bottom: 50px;
    }
}

.carousel.prev .thumbnail .item:nth-child(1){
    width: 0;
    overflow: hidden;
    opacity: 0;
    animation: showThumbnail 0.5s linear 1 forwards;
}

.carousel.prev .list .item:nth-child(2) .author,
.carousel.prev .list .item:nth-child(2) .title,
.carousel.prev .list .item:nth-child(2) .topic, 
.carousel.prev .list .item:nth-child(2) .des,
.carousel.prev .list .item:nth-child(2) .buttons{
    animation: contentOut 1.5s linear 1 forwards;
}

@keyframes contentOut {
    to{
        tranform: translateX(-150px);
        filter: blur(20px);
        opacity: 0;
    }
}

.carousel.next .arrows button,
.carousel.prev .arrows button{
    pointer-events: none;
}

.time{
    width: 100%;
    height: 3px;
    background-color:#eee;
    position: absolute;
    z-index: 100;
    top: 0;
    left: 0;
}

.carousel.next .time,
.carousel.prev .time{
    width: 100%;
    animation: timeRunning 2s linear 1 forwards;
}

@keyframes timeRunning{
    to{
        width: 0;
    }
}

@media screen and (max-width:678px){
    .carousel .list .item .content{
        padding-right: 0;
    }
    .carousel .list .item .content .title{
        font-size: 30px;
        
    }
}
    </style>
</head>
<body>
     <header>
        <!--nav>
            <a href="">Home</a>
            <a href="">Contacts</a>
            <a href="">Info</a>
        </nav-->
     </header>

     <?php shuffle($senaraiProgram); ?>
    <div class="carousel">
            <div class="list">
                <?php foreach($senaraiProgram as $program): ?>
                <div class="item">
                    <img src="<?= base_url() ?>assets/img/gambarProgram/<?= $program->gambarNama ?>">
                    <div class="content">
                        <div class="author"><?= $program->organisasiPenganjur ?></div>
                        <div class="title"><?= $program->programNama ?></div>
                        <div class="desc">
                            <?= date_format(date_create($program->programTarikh), "d/m/Y") ?><br>
                            <?= $program->programLokasi ?>
                        </div>
                        <div class="buttons">
                            <button><?= $program->programNegeri ?></button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="thumbnail">
                <?php foreach($senaraiProgram as $program): ?>
                <div class="item">
                    <img src="<?= base_url() ?>assets/img/gambarProgram/<?= $program->gambarNama ?>">
                    <div class="content">
                        <div class="title">
                            <?= $program->organisasiPenganjur ?>
                        </div>
                        <div class="des">
                        <?= $program->programNama ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="arrows">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
            <div class="time"></div>
        </div>
    <script>
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');
let carouselDom = document.querySelector('.carousel');
let listItemDom = document.querySelector('.carousel .list');
let thumbnailDom = document.querySelector('.carousel .thumbnail');


const timeRunning = 3000;  
const timeAutoNext = 10000; 

let runTimeOut;
let runAutoRun = setTimeout(() => {
    nextDom.click();
}, timeAutoNext);

nextDom.onclick = function() {
    showSlider('next');
}

prevDom.onclick = function() {
    showSlider('prev');
}

function showSlider(type) {
    const itemSlider = document.querySelectorAll('.carousel .list .item');
    const itemThumbnail = document.querySelectorAll('.carousel .thumbnail .item');

    if (type === 'next') {

        listItemDom.appendChild(itemSlider[0]);
        thumbnailDom.appendChild(itemThumbnail[0]);
        carouselDom.classList.add('next');
    } else {
        
        let positionLastItem = itemSlider.length - 1;
        listItemDom.prepend(itemSlider[positionLastItem]); 
        thumbnailDom.prepend(itemThumbnail[positionLastItem]); 
        carouselDom.classList.add('prev');
    }

    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);


    clearTimeout(runAutoRun);
    runAutoRun = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);
}


    </script>
</body>
</html>