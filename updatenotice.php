<?php

    include "User.class.php";

    $dbhelp=new Notices();

    $noticeStatement = $_POST['noticestm'];
    $openDate = $_POST['opendate'];
    $closeDate = $_POST['closedate'];
    $id=$_POST['id'];
    $tname=$_POST['tname'];

    $arr=array($noticeStatement,$openDate,$closeDate);

    $dbhelp->updateNotices($tname,$arr,$id);

    echo "<a href='Usernotice.php'>Click here </a>to back to Mynotices";
    echo "<a href='notice.php' >Click here </a> to back to notices";

?>