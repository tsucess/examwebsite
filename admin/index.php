<?php
include './partials/header.php';

//fetch current user's Information from database
if (isset($_SESSION['user_is_admin'])) {

    $current_user_id = $_SESSION['id'];

    if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
        $admin_query = "SELECT id, firstname, lastname, passport_no, email, nationality, avatar,  gender, password, is_super_admin FROM admins WHERE id = $current_user_id LIMIT 1";
        $admin_info = mysqli_query($dbconnect, $admin_query);
        $user = mysqli_fetch_assoc($admin_info);
    } else {
        $user_query = "SELECT id, firstname, lastname, passport_no, email, nationality, avatar, dob, gender, password FROM users WHERE id = $current_user_id LIMIT 1";
        $user_info = mysqli_query($dbconnect, $user_query);
        $user = mysqli_fetch_assoc($user_info);
    }
}

?>

<section class="dashboard">
    <div class="container">
        <p class="message">This is error message!</p>
    </div>

    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <?php if ($_SESSION['user_is_admin'] === 2) :  ?>
                    <li>
                        <a href="dashboard.php"><i class="uil uil-dashboard"></i>
                            <h5>Dashboard</h5>
                        </a>
                    </li>
                <?php endif  ?>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-user"></i>
                        <h5>User Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="forms.php"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="available-courses.php"><i class="uil uil-books"></i>
                        <h5>Available Subjects</h5>
                    </a>
                </li>
                <?php if ($_SESSION['user_is_admin'] == 2) :  ?>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-admin.php"><i class="uil uil-edit"></i>
                            <h5>Manage Admins</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href=" reports.php"><i class="uil uil-list-ul"></i>
                            <h5>Reports</h5>
                        </a>
                    </li>
                <?php endif  ?>
                <?php if ($_SESSION['user_is_admin'] == 1) :  ?>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                <?php endif  ?>
                <?php if ($_SESSION['user_is_admin'] == 0) :  ?>
                    <li>
                        <a href="registered-courses.php"><i class="uil uil-book"></i>
                            <h5>Registered Subjects</h5>
                        </a>
                    </li>
                    <li>
                        <a href="payment-history.php"><i class="uil uil-book"></i>
                            <h5>Payment History</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main id="user">
            <h2>User Profile</h2>
            <table>
                <tbody>
                    <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                        <tr>
                            <td><b> Name:</b></td>
                            <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                        </tr>
                        <tr>
                            <td><b> Nationality:</b></td>
                            <td><?= $user['nationality'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Gender:</b></td>
                            <td><?= $user['gender'] ? 'Male' : 'Female'  ?></td>
                        </tr>
                        <tr>
                            <td><b> NIRC/Passport ID Number:</b></td>
                            <td><?= $user['passport_no'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Role:</b></td>
                            <td><?= $user['is_super_admin'] == 2 ? 'Super Admin' : 'Admin'  ?></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td><b> Name:</b></td>
                            <td><?= "{$user['firstname']} {$user['lastname']}"  ?></td>
                        </tr>
                        <tr>
                            <td><b> Date of Birth:</b></td>
                            <td><?= $user['dob'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Nationality:</b></td>
                            <td><?= $user['nationality'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Gender:</b></td>
                            <td><?= $user['gender'] ? 'MALE' : 'FEMALE'  ?></td>
                        </tr>
                        <tr>
                            <td><b> Email:</b></td>
                            <td><?= $user['email'] ?></td>
                        </tr>
                        <tr>
                            <td><b> NIRC/Passport ID Number:</b></td>
                            <td><?= $user['passport_no'] ?></td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>

            <button class="btn btn-edit">Edit</button>
        </main>
    </div>
</section>
<!-- ******************** End OF Dashboard BUTTONS *********************** -->


<div id="modal-edit-inactive1"></div>
<div id="modal-edit">

    <section class="form_section edit-form">
        <div class="container form_section-container">
            <h2>Edit User</h2>
            <?php if (isset($_SESSION['edit-user'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user'])
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form enctype="multipart/form-data" method="POST" class="dashboard">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <input type="hidden" name="prev_avatar_name" value="<?= $user['avatar'] ?>" placeholder="prev Avatar">
                <input type="hidden" name="prev_password" value="<?= $user['password'] ?>" placeholder="Create New Password">


                <input type="text" name="fname" value="<?= $user['firstname'] ?>" placeholder="First Name">
                <input type="text" name="lname" value="<?= $user['lastname'] ?>" placeholder="First Name">
                <input type="text" name="pnumber" value="<?= $user['passport_no'] ?>" placeholder="NRIC/Passport Number:">
                <div class="control">
                    <select name="nationality" value="<?= $user['nationality'] ?>" id="countries">
                        <option>COUNTRY</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Aland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua & Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                        <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo - Brazzaville</option>
                        <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curacao">Curaçao</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czechia</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                        <option value="Holy See (Vatican City State)">Vatican City</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">North Korea</option>
                        <option value="Korea, Republic of">South Korea</option>
                        <option value="Kosovo">Kosovo</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Laos</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia</option>
                        <option value="Moldova, Republic of">Moldova</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar (Burma)</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Curaçao</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestine</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn Islands</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Réunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russia</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Barthelemy">St. Barthélemy</option>
                        <option value="Saint Helena">St. Helena</option>
                        <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                        <option value="Saint Lucia">St. Lucia</option>
                        <option value="Saint Martin">St. Martin</option>
                        <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                        <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Serbia and Montenegro">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Sint Maarten">Sint Maarten</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                        <option value="South Sudan">South Sudan</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                        <option value="Swaziland">Eswatini</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syria</option>
                        <option value="Taiwan, Province of China">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Vietnam</option>
                        <option value="Virgin Islands, British">British Virgin Islands</option>
                        <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                        <option value="Wallis and Futuna">Wallis & Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <select name="gender" value="<?= $user['gender'] ?>">
                        <option value="0">Female</option>
                        <option value="1">Male</option>
                    </select>
                </div>
                <div class="control">
                    <div class="form_control">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" min="1997-01-01" max="2019-12-31" placeholder="dd-mm-yyyy" name="dob" id="dob">
                    </div>
                    <div class="form_control">
                        <label for="avatar">Upload Passport</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                </div>
                <input type="password" name="createpassword" placeholder="Create New Password">
                <input type="password" name="confirmpassword" value="" placeholder="Confirm New Password">
                <div class="control">
                    <button id="cancel" class="btn-lg"> Cancel</button>
                    <button type="Submit" name="submit" id="save" class="btn-lg"> Update User</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="../js/edit-user.js"></script>
<?php
include '../partials/footer.php';
?>