<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechForum - About</title>

    <script src="https://kit.fontawesome.com/209423cbdf.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/about.css')}}">
</head>
<body id="body-about">
<div id="full-page-gradient"></div>
<header id="about-header">
        <a href="{{route('home')}}" id="about-logo" class="black-nav-item">TechForum</a>
</header>
<main id="about-main">
    <div id="about-author">
        <div id="author-empty-side">
            <div id="author-card">
                <div id="card-author-info">
                    <img id="author-picture" src="{{asset('assets/img/author.jpg')}}">
                    <h5 id="card-author-name">Darko Đukić</h5>
                    <hr class="card-border"></hr>
                    <p id="author-ocupation">Web developer</p>
                </div>
                <div id="author-card-social">
                    <a href="https://www.linkedin.com/in/darko-%C4%91uki%C4%87-568337246/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/darko104" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
        <div id="author-info">
            <div id="initial-author-info">
                <h1>About me<span id="author-header-colored">!</span></h1>
                <p id="author-basic-info">My name is Darko Đukić, i am a Web Developer from Pančevo, Serbia.</p>
                <div id="author-buttons">
                    <a href="http://darkodjwebdev.com/" target="_blank" class="author-button">My portfolio</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="js/about.js"></script>
</body>
</html>
