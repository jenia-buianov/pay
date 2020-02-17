<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>

        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
        *{
            margin: 0;
            box-sizing: border-box;

        }
        body{
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;
            background-image: url('');
            background-repeat: repeat-y;
            background-size: 100%;
        }
        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}
        h1{
            font-size: 1.5em;
            color: #222;
        }
        h2{font-size: .9em;}
        h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        p{
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoiceholder{
            width:100%;
            hieght: 100%;
            padding-top: 50px;
        }
        #headerimage{
            z-index:-1;
            position:relative;
            top: -50px;
            height: 350px;
            background-image: url('https://book.autogari.md/images/bg-2.jpg');

            -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
            -moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
            box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
            overflow:hidden;
            background-attachment: fixed;
            background-size: 1920px 95%;
            background-position: -10% -550%;
        }
        #invoice{
            position: relative;
            top: -290px;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*='invoice-']{ /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }

        #invoice-top{min-height: 120px;}
        #invoice-mid{min-height: 120px;}
        #invoice-bot{ min-height: 250px;}

        .logo{
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
            border-radius:100%;
        }
        .clientlogo{
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        .info{
            display: block;
            float:left;
            margin-left: 20px;
        }
        .title{
            float: right;
        }
        .title p{text-align: right;}
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }
        .tabletitle{
            padding: 5px;
            background: #EEE;
        }
        .service{border: 1px solid #EEE;}
        .item{width: 50%;}
        .itemtext{font-size: .9em;}

        #legalcopy{
            margin-top: 30px;
        }
        form{
            float:right;
            margin-top: 30px;
            text-align: right;
        }


        .effect2
        {
            position: relative;
        }
        .effect2:before, .effect2:after
        {
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width:300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }
        .effect2:after
        {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }



        .legal{
            width:70%;
        }

        .button{
            color:white;
            background:#5cb85c;
            border:none;
            border-radius: 5px;
            padding: 10px 30px;
            font-weight:bold;
        }

        .reservation{
            text-align:right;
            color: #0B3C5D;
            font-size:20px;
        }

        .form-control{
            width: 100%;
            display: inline-block;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        form #invoice-mid{
            font-size: 14px;
            color:#666;
        }

        .table td{
            padding: 5px;
        }

        .payment_method{
            border: 1px solid #2d995b;
            border-radius: 10px;
            padding: 5px;
        }

        .payment_method:hover{
            background: #2d995b;
            color: white;
            cursor: pointer;
        }

        .payment_method .method_name{
            line-height: 60px;
        }
        .payment_method img{
            width: 60px;
            height: 60px;
            border-radius: 100%;
            border: 1px solid #cccccc;
        }

        @media(max-width: 700px) {
            #invoice{
                width: 100%;
                top: -380px;
            }

            .title{
                text-align: left;
                margin-top: 20px;
                float: none;
            }

            .title p{
                text-align: left;
            }

            #project{
                margin-top: 20px;
            }

            #project .reservation{
                font-size: 15px;
            }

            .logo, .clientlogo{
                width: 40px;
                height: 40px;
                background-size: 40px 40px;
            }

            .frm{
                float: none;
                text-align: center;
            }

            button{
                width: 100%;
            }

            .payment_method font{
                width: 40px;
                height: 40px;
                border-radius: 100%;
            }

            .payment_method .method_name{
                line-height: 40px;
            }
        }
    </style>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<div id="invoiceholder">

    <div id="headerimage"></div>
    <div id="invoice" class="effect2">
        @yield('content')
    </div><!--End Invoice-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</div><!-- End Invoice Holder-->
</body>
</html>
