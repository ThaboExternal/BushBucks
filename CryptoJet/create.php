<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="icon" type="image/x-icon" href="extra/jet.ico">
    <title>Add New User</title>
</head>


<!-- this is the create page, to add a new user to the database -->


<!-- This is where the design of the curve starts -->
<div class="svg-container">
  <svg viewbox="0 0 800 400" class="svg">
        <path id="curve" fill="#50c6d8" d="M 800 100 Q 400 250 0 100 L 0 0 L 800 0 L 800 300 Z">
        </path>
    </svg>
</div>
<!-- This is where the design of the curve ends -->


<!-- This is where the header starts -->
<header>
  <h1>CryptoJet</h1>
</header>
<!-- This is where the header ends -->



<body>
    <main>
            
        <section id="add">
            
<!-- This is the form to add starts -->
<!-- i use the isset to make sure the form has not been submitted yet -->
<!-- file is long due to country scroll down menu -->
            <?php

            if (!isset($_REQUEST['submit'])) {
                /*
                echo "<img src=\"tips.jpg\" alt=\"\" width=\"500\" height=\"500\" id=\"pp\">";
                //https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.bitcoininsider.org%2Farticle%2F83440%2F8-innovative-tips-tricks-trading-cryptocurrencies&psig=AOvVaw2cgUWg7f4EUesfHbYPI5Vf&ust=1630507243502000&source=images&cd=vfe&ved=0CAkQjRxqFwoTCIjCg_6-2_ICFQAAAAAdAAAAABAD
                //for credit for the picture
                */
            echo "<style>#pp  {
                    float: right;    
                    margin: 25px 0 0 15px;
                    }
                    </style>";

                echo "<form action=\"create.php\" method=\"POST\">

                    <legend><strong><h1>Add new User</h1></strong></legend><br>
                    
                    <label for=\"firstName\">First Name :</label><br>
                    <input type=\"text\" name=\"firstName\" size=\"25\" id=\"firstName\" required><br><br>

                    <label for=\"lastName\">Last Name :</label><br>
                    <input type=\"text\" name=\"lastName\" size=\"25\" id=\"lastName\" required><br><br>

                    <label for=\"username\">UserName :</label><br>
                    <input type=\"text\" name=\"username\" size=\"25\" id=\"username\" required><br><br>

                    <label for=\"password\">Password :</label><br>
                    <input type=\"password\" id=\"password\" name=\"password\" pattern=\"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}\" title=\"Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters\"><br><br>


                    <label for=\"email\">Email :</label><br>
                    <input type=\"email\" name=\"email\" size=\"25\" id=\"email\" required><br><br>

                    <label for=\"phone\">Phone number :</label><br>
                    <input type=\"tel\" id=\"phone\" name=\"phone\" placeholder=\"xxx-xxx-xxxx\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required><br><br>

                    <label for=\"country\">Country :</label><br>
                    <select id=\"country\" name=\"country\">
                        <option value=\"Afghanistan\">Afghanistan</option>
                        <option value=\"Åland Islands\">Åland Islands</option>
                        <option value=\"Albania\">Albania</option>
                        <option value=\"Algeria\">Algeria</option>
                        <option value=\"American Samoa\">American Samoa</option>
                        <option value=\"Andorra\">Andorra</option>
                        <option value=\"Angola\">Angola</option>
                        <option value=\"Anguilla\">Anguilla</option>
                        <option value=\"Antarctica\">Antarctica</option>
                        <option value=\"Antigua and Barbuda\">Antigua and Barbuda</option>
                        <option value=\"Argentina\">Argentina</option>
                        <option value=\"Armenia\">Armenia</option>
                        <option value=\"Aruba\">Aruba</option>
                        <option value=\"Australia\">Australia</option>
                        <option value=\"Austria\">Austria</option>
                        <option value=\"Azerbaijan\">Azerbaijan</option>
                        <option value=\"Bahamas\">Bahamas</option>
                        <option value=\"Bahrain\">Bahrain</option>
                        <option value=\"Bangladesh\">Bangladesh</option>
                        <option value=\"Barbados\">Barbados</option>
                        <option value=\"Belarus\">Belarus</option>
                        <option value=\"Belgium\">Belgium</option>
                        <option value=\"Belize\">Belize</option>
                        <option value=\"Benin\">Benin</option>
                        <option value=\"Bermuda\">Bermuda</option>
                        <option value=\"Bhutan\">Bhutan</option>
                        <option value=\"Bolivia\">Bolivia</option>
                        <option value=\"Bosnia and Herzegovina\">Bosnia and Herzegovina</option>
                        <option value=\"Botswana\">Botswana</option>
                        <option value=\"Bouvet Island\">Bouvet Island</option>
                        <option value=\"Brazil\">Brazil</option>
                        <option value=\"British Indian Ocean Territory\">British Indian Ocean Territory</option>
                        <option value=\"Brunei Darussalam\">Brunei Darussalam</option>
                        <option value=\"Bulgaria\">Bulgaria</option>
                        <option value=\"Burkina Faso\">Burkina Faso</option>
                        <option value=\"Burundi\">Burundi</option>
                        <option value=\"Cambodia\">Cambodia</option>
                        <option value=\"Cameroon\">Cameroon</option>
                        <option value=\"Canada\">Canada</option>
                        <option value=\"Cape Verde\">Cape Verde</option>
                        <option value=\"Cayman Islands\">Cayman Islands</option>
                        <option value=\"Central African Republic\">Central African Republic</option>
                        <option value=\"Chad\">Chad</option>
                        <option value=\"Chile\">Chile</option>
                        <option value=\"China\">China</option>
                        <option value=\"Christmas Island\">Christmas Island</option>
                        <option value=\"Cocos (Keeling) Islands\">Cocos (Keeling) Islands</option>
                        <option value=\"Colombia\">Colombia</option>
                        <option value=\"Comoros\">Comoros</option>
                        <option value=\"Congo\">Congo</option>
                        <option value=\"Congo, The Democratic Republic of The\">Congo, The Democratic Republic of The</option>
                        <option value=\"Cook Islands\">Cook Islands</option>
                        <option value=\"Costa Rica\">Costa Rica</option>
                        <option value=\"Cote D'ivoire\">Cote D'ivoire</option>
                        <option value=\"Croatia\">Croatia</option>
                        <option value=\"Cuba\">Cuba</option>
                        <option value=\"Cyprus\">Cyprus</option>
                        <option value=\"Czech Republic\">Czech Republic</option>
                        <option value=\"Denmark\">Denmark</option>
                        <option value=\"Djibouti\">Djibouti</option>
                        <option value=\"Dominica\">Dominica</option>
                        <option value=\"Dominican Republic\">Dominican Republic</option>
                        <option value=\"Ecuador\">Ecuador</option>
                        <option value=\"Egypt\">Egypt</option>
                        <option value=\"El Salvador\">El Salvador</option>
                        <option value=\"Equatorial Guinea\">Equatorial Guinea</option>
                        <option value=\"Eritrea\">Eritrea</option>
                        <option value=\"Estonia\">Estonia</option>
                        <option value=\"Ethiopia\">Ethiopia</option>
                        <option value=\"Falkland Islands (Malvinas)\">Falkland Islands (Malvinas)</option>
                        <option value=\"Faroe Islands\">Faroe Islands</option>
                        <option value=\"Fiji\">Fiji</option>
                        <option value=\"Finland\">Finland</option>
                        <option value=\"France\">France</option>
                        <option value=\"French Guiana\">French Guiana</option>
                        <option value=\"French Polynesia\">French Polynesia</option>
                        <option value=\"French Southern Territories\">French Southern Territories</option>
                        <option value=\"Gabon\">Gabon</option>
                        <option value=\"Gambia\">Gambia</option>
                        <option value=\"Georgia\">Georgia</option>
                        <option value=\"Germany\">Germany</option>
                        <option value=\"Ghana\">Ghana</option>
                        <option value=\"Gibraltar\">Gibraltar</option>
                        <option value=\"Greece\">Greece</option>
                        <option value=\"Greenland\">Greenland</option>
                        <option value=\"Grenada\">Grenada</option>
                        <option value=\"Guadeloupe\">Guadeloupe</option>
                        <option value=\"Guam\">Guam</option>
                        <option value=\"Guatemala\">Guatemala</option>
                        <option value=\"Guernsey\">Guernsey</option>
                        <option value=\"Guinea\">Guinea</option>
                        <option value=\"Guinea-bissau\">Guinea-bissau</option>
                        <option value=\"Guyana\">Guyana</option>
                        <option value=\"Haiti\">Haiti</option>
                        <option value=\"Heard Island and Mcdonald Islands\">Heard Island and Mcdonald Islands</option>
                        <option value=\"Holy See (Vatican City State)\">Holy See (Vatican City State)</option>
                        <option value=\"Honduras\">Honduras</option>
                        <option value=\"Hong Kong\">Hong Kong</option>
                        <option value=\"Hungary\">Hungary</option>
                        <option value=\"Iceland\">Iceland</option>
                        <option value=\"India\">India</option>
                        <option value=\"Indonesia\">Indonesia</option>
                        <option value=\"Iran, Islamic Republic of\">Iran, Islamic Republic of</option>
                        <option value=\"Iraq\">Iraq</option>
                        <option value=\"Ireland\">Ireland</option>
                        <option value=\"Isle of Man\">Isle of Man</option>
                        <option value=\"Israel\">Israel</option>
                        <option value=\"Italy\">Italy</option>
                        <option value=\"Jamaica\">Jamaica</option>
                        <option value=\"Japan\">Japan</option>
                        <option value=\"Jersey\">Jersey</option>
                        <option value=\"Jordan\">Jordan</option>
                        <option value=\"Kazakhstan\">Kazakhstan</option>
                        <option value=\"Kenya\">Kenya</option>
                        <option value=\"Kiribati\">Kiribati</option>
                        <option value=\"Korea, Democratic People's Republic of\">Korea, Democratic People's Republic of</option>
                        <option value=\"Korea, Republic of\">Korea, Republic of</option>
                        <option value=\"Kuwait\">Kuwait</option>
                        <option value=\"Kyrgyzstan\">Kyrgyzstan</option>
                        <option value=\"Lao People's Democratic Republic\">Lao People's Democratic Republic</option>
                        <option value=\"Latvia\">Latvia</option>
                        <option value=\"Lebanon\">Lebanon</option>
                        <option value=\"Lesotho\">Lesotho</option>
                        <option value=\"Liberia\">Liberia</option>
                        <option value=\"Libyan Arab Jamahiriya\">Libyan Arab Jamahiriya</option>
                        <option value=\"Liechtenstein\">Liechtenstein</option>
                        <option value=\"Lithuania\">Lithuania</option>
                        <option value=\"Luxembourg\">Luxembourg</option>
                        <option value=\"Macao\">Macao</option>
                        <option value=\"Macedonia, The Former Yugoslav Republic of\">Macedonia, The Former Yugoslav Republic of</option>
                        <option value=\"Madagascar\">Madagascar</option>
                        <option value=\"Malawi\">Malawi</option>
                        <option value=\"Malaysia\">Malaysia</option>
                        <option value=\"Maldives\">Maldives</option>
                        <option value=\"Mali\">Mali</option>
                        <option value=\"Malta\">Malta</option>
                        <option value=\"Marshall Islands\">Marshall Islands</option>
                        <option value=\"Martinique\">Martinique</option>
                        <option value=\"Mauritania\">Mauritania</option>
                        <option value=\"Mauritius\">Mauritius</option>
                        <option value=\"Mayotte\">Mayotte</option>
                        <option value=\"Mexico\">Mexico</option>
                        <option value=\"Micronesia, Federated States of\">Micronesia, Federated States of</option>
                        <option value=\"Moldova, Republic of\">Moldova, Republic of</option>
                        <option value=\"Monaco\">Monaco</option>
                        <option value=\"Mongolia\">Mongolia</option>
                        <option value=\"Montenegro\">Montenegro</option>
                        <option value=\"Montserrat\">Montserrat</option>
                        <option value=\"Morocco\">Morocco</option>
                        <option value=\"Mozambique\">Mozambique</option>
                        <option value=\"Myanmar\">Myanmar</option>
                        <option value=\"Namibia\">Namibia</option>
                        <option value=\"Nauru\">Nauru</option>
                        <option value=\"Nepal\">Nepal</option>
                        <option value=\"Netherlands\">Netherlands</option>
                        <option value=\"Netherlands Antilles\">Netherlands Antilles</option>
                        <option value=\"New Caledonia\">New Caledonia</option>
                        <option value=\"New Zealand\">New Zealand</option>
                        <option value=\"Nicaragua\">Nicaragua</option>
                        <option value=\"Niger\">Niger</option>
                        <option value=\"Nigeria\">Nigeria</option>
                        <option value=\"Niue\">Niue</option>
                        <option value=\"Norfolk Island\">Norfolk Island</option>
                        <option value=\"Northern Mariana Islands\">Northern Mariana Islands</option>
                        <option value=\"Norway\">Norway</option>
                        <option value=\"Oman\">Oman</option>
                        <option value=\"Pakistan\">Pakistan</option>
                        <option value=\"Palau\">Palau</option>
                        <option value=\"Palestinian Territory, Occupied\">Palestinian Territory, Occupied</option>
                        <option value=\"Panama\">Panama</option>
                        <option value=\"Papua New Guinea\">Papua New Guinea</option>
                        <option value=\"Paraguay\">Paraguay</option>
                        <option value=\"Peru\">Peru</option>
                        <option value=\"Philippines\">Philippines</option>
                        <option value=\"Pitcairn\">Pitcairn</option>
                        <option value=\"Poland\">Poland</option>
                        <option value=\"Portugal\">Portugal</option>
                        <option value=\"Puerto Rico\">Puerto Rico</option>
                        <option value=\"Qatar\">Qatar</option>
                        <option value=\"Reunion\">Reunion</option>
                        <option value=\"Romania\">Romania</option>
                        <option value=\"Russian Federation\">Russian Federation</option>
                        <option value=\"Rwanda\">Rwanda</option>
                        <option value=\"Saint Helena\">Saint Helena</option>
                        <option value=\"Saint Kitts and Nevis\">Saint Kitts and Nevis</option>
                        <option value=\"Saint Lucia\">Saint Lucia</option>
                        <option value=\"Saint Pierre and Miquelon\">Saint Pierre and Miquelon</option>
                        <option value=\"Saint Vincent and The Grenadines\">Saint Vincent and The Grenadines</option>
                        <option value=\"Samoa\">Samoa</option>
                        <option value=\"San Marino\">San Marino</option>
                        <option value=\"Sao Tome and Principe\">Sao Tome and Principe</option>
                        <option value=\"Saudi Arabia\">Saudi Arabia</option>
                        <option value=\"Senegal\">Senegal</option>
                        <option value=\"Serbia\">Serbia</option>
                        <option value=\"Seychelles\">Seychelles</option>
                        <option value=\"Sierra Leone\">Sierra Leone</option>
                        <option value=\"Singapore\">Singapore</option>
                        <option value=\"Slovakia\">Slovakia</option>
                        <option value=\"Slovenia\">Slovenia</option>
                        <option value=\"Solomon Islands\">Solomon Islands</option>
                        <option value=\"Somalia\">Somalia</option>
                        <option value=\"South Africa\">South Africa</option>
                        <option value=\"South Georgia and The South Sandwich Islands\">South Georgia and The South Sandwich Islands</option>
                        <option value=\"Spain\">Spain</option>
                        <option value=\"Sri Lanka\">Sri Lanka</option>
                        <option value=\"Sudan\">Sudan</option>
                        <option value=\"Suriname\">Suriname</option>
                        <option value=\"Svalbard and Jan Mayen\">Svalbard and Jan Mayen</option>
                        <option value=\"Swaziland\">Swaziland</option>
                        <option value=\"Sweden\">Sweden</option>
                        <option value=\"Switzerland\">Switzerland</option>
                        <option value=\"Syrian Arab Republic\">Syrian Arab Republic</option>
                        <option value=\"Taiwan\">Taiwan</option>
                        <option value=\"Tajikistan\">Tajikistan</option>
                        <option value=\"Tanzania, United Republic of\">Tanzania, United Republic of</option>
                        <option value=\"Thailand\">Thailand</option>
                        <option value=\"Timor-leste\">Timor-leste</option>
                        <option value=\"Togo\">Togo</option>
                        <option value=\"Tokelau\">Tokelau</option>
                        <option value=\"Tonga\">Tonga</option>
                        <option value=\"Trinidad and Tobago\">Trinidad and Tobago</option>
                        <option value=\"Tunisia\">Tunisia</option>
                        <option value=\"Turkey\">Turkey</option>
                        <option value=\"Turkmenistan\">Turkmenistan</option>
                        <option value=\"Turks and Caicos Islands\">Turks and Caicos Islands</option>
                        <option value=\"Tuvalu\">Tuvalu</option>
                        <option value=\"Uganda\">Uganda</option>
                        <option value=\"Ukraine\">Ukraine</option>
                        <option value=\"United Arab Emirates\">United Arab Emirates</option>
                        <option value=\"United Kingdom\">United Kingdom</option>
                        <option value=\"United States\">United States</option>
                        <option value=\"United States Minor Outlying Islands\">United States Minor Outlying Islands</option>
                        <option value=\"Uruguay\">Uruguay</option>
                        <option value=\"Uzbekistan\">Uzbekistan</option>
                        <option value=\"Vanuatu\">Vanuatu</option>
                        <option value=\"Venezuela\">Venezuela</option>
                        <option value=\"Viet Nam\">Viet Nam</option>
                        <option value=\"Virgin Islands, British\">Virgin Islands, British</option>
                        <option value=\"Virgin Islands, U.S.\">Virgin Islands, U.S.</option>
                        <option value=\"Wallis and Futuna\">Wallis and Futuna</option>
                        <option value=\"Western Sahara\">Western Sahara</option>
                        <option value=\"Yemen\">Yemen</option>
                        <option value=\"Zambia\">Zambia</option>
                        <option value=\"Zimbabwe\">Zimbabwe</option>
                    </select><br><br>


                    <label for=\"prefcoin\">Preferred Currency :</label>
                    <select id=\"prefcoin\" name=\"prefcoin\">
                        <option value=\"btc\">Bitcoin</option>
                        <option value=\"ltc\">Litecoin</option>
                        <option value=\"eth\">Ethereum</option>
                        <option value=\"xrp\">Ripple</option>
                        <option value=\"usdc\">USD Coin</option>
                        <option value=\"xmr\">Monero</option>
                    </select><br><br>

                    <label for=\"code\">Confirmation Code :</label><br>
                    <input type=\"password\" id=\"code\" name=\"code\" pattern=\"[0-9]{4}\" title=\"Must contain 4 digits\"><br><br>


                    <input type=\"submit\" name=\"submit\" value=\"   Add   \" style = \"font-size:20px\">

            </form>";
            /*
            echo "<img src=\"free.png\" alt=\"\" width=\"500\" height=\"500\" id=\"hp\">";
            //https://www.google.com/url?sa=i&url=https%3A%2F%2Ftrendsurferssignals.com%2Ffree-bitcoin-trading-strategy-for-beginners-tradingview%2F&psig=AOvVaw2cgUWg7f4EUesfHbYPI5Vf&ust=1630507243502000&source=images&cd=vfe&ved=0CAkQjRxqFwoTCIjCg_6-2_ICFQAAAAAdAAAAABAO
            // for credit for the picture
            */
            echo "<style>#hp  {
                    float: right;    
                    margin: 25px 0 0 15px;
                    }
                    </style>";
            

            }
        ?>
        </section>

