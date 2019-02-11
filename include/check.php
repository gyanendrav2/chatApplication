<html>
<head>
    <title></title>
    <style>
        .messages{
            border: 1px solid #ccc;
            width: 210px;
            height: 210px;
            padding: 10px;
            overflow-y:scroll;

        }
        .message{
            color: slategrey;

        }
        .message p{
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="messages">
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
    </p>

    <p>
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
    </p>
    <p>
        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pa
    </p>
    <p>riatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
    </p>

</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

//        $(".messages").animate({ scrollTop: $(document).height() }, "slow");
//        return false;
        $('body').on('click',function(){
            $(".messages").append("<p>"+"fgfg"+"</p>");
            $(".messages").animate({ scrollTop: $(document).height() }, "slow");
            return false;
        });

    });

</script>
</body>
</html>