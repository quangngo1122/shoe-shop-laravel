<!DOCTYPE html>
<html>
    <head>
        <title>Site is down for maintenance</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style type="text/css">
            html{margin:10%;width: 80%;height: 57%;}
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #333; 
                background-image: linear-gradient(135deg, rgb(41, 170, 206), rgb(168, 217, 255));}
            h1 { font-size: 50px; margin: 0; }
            article { display: block; max-width: 650px; margin: 0 auto; }
            a { color: #dc8100; text-decoration: none; }
            a:hover { color: #333; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 40px; }
            }
        </style>
    </head>
    <body >
        <article>
            <h1>Rất Tiếc Vì Sự Bất Tiện Này!</h1>
            <p>{!! setting_website()->notification !!}</p>
        </article>
        <img style=" width:120px; height:120px" src="{{ asset("asset/client/images/logoweb.png")}}" alt="QuangShop">
    </body>
</html>