<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"C:\Users\Administrator\Desktop\amazon_web\public/../application/index\view\index\sign_in.html";i:1554869929;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="/static/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>COMAZON</title>
</head>

<body>
    <div class="navbar navbar-default navbar-light">
        <div class="container">
            <div class="navbar-brand">COMAZON</div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./signin">Sign in1</a></li>
                <li><a href="./signup">Sign up1</a></li>
            </ul>
            <form action="#" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="product name or ASIN">
                </div>
                <button type="submit" class="btn btn-default">search</button>
            </form>

        </div>
    </div>
    <div class="container container-body">

        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h2>Create your personal account</h2>
            <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae aperiam consectetur saepe aut, ullam fuga
                nesciunt, tenetur vitae aspernatur blanditiis labore quam tempore debitis assumenda id</h4>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <div class="panel panel-sign">
                <form action="">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" placeholder="Input your email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div class="footer"></div>

</body>

</html>