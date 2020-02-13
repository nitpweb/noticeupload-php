<!DOCTYPE html>
<html>
<style>
    input[type=text],
    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>

<body>

    <h3>Edit your notices</h3>
    <div>
        <?php
        include 'User.class.php';
        session_start();
        $id = $_GET['id'];
        $tname = $_GET['tname'];
        $db = new Notices();
        $notice = $db->getNoticeById($tname, $id);
        if ($notice != null && $notice['email'] == $_SESSION['userData']['email']) {
            print_r($notice);
            $title = $notice['title'];
            $odate = $notice['opendate'];
            $cdate = $notice['closedate'];
        } else {
            // redirect to a page of not authorized
        }
        ?>
        <form action="updatenotice.php" method="post">

            <label for="NoticeStatement">NoticeStatement</label><br>
            <textarea rows="4" cols="100%" name="noticestm" value=""><?php echo $title; ?></textarea><br>

            <label for=" opendate">Open Date : </label>
            <input type="date" name="opendate" value="<?php echo $odate; ?>"><br><br>

            <label for=" closedate">close Date : </label>
            <input type="date" name="closedate" value="<?php echo $cdate; ?>"><br>

            <input type="submit" name="submit" value="Click to Update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="tname" value="<?php echo $tname; ?>">

        </form>
    </div>

    <?php

    ?>


</body>

</html>