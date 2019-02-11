<?php include "header.php";?>
<?php
if (isset($_SESSION['id'])){
    header('location:index.php');
}
?>
    <title>Create your account</title>

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
            <form id="register" >
                <div class="group">
                    <h1 class="form-heading">Create new account</h1>
                </div>
                <div class="group">
                    <input type="text" class="control" name="fullname" placeholder="Enter your name">
                    <input type="text" class="control" name="register" style="display: none;">
                </div>
                <div class="group">
                    <input type="text" class="control" name="username" placeholder="Enter your username">
                </div>
<!--                <div class="group">-->
<!--                    <input type="email" class="control" name="email" placeholder="Enter your valid email">-->
<!--                </div>-->
                <div class="group">
                    <input type="password"  class="control" name="password" id="passwordmatching" placeholder="Password">
                </div>
                <div class="group">
                    <input type="password" class="control" name="confirmpassword" placeholder="Confirm password">
                </div>
                <div class="group">
                    <label for="file" id="filechose"><i class="fas fa-cloud-upload-alt upload-icon" ></i>Select <span id="procol">profile</span></label>
                    <input type="file" name="img" id="file" class="file" >
                </div>
                <div class="group">
                    <h6></h6>
                </div>
                <div class="group">
                    <button type="submit" name="signup" class="btn signup-btn">Create account</button>
                </div>
                <div class="group">
                    <a href="login.php" class="link">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- close of account right -->
</div>
<!-- close sign up container -->
<?php include "footer.php" ?>
