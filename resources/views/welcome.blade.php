<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Doers</title>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <style>
        p {
            line-height: 24px;
            font-size: 12pt;
        }
    </style>
</head>
<body>
<div class="text-center" style="position: relative;top:12px;font-size: 48px;">
    <img src="{{ asset('favicon.png') }}" alt="LOGO" height="48"> The Doers <br>
    <span style="font-size: small;font-weight: bold;position: relative;top:-48px;left:24px;">Connecting NGOs and The Doers</span>
</div>
<div class="container">
    <h1>The Doers App</h1>
    <p>
        The Doers App's mission is to help NGOs in India overcome barriers to scale and achieve greater impact at the
        Bottom of the Pyramid. Strategic, long-term, high-value partnerships are key to all of that. We bring together
        volunteers, donors, corporates, social innovators, impact investors, mentors, technology experts, government
        agencies and local partners (The Doers) who are interested in working with NGOs to make a social impact.
    </p>
    <hr>
    <h1>Theory behind the App</h1> <br>
    <p>
        <b>Our Theory is built on the following set of premises: </b>
    </p>
    <p>
        In order to achieve a high level of social impact, NGOs must be enabled to reach key targets of social
        development. They need access to human resources, experts from various background, funds, local partnerships,
        etc.,
    </p>
    <p>
        Currently, NGOs have to run around, meet lots of people and explain their needs to get the right resources. This
        takes loads of time & effort and also slows down the work of NGO.
    </p>
    <p>
        This App aims to build the bridge between the needs of NGO and the available resources. <br>
        This App tries to build a 'thriving ecosystem' that enables collaboration between volunteers, donors,
        corporates, social innovators, impact investors, mentors, technology experts, government agencies, local
        partners (The Doers) and NGOs. Such collaborations help touch and transform many more lives at a faster pace.
    </p>
    <p>
        The Doers believes that by creating avenues to bridge expectations on both sides, we can help overcome obstacles
        to achieving scale and to do so sustainability.
    </p>
    <br>
    <div class="text-center">
        <a href="{{ route('auth') }}" class="btn btn-primary btn-lg">Enter</a>
    </div>
</div>
</body>
</html>