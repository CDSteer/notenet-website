<?php
include 'src/VivOAuthIMAP.php';
include 'lib/mime_parser.php';
include 'lib/rfc822_addresses.php';

//VivOAuthIMAP Code Starts Here

$email = "cdsteer94@gmail.com";
$access_token = "ya29.LgCoNRwcEeUiQR8AAADV7Q9Ssk1lYPyQhD56RNc0uhMWHy5BLohAb3QpPzR4ZQ";


$imap = new VivOAuthIMAP();
$imap->host = 'ssl://imap.gmail.com';
$imap->port = 993;

$imap->username = $email;
$imap->accessToken = $access_token;


if ($imap->login()) {


    /*
      $header = $imap->getHeader(1); //Returns mail header array

      $mails = $imap->getMessage(1); //Returns mails array

      $headers = $imap->getHeaders(1,10); //Returns mail headers array

      $mails = $imap->getMessage(2); //Returns mails array

      $imap->selectFolder(); // Default is INBOX autoselected after login

      $total = $imap->totalMails('Folder Name'); //Any folder which exist can be passed as folder name

      $folders = $imap->listFolders(); //Lists all folders of mailbox

      $imap->selectFolder('Folder Name'); // Default is INBOX autoselected after login
     */

    /*
     * Using mime_parser you can parse the rfc822 format mail or can write own parser
     * Here in example used a mime_parser_class
     */

    $total = $imap->totalMails(); //By default inbox is selected
    echo $total;
    $mails = $imap->getMessages(1,50);
    // echo "First 50 mails fetched follwing are Email And Subject. <br>";
    // foreach ($mails as $mail) {

    //     $mime = new mime_parser_class();
    //     $parameters = array('Data' => $mail);
    //     $mime->Decode($parameters, $decoded);


    //       //See how much variables you can access
    //       echo "<pre>";
    //       print_r($decoded);
    //       echo "</pre>";

    //     echo "==================== <br>";
    //     echo "<b>From :</b> " . $decoded[0]['ExtractedAddresses']['from:'][0]['address'] . "<br>";
    //     echo "<b>Subject :</b> " . $decoded[0]['Headers']['subject:'] . "<br>";
    //     echo "====== <br>";
    // }
} else {
    echo "Login Failed";
}


?>


<!-- <html>
    <div>
        <?php if (isset($authUrl)) : ?>
            Normal Method Using Email and Password
            <form method="POST">
                Email <input type="text" name="email"/></br>
                Password <input type="password" name="password"/></br>
                <input type="submit" value="Login"/>
            </form>
        <?php endif; ?>
        <?php
        if (isset($authUrl)) {
            echo "<br><br>Or use Oauth method to connect to google <br>";
            print "<a class='login' href='$authUrl'>Login (Connect using google)!</a>";
        } else {
            print "<a class='logout' href='?logout'>Logout</a>";
        }
        ?>
    </div>
</html> -->