<?php

require_once 'app/helpers.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header('location: blog.php');
}

$page_title = 'Signup';


$error = [
    'all' => '',
    'name' => '',
    'email' => '',
    'password' => '',
    'country' => '',
];

//if client click on button submit
if (isset($_POST['submit'])) {
    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        //collect data from form to simple variables
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($link, $name);
        $name = trim($name);
        $name = ucwords(strtolower($name));

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($link, $email);
        $email = trim($email);
        $email = strtolower($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($link, $password);
        $password = trim($password);
        $country = !empty($_POST['country']) ? $_POST['country'] : '';
        $profile_image = 'avatar-pubg.png';
        $form_valid = true;
        define('MAX_FILE_SIZE', 1024 * 1024 * 5);

        //validation

        if (!$name && !$email && !$password && !$country) {
            $error['all'] = '*Please Enter Details';
            $form_valid = false;
        }
        if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {
            $error['name'] = '*Name is requried for min 2 chars and max';
            $form_valid = false;
        }
        if (!$email) {
            $error['email'] = '*Please enter a valid email';
            $form_valid = false;
        } elseif (email_exist($link, $email)) {
            $error['email'] = '*This email already taken';
            $form_valid = false;
        }
        if (!$password || strlen($password) < 6 || strlen($password) > 20) {
            $error['password'] = '*Password is required for min 6 chars and max 20 chars';
            $form_valid = false;
        }
        if (!$country) {
            $error['country'] = '*Please Select Country';
            $form_valid = false;
        }
        if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {

            if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

                if (isset($_FILES['image']['name'])) {
                    $allowed_ex = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
                    $img_details = pathinfo($_FILES['image']['name']);

                    if (in_array(strtolower($img_details['extension']), $allowed_ex)) {

                        $profile_image = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
                        if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' .  $profile_image);
                        }
                    }
                }
            }
        }

        if ($form_valid) {
            //everthing ok, lets connect MYSQL
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users VALUES(null,'$name','$email','$country','$password')";
            mysqli_query($link, "SET NAMES utf8");
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link) == 1) {

                $new_user_id = mysqli_insert_id($link);
                $sql = "INSERT INTO user_profile VALUES(null,$new_user_id,'$profile_image')";
                $result = mysqli_query($link, $sql);

                if ($result && mysqli_affected_rows($link) > 0) {

                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] =  $new_user_id;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_password'] = $password;
                    $_SESSION['user_country'] = $country;
                    $_SESSION['user_image'] = $profile_image;
                    header('location: blog.php');

                    exit;
                }
            }
        }
    }

    $token = csrf();
} else {
    $token = csrf();
}

?>
<?php include('tpl/header.php'); ?>
<main class="min-height-900px">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 mt-1">
                    <h1>Signup to PUBG Blog</h1>
                    <p>Leave your details here and after that start bloging with all the PUBG player all over the world
                    </p>
                </div>
            </div>
        </section>
        <section id="main-content">
            <div class="container-fluid">
                <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= $token; ?>">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> Name</label>
                                <span class="text-danger"><?= $error['name']; ?></span>
                                <input value="<?= old('name'); ?>" type="text" name="name" id="name"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span>Email</label>
                                <span class="text-danger"><?= $error['email']; ?></span>
                                <input value="<?= old('email'); ?>" type="email" name="email" id="email"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span>Password</label>
                                <span class="text-danger"><?= $error['password']; ?></span>

                                <input style="width:90%" type="password" name="password" id="password"
                                    class="form-control">
                                <span><i class="fas fa-eye float-right pb-4" id="eye"></i></span>
                            </div>


                        </div>
                        <div class="col-lg-6 pt-1">
                            <div class="form-group ">
                                <label for=""><span class="text-danger">*</span>Country</label>
                                <span class="text-danger "><?= $error['country']; ?></span>
                                <br>
                                <select for="country" name="country" id="country" class="w-100">
                                    <option
                                        value="<?= isset($_POST['country']) ? $_POST['country'] : 'Choose country'  ?>">
                                        <?= isset($_POST['country']) ? $_POST['country'] : 'Choose country'  ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group pt-2">
                                <label for="image">Profile Image:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger"><?= $error['all']; ?></span>

                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" value="Signup" name="submit" class="btn btn-info mx-auto w-50"><br>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<?php include('tpl/footer.php'); ?>