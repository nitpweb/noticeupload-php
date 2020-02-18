<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        div {
            border: solid 2px black;
            margin: 16px;
            padding: 16px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'show_list.php';
    include 'User.class.php';
    $notices = new Notices();
    ?>
    <!-- <div class="announcement">
        <h1>Announcement</h1>
        <?php
        // $arr = $notices->getNoticesByEmail(Notices::$ANNOUNCEMENT, $_SESSION['userData']['email']);
        // foreach ($arr as $a) {
        //     echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        //     echo "<a href='editNotice.php?id=" . $a['id'] . "&tname=announcements'>Edit</a>";
        // }
        ?>
    </div>
    <div class="important">
        <h1>Important</h1>
        <?php
        // $arr = $notices->getNoticesByEmail(Notices::$IMPORTANT, $_SESSION['userData']['email']);
        // foreach ($arr as $a) {
        //     echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        // }
        ?>
    </div>
    <div class="event">
        <h1>Event</h1>
        <?php
        // $arr = $notices->getNoticesByEmail(Notices::$EVENT, $_SESSION['userData']['email']);
        // foreach ($arr as $a) {
        //     echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        // }
        ?>
    </div> -->

    <div class="tender">
        <h1>Tender</h1>
        <?php
        $arr = $notices->getNoticesByEmail(Notices::$TENDER, $_SESSION['userData']['email']);
        foreach ($arr as $a) {
            echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
            echo "<a href='editNotice.php?id=" . $a['id'] . "&tname=".Notices::$TENDER."'>Edit</a>";
        }
        ?>
    </div>

</body>

</html>