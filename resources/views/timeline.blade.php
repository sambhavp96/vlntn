<!doctype html>
<html lang="zh-Hans" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <link href='https://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/timeline/css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('assets/timeline/css/style.css') }}"> <!-- Resource style -->

    <title>Our Love ♥️ Timeline</title>
</head>
<body>
<header>
    <br>
    <h1>Our Timeline</h1>
    <h2 id="days">Days Together</h2>
</header>
<div class="out-container">
    <section id="cd-timeline" class="cd-container">

    </section> <!-- cd-timeline -->
</div>
<footer>
    <br>
    <h1>Maya</h1>
    <h2>I wish I could include every moment we shared together here.</h2>
    <h2>As each moment I spend with you is special to me.</h2>
    <h2>Happy Valentine's day 2024 Maya.</h2>
    <br>
    <h3>I'll love you always.</h3>

    <p>There one more surprise for you.</p>
    <p>Have you ever wanted to read our old messages and relive those moments?</p>
    <a href="{{ route('messages') }}">Click Here Then!</a>
</footer>
<script src="{{ asset('assets/timeline/js/modernizr.js') }}"></script> <!-- Modernizr -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('assets/timeline/js/main.js') }}"></script> <!-- Resource jQuery -->
</body>
</html>
