<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive 404 page </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@900&display=swap');

        body {
            font-family: 'Merriweather', serif;
            margin: 0;
            background-color: #9cc3d5;
            text-align: center;
            color: white;
            user-select: none;
            padding-top: 18vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #5ca3dd93;
        }

        h2 {
            font-size: 150px;
            margin: 0;
            text-shadow: 15px 5px 2px black;
        }

        h3 {
            font-size: 40px;
            margin: 20px;
        }

        p {
            font-size: 18px;
            margin: 5px;
        }

        p:last-of-type {
            margin-bottom: 35px;
        }

        a {
            text-decoration: none;

        }
    </style>
</head>

<body>
    <div class="container">
        <h2>404</h2>
        <h3>Oops, nothing here...</h3>
        <p>Please Check the URL</p>
        <p>Otherwise, <a href="/login">Click here </a> to login page </p>
    </div>
</body>

</html>