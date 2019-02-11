<?php include "function.php" ?>
<?php
$sessionTime = 365 * 24 * 60 * 60;
$sessionName = "my_session";
session_set_cookie_params($sessionTime);
session_name($sessionName);
session_start();

if (isset($_COOKIE[$sessionName])) {
    setcookie($sessionName, $_COOKIE[$sessionName], time() + $sessionTime, "/");
}
//===========for registration=================//
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $name = mysqli_real_escape_string($db, $_POST['fullname']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $insert = insert_user_data($db, $username, $name, $password);
    if ($insert) {
        echo "Successfully registered.";
    } else {
        echo "User already exist.";
    }
}
//=========for login=======================//
if (isset($_POST['loginset'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $select = select_user_data($db, $username, $password);
    if ($select) {
        $_SESSION['id'] = $select['id'];
        change_status($db, $_SESSION['id'], 1);
        echo "You are logged in.";
    } else {
        echo "Password or Username incorrect!";
    }
}
if (isset($_POST['logout'])) {
    change_status($db, $_SESSION['id'], 0);
    session_destroy();
}
//sending request to users
if (isset($_POST['sendrequest'])) {
    $receiverId = $_POST['sendrequest'];
    $send = sending_request($db, $receiverId, 0);
    if ($send) {
        echo "Request send";
    } else {
        echo "not send";
    }
}
if (isset($_POST['accept']) && isset($_POST['acceptof'])) {
    $accept = $_POST['accept'];
    $acceptof = $_POST['acceptof'];

    $setquery = mysqli_query($db, "UPDATE  relations SET status=1 WHERE sender=$acceptof AND receiver=$accept") or die("unable to set");
    echo "success";
}

if (isset($_POST['delete']) && isset($_POST['deleteOf'])) {
    $accept = $_POST['delete'];
    $acceptof = $_POST['deleteOf'];

    $setquery = mysqli_query($db, "UPDATE  relations SET status=2 WHERE sender=$acceptof AND receiver=$accept") or die("unable to set");
    echo "success";
}

if (isset($_POST['type'])) {
    if ($_POST['type'] == "getAllUser") {
//        echo "<pre>";
        $big = array();
        $AllUsersResult = fetching_rows_data($db);
        while ($AllUsers = $AllUsersResult->fetch_assoc()) {
            if ($_SESSION['id'] != $AllUsers['id']) {
                $small['id'] = $AllUsers['id'];
                $small['username'] = $AllUsers['username'];
                $small['name'] = $AllUsers['name'];
                $small['status'] = $AllUsers['status'];
                $small['relation'] = checking_sendrequest($db, $_SESSION['id'], $AllUsers['id']);
                array_push($big, $small);
            }
        }
        echo json_encode($big);
    }
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == "pending_request") {
        $big = array();
        $count = 0;
        $friendlist = listing_sendrequest_user($db, $_SESSION['id']);
        while ($row = $friendlist->fetch_assoc()) {
            if ($row['status'] == 0) {
                $name = showing_sender_name($db, $row['sender']);
                $small['id'] = $_SESSION['id'];
                $small['username'] = $name['username'];
                $small['sender'] = $row['sender'];
                $small['count'] = ++$count;
                array_push($big, $small);
            }
        }
        echo json_encode($big);
    }
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 'showing_online_user_friends') {
        $big = array();
        $acceptedrequest = showing_accepted_request($db);
        while ($acceptedRow = $acceptedrequest->fetch_assoc()) {
            if ($acceptedRow['status'] == 1) {
                $SenderName = fetching_sender_name($db, $acceptedRow['sender']);
                $small['id'] = $SenderName['id'];
                $small['senderStatus'] = $SenderName['status'];
                $small['senderName'] = $SenderName['name'];
                $time = $SenderName['lastupdate'];
                $small['time'] = timeAgo($time);
                array_push($big, $small);
            }

        }
        echo json_encode($big);
    }
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == "listing_accepted_request") {
        $bigId = array();
        $bigName = array();
        $loginId = $_SESSION['id'];
        $accepterStatus = mysqli_query($db, "SELECT * FROM relations WHERE sender=$loginId") or die("unable to find");

        while ($accepterResult = $accepterStatus->fetch_assoc()) {
            if ($accepterResult['status'] == 1) {
                $smallId['receiverId'] = $accepterResult['receiver'];
                array_push($bigId, $smallId);
            }
        }
//        echo json_encode($bigId);
        if (!empty($bigId)) {
//            print_r($bigId);

            foreach ($bigId as $value) {
                $accepterId = $value['receiverId'];
                $accepterNameResult = mysqli_query($db, "SELECT * FROM usertable WHERE id=$accepterId") or die("unable to find");
                $accepterName = $accepterNameResult->fetch_assoc();
                $small['id'] = $accepterName['id'];
                $small['name'] = $accepterName['name'];
                $small['status'] = $accepterName['status'];
                $time = $accepterName['lastupdate'];
                $small['time'] = timeAgo($time);
                array_push($bigName, $small);
            }

        }
        echo json_encode($bigName);
    }
}
if (isset($_POST['onlineId']) && isset($_POST['senderMsg'])) {
    $onlineUserId = $_POST['onlineId'];
    $loginId = $_SESSION['id'];
    $msg = $_POST['senderMsg'];
    $storeLoginUserMsg = mysqli_query($db, "INSERT INTO usermessages(sender,receiver,message) VALUES ($loginId,$onlineUserId,'$msg')") or die("unable to insert");
    echo "success";
}


if (isset($_POST['fetchMsg'])) {
    $count=0;
    $msg = array();
    $onlineUserId = $_POST['fetchMsg'];
    $small['sessionId'] = $_SESSION['id'];
    $fetchMsgQuery = mysqli_query($db, "SELECT * FROM usermessages");

    while ($fetchMsgHistory = $fetchMsgQuery->fetch_assoc()) {
        if (($fetchMsgHistory['sender'] == $_SESSION['id']) && ($fetchMsgHistory['receiver'] == $onlineUserId)) {
            $small['msg'] = $fetchMsgHistory['message'];
            $small['sender'] = $fetchMsgHistory['sender'];
            $small['receiver'] = $fetchMsgHistory['receiver'];
            array_push($msg, $small);
            $count=1;
        }else if (($fetchMsgHistory['sender'] == $onlineUserId) && ($fetchMsgHistory['receiver'] == $_SESSION['id'])){
            $small['msg'] = $fetchMsgHistory['message'];
            $small['sender'] = $fetchMsgHistory['sender'];
            $small['receiver'] = $fetchMsgHistory['receiver'];
            array_push($msg, $small);
            $count=1;
        }
    }

    if ($count == 0) {
        echo "failed";
    } else {
        echo json_encode($msg);
    }

}

//for sender from other side
$count2=0;
if (isset($_POST['setForSender'])) {
    $count=0;
    $msg2 = array();
    $onlineUserId = $_POST['setForSender'];
    $id=$_SESSION['id'];
    $fetchMsgQuery = mysqli_query($db, "SELECT * FROM usermessages WHERE sender=$onlineUserId AND receiver=$id");
//    $row = mysqli_num_rows($fetchMsgQuery);
//    $fetchCurrentMsg = mysqli_query($db,"SELECT * FROM usermessages ORDER BY ID LIMIT $row-1,1");
//    echo $fetchCurrentMsg;
    while ($msg = $fetchMsgQuery->fetch_assoc()){
        $small['msg'] = $msg['message'];
        $small['sender'] = $msg['sender'];
        $small['receiver'] = $msg['receiver'];
        array_push($msg2, $small);
    }
    echo json_encode($msg2);

}
//for sender from other side
?>