<?php include "connection.php"; ?>
<?php
date_default_timezone_set('Asia/Kolkata');

function insert_user_data($db,$username, $name, $password){
    $insertQuery = mysqli_query($db,"INSERT INTO usertable(username,name,password) 
VALUES ('$username','$name','$password')") or die("unable to insert");
    if($insertQuery){
        return true;
    }else{
        return false;
    }
}
function select_user_data($db,$username,$password){
    $selectquery = mysqli_query($db,"SELECT * FROM usertable WHERE username='$username' AND password='$password'")
    or die("unable to select");
    $row = $selectquery->fetch_assoc();
    return $row;
}
function update_user_data(){

}
function delete_user_data(){

}

function fetching_rows_data($db){
    $fetchrows = mysqli_query($db,"SELECT * FROM usertable") OR die("unable to fetch records");
    return $fetchrows;
}
function change_status($db,$userid,$status){
    $changestatus = mysqli_query($db,"UPDATE usertable SET status='$status' WHERE id='$userid'") or die("unable to change status");
    return true;
}


function timeAgo($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

    }
    else if($diff->m > 0){
        $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
        $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }

    $timemsg = $timemsg.' ago';
    return $timemsg;
}
function sending_request($db,$receiverId,$status){
    $senderId = $_SESSION['id'];
    $sendquery = mysqli_query($db,"INSERT INTO relations (sender,receiver,status) 
    VALUES ($senderId,$receiverId,$status)");
    return true;
}
function showing_username($db){
    $userid=$_SESSION['id'];
    $namequery = mysqli_query($db,"SELECT * FROM usertable WHERE id=$userid") or die("unable to fetch username");
    $row  =  $namequery->fetch_assoc();
    return $row['username'];
}

function checking_sendrequest($db,$userid,$sendid){
    $checkrequest = mysqli_query($db,"SELECT * FROM relations WHERE sender=$userid AND receiver=$sendid") or die("unable to fetch request");
    $staus = $checkrequest->fetch_assoc();
    if(empty($staus)){
        return "none";
    }else {
        return $staus['status'];
    }
}
function listing_sendrequest_user($db, $userid){
    $list = mysqli_query($db,"SELECT * FROM relations WHERE receiver=$userid") or die("unable to fetch list");
    return $list;
}
function showing_sender_name($db,$senderid){
    $namerow = mysqli_query($db,"SELECT * FROM usertable WHERE id=$senderid") or die("unable to fetch name");
    $name = $namerow->fetch_assoc();
    return $name;
}
function showing_accepted_request($db){
    $userid=$_SESSION['id'];
    $acceptedrequestquery = mysqli_query($db,"SELECT * FROM relations WHERE receiver = $userid ") or die("record not exist");
    return $acceptedrequestquery;
}


function fetching_sender_name($db,$sendername){
    $fetchingname = mysqli_query($db,"SELECT * FROM usertable WHERE id=$sendername") or die("unable to fetch name");
    $name = $fetchingname->fetch_assoc();
    return $name;
}

function create_alluser_row(){

}

?>
