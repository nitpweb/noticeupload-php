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

    echo "<a href='Usernotice.php'>Click here </a>to back to Mynotices<br>";
    echo "<a href='tendersUpload.php' >Click here </a> to Upload New Tender";

?>