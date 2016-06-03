<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ระบบบันทึกข้อมูลผู้ใช้เครือข่าย</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
</head>


<body>
    <div class="container">
        <form class="form-signin" name="form0" method="post" action="check_login.php">
            <h2 class="form-signin-heading">Please sign in</h2>
            <?php
                $laststate = $_GET['fail'];
                if($laststate ){
                    echo '<div class="alert alert-danger" role="alert">Username or Password are incorrect.<br>Please try again.</div>';
                }
            ?>
                <label for="inputEmail" class="sr-only">User Name</label>
                <input type="text" id="txtUsername" name="txtUsername" class="form-control" placeholder="User Name" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
    <!-- /container -->
</body>

</html>
