/**
 * Created by GYANENDRA on 14-Jan-19.
 */
$(document).ready(function () {
    //register form validation
    var logoutcheck = 1;
    var $j = 0;
    var $accepterName;
    var $accepterId;
    var $onlineUserId;

    function validation(x) {
        $(x).validate({
            rules: {
                fullname: {
                    required: true
                },
                username: "required",
                password: {
                    required: true,
                    rangelength: [8, 20]
                },
                confirmpassword: {
                    required: true,
                    equalTo: "#passwordmatching"
                }
            },
            messages: {
                fullname: {
                    required: "Name is required"
                },
                username: "Unique username is required",
                password: {
                    required: "This field is required",
                    rangelength: "Password should be between 8 to 20 character long"
                },
                confirmpassword: {
                    required: "This field is required",
                    equalTo: "Password not matching"
                }
            }
        });
    }

//        ajax========================

    $('#register').on('submit', function (e) {
        e.preventDefault();
        validation($(this));
//            console.log($('#register'));
        if ($(this).valid()) {
            $.ajax({
                url: 'include/process.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    $('.successmsg').show();
                    $('.successmsg').html(result);
                    $('#register')[0].reset();
                    $('.successmsg').delay(5000).fadeOut();
                }
            });
        }

    });
    //login form validation
    function loginvalidation(x) {
        $(x).validate({
            rules: {
                username: "required",
                password: "required"
            },
            messages: {
                username: "Please type your username",
                password: "please type your password"
            }
        });
    }

    $('#login').on('submit', function (e) {
        e.preventDefault();
        loginvalidation($(this));
//            console.log($('#register'));
        if ($(this).valid()) {
            $.ajax({
                url: 'include/process.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    $('.successmsg').show();
                    console.log(result);
                    if (result=='You are logged in.') {
                        $('.successmsg').removeClass('alert-danger').addClass('alert-success');
                        $('.successmsg').html(result);
                        window.location = "index.php";
                    } else {
                        $('.successmsg').removeClass('alert-success').addClass('alert-danger');
                        $('.successmsg').html("Incorrect username or password");
                        $('.successmsg').delay(5000).fadeOut();
                    }

                }
            });
        }

    });
    $('.logout').on('click', function () {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {logout: 1},
            success: function (result) {
                logoutcheck = 1;
                window.location = "login.php";
            }
        })
    });
    $('body').on('click', '.sendrequest', function () {
        console.log(this);
        var receiverId = $(this).attr('id_attr');
        var check = $(this);
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {sendrequest: receiverId},
            success: function (result) {
                $(check).css('background', 'green');
                $(check).html(result);
                $(check).removeClass('sendrequest');
            }
        });
    });

    $('body').on('click', '.accept', function () {
        var $userid = $(this).attr('attr_id');
        var $senderid = $(this).attr('id_sender');
        var $list = $(this).closest('.pendingrequest');
        $($list).removeClass('pendingrequest');
        $('.friendList').append($list);
        $(this).remove();
        $j--;
        $('.numOfRequest').html("(" + $j + ")");

        $('.img_cont').append("<span class='online_icon'>" + "</span>");
        if ($j == 0) {
            $('.requestheading').html("NO FRIEND REQUEST");
        }
        $.ajax({
            url: "include/process.php",
            type: "POST",
            data: {accept: $userid, acceptof: $senderid},
            success: function (result) {
                // console.log(result);
            }
        });
    });
    $('body').on('click', '.deleterequest', function () {
        var $userid = $(this).attr('attr_id');
        var $senderid = $(this).attr('id_sender');
        var $list = $(this).closest('.pendingrequest');
        $($list).removeClass('pendingrequest');
        // $('.friendList').append($list);
        $($list).remove();
        $j--;
        $('.numOfRequest').html("(" + $j + ")");

        $('.img_cont').append("<span class='online_icon'>" + "</span>");
        if ($j == 0) {
            $('.requestheading').html("NO FRIEND REQUEST");
        }
        $.ajax({
            url: "include/process.php",
            type: "POST",
            data: {delete: $userid, deleteOf: $senderid},
            success: function (result) {
                // console.log(result);
            }
        });
    });
    function get_alluser_row($id, $name, $status) {
        var $button;

        if ($status == "none") {
            $button = "<button type='submit' class='btn btn-primary float-right sendrequest buttonwidth' id_attr='" + $id + "'>send request </button>";
        } else if ($status == 0) {
            $button = "<button type='submit' class='btn btn-info float-right buttonwidth'>Request pending </button>";
        } else if ($status == 1) {
            $button = "<button type='submit' class='btn btn-success float-right buttonwidth' >Request accepted </button>";
            $accepterId = $id;
            $accepterName = $name;
        } else {
            $button = "<button type='submit' class='btn btn-danger float-right buttonwidth'>Request deleted </button>";
        }
        if ($button != "<button type='submit' class='btn btn-success float-right buttonwidth' >Request accepted </button>") {
            var data = "<li class='inactive'>" +
                "<div class='d-flex bd-highlight'>" +
                "<div class='img_cont'>" +
                "<img src='https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png' class='rounded-circle user_img'>" +
                "</div>" +
                "<div class='user_info'>" +
                "<span>" + $name + "</span>" +
                "<div class='row'>" +
                "<div class='col-md-6'>" +
                "<p style='visibility: hidden;'>/2019 05:22222222222</p>" +
                "</div>" +
                "<div class='col-md-6'>" +
                "<input type='hidden' class='fetchingId'value='" + $id + "'>" +
                $button +
                "</div>" +
                " </div>" +
                " </div>" +
                "</div>" +
                "</li>";
            return data;
        }

    }

    function getAllUser() {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {type: "getAllUser"},
            dataType: 'json',
            success: function (result) {
                $('.allUserList').html('');
                // console.log(result);
                for (var i in result) {
                    // console.log(result[i]['name']);
                    var $name = result[i]['name'];
                    var $id = result[i]['id'];
                    var $status = result[i]['status'];
                    if ($status != 1) {
                        // $('.online_icon').addClass('offline');
                    }
                    $getAllUserRow = get_alluser_row($id, $name, result[i]['relation']);
                    $('.allUserList').append($getAllUserRow);
                    // console.log(result[i]['relation']);

                }
            }
        })
    }

    getAllUser();
    setInterval(function () {
        getAllUser();
    }, 10000);

    function listingPendingRequest($id, $username, $sender) {
        var data = "<li class='active pendingrequest'>" +
            "<div class='d-flex bd-highlight'>" +
            "<div class='img_cont'>" +
            "<img src='https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png' class='rounded-circle user_img'>" +
            "</div>" +
            "<div class='user_info'>" +
            "<span>" +
            $username +
            "<span class='shiftrespose acceptRequest'>" +
            "<i class='fas fa-trash deleterequest' attr_id='" + $id + "' id_sender='" + $sender + "'></i>" +
            "<i class='fas fa-user-check accept' attr_id='" + $id + "' id_sender='" + $sender + "'></i>" +
            "</span>" +
            "</span>" +
            "<!--                                    <p>Maryam is online</p>-->" +
            "</div>" +
            "</div>" +
            "</li>";
        return data;
    }

    function pending_request() {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {type: "pending_request"},
            dataType: 'json',
            success: function (result) {
                $('.friendRequest').html('');
                // console.log(result);

                for (var i in result) {
                    $id = result[i]['id'];
                    $username = result[i]['username'];
                    $sender = result[i]['sender'];
                    $getAllPendingRequest = listingPendingRequest($id, $username, $sender);
                    $('.friendRequest').append($getAllPendingRequest);
                    $j = result[i]['count'];
                    // console.log($j);
                }
                $('.numOfRequest').html("(" + $j + ")");
            }

        });
    }

    pending_request();
    setInterval(function () {
        pending_request();
    }, 10000);
    function showingOnlineUser($senderId, $senderName, $senderStatus, $senderOnlineAgo) {
        var $statusIcon;
        if ($senderStatus == 1) {
            $statusIcon = "<span class='online_icon'></span>";
            $senderOnlineAgo = 'Online';
        } else {
            $statusIcon = "<span class='online_icon offline'></span>";
        }
        var data = "<li class='active onlineUser' id_attr='" + $senderId + "' name_attr='" + $senderName + "'>" +
            "<div class='d-flex bd-highlight'>" +
            "<div class='img_cont'>" +
            "<img src='https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png' class='rounded-circle user_img'>" +
            $statusIcon +
            "</div>" +
            "<div class='user_info'>" +
            "<span>" + $senderName + "</span>" +
            "<p>" + $senderOnlineAgo + "</p>" +
            "</div>" +
            "</div>" +
            "</li>";
        return data;
    }

    function showing_online_user_friends() {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {type: 'showing_online_user_friends'},
            dataType: 'json',
            success: function (result) {
                // listing_accepted_request();
                // $('.friendList').html('');
                for (var i in result) {
                    $senderId = result[i]['id'];
                    $senderStatus = result[i]['senderStatus'];
                    $senderName = result[i]['senderName'];
                    $senderOnlineAgo = result[i]['time'];
                    $onlineUser = showingOnlineUser($senderId, $senderName, $senderStatus, $senderOnlineAgo);
                    $('.friendList').append($onlineUser);

                }
            }
        });

        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {type: 'listing_accepted_request'},
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                // $('.friendList').html('');
                for (var $i in result) {
                    $accepterId = result[$i]['id'];
                    // removingAcceptedUserFromAllList = $accepterId;
                    // console.log(removingAcceptedUserFromAllList);
                    $accepterName = result[$i]['name'];
                    $accepterStatus = result[$i]['status'];
                    $accepterOnlineAgo = result[$i]['time'];
                    $onlineUser = showingOnlineUser($accepterId, $accepterName, $accepterStatus, $accepterOnlineAgo);
                    $('.friendList').append($onlineUser);
                }
            }
        });
    }

    showing_online_user_friends();
    setInterval(function () {
        showing_online_user_friends();
        $('.friendList').html('');
    }, 10000);

