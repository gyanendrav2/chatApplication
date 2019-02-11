<?php $userlist = fetching_rows_data($db) ?>
<?php while ($row = $userlist->fetch_assoc()) { ?>
<?php if ($row['id'] != $_SESSION['id']) { ?>
<!--                                --><?php //if ($row['status'] == 1) {
//                                    $status = "active";
//                                    $status_class = "online_icon";
//                                } else {
//                                    $status = timeAgo($row['lastupdate']);
//                                    $status_class = "online_icon offline";
//                                }

?>
<li class="inactive">
    <div class="d-flex bd-highlight">
        <div class="img_cont">
            <img src="https://devilsworkshop.org/files/2013/01/enlarged-facebook-profile-picture.jpg"
                 class="rounded-circle user_img">
        </div>
        <div class="user_info">

            <span><?php echo $row['name'] ?></span>
            <div class="row">
                <div class="col-md-6">

                    <p style="visibility: hidden;">/2019 05:22222222222</p>
                </div>
                <div class="col-md-6">
                    <input type="hidden" class="fetchingId"
                           value="<?php echo $row['id'] ?>">
                    <?php $checkingfriends = checking_sendrequest($db, $_SESSION['id'], $row['id']) ?>
                    <?php if ($checkingfriends == "none") { ?>
                        <button type="submit"
                                class="btn btn-primary float-right sendrequest"
                                id_attr="<?php echo $row['id'] ?>">send request
                        </button>
                    <?php } else if ($checkingfriends == 0) { ?>
                        <button type="submit" class="btn btn-info float-right">
                            Request pending
                        </button>
                    <?php } else if ($checkingfriends == 1) { ?>
                        <button type="submit"
                                class="btn btn-success float-right "
                        >Request accepted
                        </button>
                    <?php } else { ?>
                        <button type="submit"
                                class="btn btn-danger float-right"
                        >Request deleted
                        </button>
                    <?php }//endif ?>
                </div>
            </div>

        </div>
    </div>
</li>



///////////////////////////////////////////////////////////////////////////////////////////////////////////
        <?php $friendlist = listing_sendrequest_user($db, $_SESSION['id']);
        ?>
        <?php while ($row = $friendlist->fetch_assoc()) { ?>
            <?php if ($row['status'] == 0) { ?>
                <li class="active pendingrequest">

                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://devilsworkshop.org/files/2013/01/enlarged-facebook-profile-picture.jpg"
                                 class="rounded-circle user_img">
                            <!--                                    <span class="online_icon"></span>-->
                        </div>
                        <div class="user_info">
                            <?php $name = showing_sender_name($db, $row['sender']); ?>
                            <span><?php echo $name['username']; ?>

                                <span class="shiftrespose acceptRequest">
                                                <i class="fas fa-trash deleterequest"></i>
                                                <i class="fas fa-user-check accept"
                                                   attr_id="<?php echo $_SESSION['id'] ?>"
                                                   id_sender="<?php echo $row['sender'] ?>"></i>
                                            </span>
                                        </span>
                            <!--                                    <p>Maryam is online</p>-->


                        </div>
                    </div>
                </li>
            <?php } ?>
        <?php } ?>