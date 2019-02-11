<?php include "header.php";
?>
<?php if (isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
    <title>LOGIN NOW</title>
    </head>
    <body>

    <!-- sign up container -->
    <div class="signup-container">
        <!-- account left  -->
        <div class="account-left">
            <div class="group">
                <h1 class="logo">gyanmessenger.com</h1>
            </div>
            <div class="content-group">
                <div class="group">
                    <h2 class="letschat">Lets chat</h2>
                    <hr class="lestchat-underline">
                    <div class="group">
                        <p class="slogan">When we change the way we communicate, we change society.</p>
                        <img src="assets/image/connection.png" class="resimg" alt="img">
                    </div>
                </div>
            </div>

            <div class="triangle-right"></div>
        </div>
        <!-- close of account left -->

        <!-- account right -->
        <div class="account-right" style="background: #fff;">
            <div class="form-area">
                <div class="alert alert-success successmsg" style="display: none;">
                </div>
                <form id="login">
                    <div class="group">
                        <h1 class="form-heading">User login</h1>
                    </div>
                    <div class="group">
                        <input type="text" class="control" name="username" placeholder="Enter your username">
                        <input type="text" class="control" name="loginset" value="1" style="display:none;">

                    </div>
                    <div class="group">
                        <input type="password" class="control" name="password" placeholder="Password">
                    </div>
                    <div class="group">
                        <button type="submit" name="login" class="btn signup-btn">Login</button>
                    </div>
                    <div class="group">
                        <a href="sign_up.php" class="link">Create a new account?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- close of account right -->
    </div>
    <!-- close sign up container -->
<?php include "footer.php" ?>