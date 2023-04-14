<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <link rel="icon" href="#">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html {
            height: 100vh;
            }
            body{
            background-color: #f4f3f5;
            min-height: 100vh;
            background-image: url("data:image/svg+xml,%3Csvg width='42' height='44' viewBox='0 0 42 44' xmlns='http://www.w3.org/2000/svg'%3E%3Cg id='Page-1' fill='none' fill-rule='evenodd'%3E%3Cg id='brick-wall' fill='%236ba184' fill-opacity='0.21'%3E%3Cpath d='M0 0h42v44H0V0zm1 1h40v20H1V1zM0 23h20v20H0V23zm22 0h20v20H22V23z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            overflow: hidden;
            }
            svg{
            transform: scale(0.3,0.3);
            margin-top:-45%;
            }
            .st0{display:none;}
            .st1{display:inline;fill:#E2E4FA;}
            .st2{display:none;opacity:0.5;}
            .st3{display:inline;fill-rule:evenodd;clip-rule:evenodd;fill:#A8AABA;}
            .st4{display:inline;}
            .st5{fill:#A8AABA;}
            .st6{opacity:0.1;}
            .st7{fill:#2D1C2D;}
            .st8{fill-rule:evenodd;clip-rule:evenodd;fill:#2D1C2D;}
            .st9{fill:#FFFFFF;}
            .st10{fill:#BF3E73;}
            .st11{fill:#8F3157;}



            @keyframes TongueAnim {
            0% {transform:skewY(0deg);}
            50% {transform:skewY(10deg);}
            100% {transform: skewY(-10deg);}
            }

            .tongue {
            animation: TongueAnim .2s ease infinite;
            transform-origin: top right;
            transform-box: fill-box;
            }

            .st12{fill-rule:evenodd;clip-rule:evenodd;fill:#7EBE9B;}
            .st13{opacity:0.3;fill-rule:evenodd;clip-rule:evenodd;fill:#5F8D75;}
            .st14{opacity:0.6;}
            .st15{fill:#5F8D75;}
            .st16{opacity:0.6;fill:none;stroke:#7EBE9B;stroke-miterlimit:10;}
            .st17{fill:#E7B84D;}
            .st18{fill:none;stroke:#FFFFFF;stroke-width:1.098;stroke-miterlimit:10;}
            .st19{fill:none;}
            .st20{font-family:'Asap-Medium';}
            .st21{font-size:28.6973px;}
            .st22{display:inline;fill:none;}
            .st23{fill:#7091A4;}
            .st24{font-family:'BloggerSans';}
            .st25{font-size:9.72px;}
            .st26{font-family:'Asap-Regular';}
            .st27{font-size:16.524px;}
            .st28{display:inline;fill:#7EBE9B;}
            .st29{font-family:'Asap-Bold';}
            .st30{font-size:10.692px;}
            .st31{fill:#9799A2;}
    </style>
  </head>
  <body>
      @yield('content')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>