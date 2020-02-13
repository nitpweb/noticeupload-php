<?php
// Include configuration file 
// require_once 'configimportant.php';


define('GOOGLE_CLIENT_ID', '915024648862-b03sfabagou7hmv1veo6qc299l8uakd3.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'lN_JB-L1S8qO0usCqWLp8QDe');
define('GOOGLE_REDIRECT_URL', 'http://localhost/GoogleLogin/important.php');

// Start session
if (!session_id()) {
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);

// Include User library file 
require_once 'User.class.php';

if (isset($_GET['code'])) {
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var("http://localhost/GoogleLogin/important.php", FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    // Get user profile data from google 
    $gpUserProfile = $google_oauthV2->userinfo->get();

    // Initialize User class 
    $user = new User();

    // Getting user profile info 
    $gpUserData = array();
    $gpUserData['oauth_uid']  = !empty($gpUserProfile['id']) ? $gpUserProfile['id'] : '';
    $gpUserData['first_name'] = !empty($gpUserProfile['given_name']) ? $gpUserProfile['given_name'] : '';
    $gpUserData['last_name']  = !empty($gpUserProfile['family_name']) ? $gpUserProfile['family_name'] : '';
    $gpUserData['email']       = !empty($gpUserProfile['email']) ? $gpUserProfile['email'] : '';
    $gpUserData['gender']       = !empty($gpUserProfile['gender']) ? $gpUserProfile['gender'] : '';
    $gpUserData['locale']       = !empty($gpUserProfile['locale']) ? $gpUserProfile['locale'] : '';
    $gpUserData['picture']       = !empty($gpUserProfile['picture']) ? $gpUserProfile['picture'] : '';

    // Insert or update user data to the database 
    $gpUserData['oauth_provider'] = 'google';
    $userData = $user->checkUser($gpUserData);

    // Storing user data in the session 
    $_SESSION['userData'] = $userData;

    // Render user profile data 
    if (!empty($userData)) {
        if ($userData['email'] == "kundan3316@gmail.com" || $userData['email'] == "jayantrajhanitp@gmail.com") {
            // $output     = '<h2>Google Account Details</h2>';
            // $output .= '<div class="ac-data">';
            // $output .= '<img src="' . $userData['picture'] . '" style="width=200px; height=200px;">';
            // $output .= '<p><b>Google ID:</b> ' . $userData['oauth_uid'] . '</p>';
            // $output .= '<p><b>Name:</b> ' . $userData['first_name'] . ' ' . $userData['last_name'] . '</p>';
            // $output .= '<p><b>Email:</b> ' . $userData['email'] . '</p>';
            // $output .= '<p><b>Gender:</b> ' . $userData['gender'] . '</p>';
            // $output .= '<p><b>Locale:</b> ' . $userData['locale'] . '</p>';
            // $output .= '<p><b>Logged in with:</b> Google Account</p>';
            // $output .= '<p>Logout from <a href="logout.php">Logout</a></p>';
            // $output .= '</div>';
            $output = '<p>Logout from <a href="logout.php">Logout</a></p>';
            echo "Welcome  <h2>" . $userData['email'] . "</h2>";

?>

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

                <h3>Upload to important</h3>

                <a href="Usernotice.php"><button>My current Notices</button></a>
                <a href="Userarchive.php"><button>My archive Notices</button></a>
                <div>
                    <form action="fileUpload.php" method="post" enctype="multipart/form-data">
                        <label for="name">Your Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name.."><br>
                        <label for="NoticeStatement">NoticeStatement</label><br>
                        <textarea rows="4" cols="100%" name="noticestm">
                    </textarea><br>

                        <label for="opendate">Open Date : </label>
                        <input type="date" name="opendate"><br><br>

                        <label for="closedate">close Date : </label>
                        <input type="date" name="closedate"><br>

                        <!-- <label for="msgtype">Type</label>
                        <select id="country" name="msgtype">
                            <option value="Announcements">Announcements</option>
                            <option value="Important">Important</option>
                            <option value="Events">Events</option>
                        </select> -->

                        <input type="text" style="display: none;" id="eventin" name="msgtype">
                        <label for="FileChoose">Choose the fileToUpload</label><br><br>
                        <input type="file" name="myfile" id="fileToUpload">

                        <input type="submit" name="submit" value="Upload File Now">
                    </form>
                </div>

                <script>
                    document.getElementById('eventin').value = "Important";
                </script>


                <?php

                ?>


            </body>

            </html>
<?php

        } else {
            $output = 'Sorry you dont have right to upload a notice on web portal you are tracked by NITP';
            $output .= '<p>Logout from <a href="logout.php">Logout</a></p>';
        }
    } else {
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    // Get login url 
    $authUrl = $gClient->createAuthUrl();

    // Render google login button 
    $output = '<a href="' . filter_var($authUrl, FILTER_SANITIZE_URL) . '"><img src="images/signinbtn.png" alt=""/></a>';
}
?>

<div class="container">
    <!-- Display login button / Google profile information -->
    <?php echo $output; ?>
</div>