//     function listing_accepted_request() {
//         $.ajax({
//             url: 'include/process.php',
//             type: 'POST',
//             data: {type: 'listing_accepted_request'},
//             dataType: 'json',
//             success: function (result) {
//                 // console.log(result);
//                 $('.friendList').html('');
//                 for (var $i in result) {
//                     $accepterId = result[$i]['id'];
//                     $accepterName = result[$i]['name'];
//                     $accepterStatus = result[$i]['status'];
//                     $accepterOnlineAgo = result[$i]['time'];
//                     $onlineUser = showingOnlineUser($accepterId, $accepterName, $accepterStatus, $accepterOnlineAgo);
//                     $('.friendList').append($onlineUser);
//                 }
//             }
//         });
//     }
// setInterval(function () {
//     listing_accepted_request();
// },10000);
    function appendForSender(msg) {
        var src = "https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png";
        var msg = "<div class='d-flex justify-content-end mb-4' id='messages'>" +
            "<div class='msg_cotainer_send'>" +
            msg +
            "<span class='msg_time_send'>8:55 AM, Today</span>" +
            "</div>" +
            "<div class='img_cont_msg'>" +
            "<img src='" + src + "' class='rounded-circle user_img_msg'>" +
            "</div>" +
            "</div>";
        return msg;
    }

    function appendForReceiver(msg) {
        var src = "https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png";
        var msg = "<div class='d-flex justify-content-start mb-4 sender-from-other-side' id='messages'>" +
            "<div class='img_cont_msg'>" +
            "<img src='" + src + "' class='rounded-circle user_img_msg'>" +
            "</div>" +
            "<div class='msg_cotainer'>" +
            msg +
            "<span class='msg_time'>8:55 AM, Today</span>" +
            "</div>" +
            "</div>";
        return msg;
    }

    var $onlineId;
    //sender messages
    var count = 0;

    function refreshMsg() {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {fetchMsg: $onlineId},
            dataType: 'json',
            success: function (result) {

                if (result != "failed") {
                    for ($i in result) {
                        $sessionId = result[$i]['sessionId'];
                        $sender = result[$i]['sender'];
                        $receiver = result[$i]['receiver'];
                        $msg = result[$i]['msg'];
                        if ($sessionId == $sender) {
                            // console.log("inside $sessionId == $sender");
                            var senderMsg = appendForSender($msg);
                            $('.append-msg-container').append(senderMsg);

                        } else if ($sessionId == $receiver) {
                            // console.log("inside $sessionId == $receiver");
                            var receiverMsg = appendForReceiver($msg);
                            $('.append-msg-container').append(receiverMsg);

                        }

                    }
                }

            }, error: function () {
                $('.append-msg-container').html('');
            }
        });
    }

