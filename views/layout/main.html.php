<?php
use \app\core\Helper;
use \app\core\Application;

//Helper::dump(Helper::getUser());
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <!-- Static navbar -->
        <nav class="navbar navbar-default " style="margin-top: 2px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand active" href="/">CHAT APP TEST</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" ">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/chat">ChatRoom</a></>
                    </ul>

                    <?php if(Application::isGuest()): ; ?>
                        <ul class="nav navbar-nav mr-auto auth">
                            <li class=""><a href="/login">Login</a></li>
                            <li><a href="/register">Register</a></li>
                        </ul>
                    <?php else: ; ?>
                        <ul class="nav navbar-nav mr-auto auth">
                            <li class=""><a href="/logout">DECONNEXION</a></li>
                            <li>
                                <a href="#" class="status">
                                    <span id="status_icon"></span>
                                    <span id="status_text">you'are connected</span>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>

                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>

        <div id="flash-messages">
            <?php Helper::flashMessage(); ?>
        </div>

        {{content}}

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>