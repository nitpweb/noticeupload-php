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
    include 'show_list.php';
    include 'User.class.php';
    $notices = new Notices();
    ?>
    <div class="announcement">
        <h1>Announcement</h1>
        <a href="announcement.php"><button>Upload</button></a>
        <?php
        $arr = $notices->getNotices(Notices::$ANNOUNCEMENT);
        foreach ($arr as $a) {
            echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        }
        ?>
    </div>
    <div class="important">
        <h1>Important</h1>
        <a href="important.php"><button>Upload</button></a>
        <?php
        $arr = $notices->getNotices(Notices::$IMPORTANT);
        foreach ($arr as $a) {
            echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        }
        ?>
    </div>
    <div class="event">
        <h1>Event</h1>
        <a href="event.php"><button>Upload</button></a>
        <?php
        $arr = $notices->getNotices(Notices::$EVENT);
        foreach ($arr as $a) {
            echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";
        }
        ?>
    </div>
</body>

</html>