<!-- to add details to DB once form is submitted -->
<!-- This adds a entry to client and wallet table -->
<!-- wallet.php will allow user to create more cryptocurrency wallets -->
        <?php

        if (isset($_REQUEST['submit'])) {
        // add the database credentials
        require_once("config.php");

        // get values from form
        $fname = $_REQUEST['firstName'];
        $lname = $_REQUEST['lastName'];
        $uname = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $cty = $_REQUEST['country'];
        $pref = $_REQUEST['prefcoin'];
        $code = $_REQUEST['code'];



        //startoff with zero coins
        $bal = 0;


        
              
        // make connection to database
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");
        
        $query1 = "SELECT COUNT(*) FROM customer";
        $result1 = mysqli_query($conn, $query1) or die("ERROR: unable to Get total Client query!");
        $row = mysqli_fetch_array($result1);
        $amount = $row[0];

        $query2 = "SELECT COUNT(*) FROM wallet";
        $result2 = mysqli_query($conn, $query2) or die("ERROR: unable to Get total Client query!");
        $row2 = mysqli_fetch_array($result2);
        $amountwal = $row2[0];


        
            
        $clientId = $amount + 1;
        $cryptoId = 1;
        $walletId = $amountwal + 1;


        while($cryptoId != 7){

            

            $query3 = "INSERT INTO  wallet(walletId, cryptoId, balance, userId)
            VALUE('$walletId', '$cryptoId', '$bal', '$clientId')";

            if($cryptoId == 1){
            $result3 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }elseif ($cryptoId == 2) {
            $result4 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }elseif ($cryptoId == 3) {
            $result5 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }elseif ($cryptoId == 4) {
            $result6 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }elseif ($cryptoId == 5) {
            $result7 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }elseif ($cryptoId == 6) {
            $result8 = mysqli_query($conn, $query3) or die("ERROR: unable to execute query!");
          }

            $cryptoId = $cryptoId + 1;
            $walletId = $walletId + 1;
        }//while   
            
            $check = $amountwal + 1;

            $query = "INSERT INTO  customer(clientId, walletId, fname, lname, username, pass, email, phoneNum, country, prefcoin, code)
            VALUE('$clientId', '$check', '$fname', '$lname', '$uname', '$pass', '$email', '$phone','$cty', '$pref','$code')";

                
            $result = mysqli_query($conn, $query) or die("ERROR: unable to Add client query!");

        
            echo "<script> window.location.href =\"login.php\"</script>";

        
        // close the connection to database
        mysqli_close($conn);
        

        }
        ?>

    </main>


<!-- This is where the footer starts -->
<div class="footer-dark">
  <footer>
    <div class="container">
        <p class="copyright">CryptoJet © 2021</p>
    </div>
    </footer>
</div>

</body>

</html>