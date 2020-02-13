<?php
    include 'show_list.php';
    include 'User.class.php';

    // Start session
    if (!session_id()) {
        session_start();
    }

    $currentDir = getcwd();
    $uploadDirectory = "/files/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png','pdf','mp4','mp3']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $nameofPerson = $_POST['firstname'];
    $noticeStatement = $_POST['noticestm'];
    $openDate = $_POST['opendate'];
    $closeDate = $_POST['closedate'];
    $msgtype = $_POST['msgtype'];
    $userData = $_SESSION['userData'];
    echo $nameofPerson.$msgtype;

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 20000000) {
            $errors[] = "This file is more than 20MB. Sorry, it has to be less than or equal to 20MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                //echo "The file " . basename($fileName) . " has been uploaded";

            //header('Location: index.php');


            // session_start();
            $url_array = explode('?', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            $url = $url_array[0];

            require_once 'google-api-php-client/src/Google_Client.php';
            require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
            $client = new Google_Client();
            $client->setClientId('1002091321411-lle8r296e7811q4m63eg2m7fm4rua27j.apps.googleusercontent.com');
            $client->setClientSecret('FzCyy3_tmtJZfIAKsEoIRd3H');
            $client->setRedirectUri($url);
            $client->setScopes(array('https://www.googleapis.com/auth/drive'));
            if (isset($_GET['code'])) {
                // $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
                $_SESSION['accessToken'] = $data = $client->authenticate($_GET['code']);
                $file = fopen('token.json', 'w');
                fwrite($file, json_encode($data));
                fclose($file);
                
                header('location:' . $url);
                exit;
            } elseif (!isset($_SESSION['accessToken'])) {
                $data = file_get_contents('token.json');
                echo "new data";
                print_r($data);
                if($data != null || $data != ''){
                    $_SESSION['accessToken'] = json_decode($data);
                }else{
                    $client->authenticate();
                }
                
                
            }
            $files = array();
            $dir = dir('files');
            while ($file = $dir->read()) {
                if ($file != '.' && $file != '..') {
                    $files[] = $file;
                }
            }
            $dir->close();
            #if (!empty($_POST)) {
            $client->setAccessToken($_SESSION['accessToken']);
            // print_r($_SESSION['accessToken']);
            $service = new Google_DriveService($client);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file = new Google_DriveFile();
            foreach ($files as $file_name) {
                $file_path = 'files/' . $file_name;
                $mime_type = finfo_file($finfo, $file_path);
                $file->setTitle($file_name);
                $file->setDescription('This is a ' . $mime_type . ' document');
                $file->setMimeType($mime_type);
                $AnnouncementsId = '14j_DsNSeBTLfc3N-snESgq5C5V172XCy';
                $ImportantId = '1vgjpeLraRIjKjZR5_NQZR21s_mIicLyQ';
                $EventId = '1-b2647RR-cKpH_VITCWvlaC_EmMtEujP';
                // $ANNOUNCEMENT_FILE = 'csv/announcement.csv';
                // $IMPORTANT_FILE = 'csv/important.csv';
                // $EVENTS_FILE = 'csv/events.csv';

                $notices = new Notices();

                switch ($msgtype) {
                    case 'Announcements':
                        $targetFile = Notices::$ANNOUNCEMENT;
                        $parentId = $AnnouncementsId;
                        break;
                    case 'Important':
                        $targetFile = Notices::$IMPORTANT;
                        $parentId = $ImportantId;
                        break;
                    case 'Events':
                        $targetFile = Notices::$EVENT;
                        $parentId = $EventId;
                }
                // $file->setShared(1);
                $parent = new Google_ParentReference();
                $parent->setId($parentId);
                $file->setParents(array($parent));
                // $file->setParents(array('1FWZYjynhELamqBV8MseyA1htYDRWiMNZ'));
                $obj = $service->files->insert(
                    $file,
                    array(
                        'data' => file_get_contents($file_path),
                        'mimeType' => $mime_type
                    )
                );
                $url = $obj['alternateLink'];
                //print_r($obj['alternateLink']);
                $row = array($userData['first_name'], $userData['email'],$noticeStatement, $url,$openDate,$closeDate, date("Y-m-d"), time());
                

                $notices->createNotice($targetFile,$row);

                print_r($row);

                // writeData($targetFile, $row);

                
                unlink($file_path);
                //header('location:' . 'notice.php');
                // $testFile = $service->files->get("1O_gIFbOhJj_PrJMU7aIdZNbeoCMGHxkJ");
                // print_r($testFile);
            }

            finfo_close($finfo);
    // header('location:'.$url);exit;
    // echo "test";
#}


            
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


?>