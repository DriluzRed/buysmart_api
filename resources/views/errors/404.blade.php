<!-- resources/views/errors/500.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>¡Oh no! Algo salió mal 😔</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

        body {
            font-family: 'Open Sans';
            padding: 0;
            margin: 0;
        }

        a,
        a:visited {
            color: #fff;
            outline: none;
            text-decoration: none;
        }

        a:hover,
        a:focus,
        a:visited:hover {
            color: #fff;
            text-decoration: none;
        }

        * {
            paading: 0;
            margin: 0;
        }

        #oopss {
            background: #222;
            text-align: center;
            margin-bottom: 50px;
            font-weight: 400;
            font-size: 20px;
            position: fixed;
            width: 100%;
            height: 100%;
            line-height: 1.5em;
            z-index: 9999;
            left: 0px;
        }

        #error-text {
            top: 30%;
            position: relative;
            font-size: 40px;
            color: #eee;
        }

        #error-text a {
            color: #eee;
        }

        #error-text a:hover {
            color: #fff;
        }

        #error-text p {
            color: #eee;
            margin: 70px 0 0 0;
        }

        #error-text i {
            margin-left: 10px;
        }

        #error-text p.hmpg {
            margin: 40px 0 0 0;
        }

        #error-text span {
            position: relative;
            background: #ef4824;
            color: #fff;
            font-size: 300%;
            padding: 0 20px;
            border-radius: 5px;
            font-weight: bolder;
            transition: all .5s;
            cursor: pointer;
            margin: 0 0 40px 0;
        }

        #error-text span:hover {
            background: #d7401f;
            color: #fff;
            -webkit-animation: jelly .5s;
            -moz-animation: jelly .5s;
            -ms-animation: jelly .5s;
            -o-animation: jelly .5s;
            animation: jelly .5s;
        }

        #error-text span:after {
            top: 100%;
            left: 50%;
            border: solid transparent;
            content: '';
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgba(136, 183, 213, 0);
            border-top-color: #ef4824;
            border-width: 7px;
            margin-left: -7px;
        }

        @-webkit-keyframes jelly {

            from,
            to {
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            25% {
                -webkit-transform: scale(.9, 1.1);
                transform: scale(.9, 1.1);
            }

            50% {
                -webkit-transform: scale(1.1, .9);
                transform: scale(1.1, .9);
            }

            75% {
                -webkit-transform: scale(.95, 1.05);
                transform: scale(.95, 1.05);
            }
        }

        @keyframes jelly {

            from,
            to {
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            25% {
                -webkit-transform: scale(.9, 1.1);
                transform: scale(.9, 1.1);
            }

            50% {
                -webkit-transform: scale(1.1, .9);
                transform: scale(1.1, .9);
            }

            75% {
                -webkit-transform: scale(.95, 1.05);
                transform: scale(.95, 1.05);
            }
        }

        /* CSS Error Page Responsive */

        @media only screen and (max-width:640px) {
            #error-text span {
                font-size: 200%;
            }

            #error-text a:hover {
                color: #fff;
            }
        }

        .back:active {
            -webkit-transform: scale(0.95);
            -moz-transform: scale(0.95);
            transform: scale(0.95);
            background: #f53b3b;
            color: #fff;
        }

        .back:hover {
            background: #4c4c4c;
            color: #fff;
        }

        .back {
            text-decoration: none;
            background: #5b5a5a;
            color: #fff;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: 700;
            line-height: normal;
            text-transform: uppercase;
            border-radius: 3px;
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            transform: scale(1);
            transition: all 0.5s ease-out;
        }
    </style>
</head>

<body>
    <div id='oopss'>
        <div id='error-text'>
            <span>404</span>
            <p>No se encontro la pagina</p>
            <p class='hmpg'><a href='{{ url()->previous() }}' class="back">Volver atras</a></p>
        </div>
    </div>
</body>

</html>