//    sender msg appending
    function appendWhenSenderSend(x) {
        var numOfMsg = sender_msg_length();
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {setForSender: x},
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $msglength = result.length;
                console.log($msglength);
                console.log(numOfMsg);
                // if(numOfMsg < $msglength){
                //
                //     var receiverMsg = appendForReceiver(result[$msglength - 1]['msg']);
                //     $('.append-msg-container').append(receiverMsg);
                // }
                // console.log(numOfMsg);
            }, error: function (result) {

            }
        })

    }

    // appendWhenSenderSend();
    // setInterval(function () {
    //     appendWhenSenderSend();
    // }, 1000);

//    sender msg appending

//end of sender messages\

    $('body').on('click', '.onlineUser', function () {
        $('.append-msg-container').html('');
        $onlineUserId = $(this).attr('id_attr');
        console.log($onlineUserId);
        $onlineUserName = $(this).attr('name_attr');
        // console.log($onlineUserName);
        $('.withChatingName').html($onlineUserName);
        $('.withChatingId').html($onlineUserId);
        $('.addingChatClass').addClass('col-md-6');
        $('.chattingbox').slideDown(600);
        $onlineId = $onlineUserId;
        refreshMsg($onlineId);
    });
    function sender_msg_length() {
        var senderMsg = $('.append-msg-container').find('.sender-from-other-side').length;
        return senderMsg;
    }

    setInterval(function () {
        var $msg = sender_msg_length();
        appendWhenSenderSend($onlineUserId,$msg);
    }, 1000);


   // sender msg appending
    function appendWhenSenderSend(x,y) {
        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {setForSender: x},
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $msglength = result.length;
                if(y < $msglength){
                    var receiverMsg = appendForReceiver(result[$msglength - 1]['msg']);
                    $('.append-msg-container').append(receiverMsg);
                }
            }, error: function (result) {

            }
        })

    }

    // appendWhenSenderSend();


    //setting interval for refresh message
    // $('.refresh').on('click',function () {
    //     refreshMsg();
    //     getAllUser();
    //
    //     $('.append-msg-container').html('');
    //     $(".append-msg-container").animate({ scrollTop: $('.height').height() }, "fast");
    // });
    // setInterval(function () {
    //     refreshMsg();
    //     $('.append-msg-container').html('');
    // },1000);


    $('.profileInfoButton').on('click', function () {
        $('.action_menu').slideToggle();
    });

    // Append msg//
    function appendMsg(msg) {
        var src = "https://cdn4.iconfinder.com/data/icons/ui-standard/96/People-512.png";
        var msg = "<div class='d-flex justify-content-end mb-4'>" +
            "<div class='msg_cotainer_send'>" +
            msg +
            "<span class='msg_time_send'>8:55 AM, Today</span>" +
            "</div>" +
            "<div class='img_cont_msg'>" +
            "<img src='" + src + "' class='rounded-circle user_img_msg'>" +
            "</div>" +
            "</div>";
        return msg;
    }

    $('body').on('click', '.append-msg', function () {
        var msg = $('#msg').val();
        var appendMsgResult = appendMsg(msg);
        $('.append-msg-container').append(appendMsgResult);
        $(".append-msg-container").animate({scrollTop: $('.height').height()}, "fast");
        var onlineUserId = $('.withChatingId').text();

        $.ajax({
            url: 'include/process.php',
            type: 'POST',
            data: {onlineId: onlineUserId, senderMsg: msg},
            dataType: 'json',
            success: function (result) {
                console.log(result);
            }
        });

    });
});
