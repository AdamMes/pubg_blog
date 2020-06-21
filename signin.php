<?php

require_once 'app/helpers.php';

session_start();


if (isset($_SESSION['user_id'])) {
    header('location: blog.php');
    exit;
}

$page_title = 'Signin';
$error = '';

//if client click on button submit
if (isset($_POST['submit'])) {

    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        //collect data from form to simple variables
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $email = trim($email);
        $email = strtolower($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = trim($password);



        //validation
        if (!$email && !$password) {
            $error = '*A valid email and password is required';
        } else if (!$password) {
            $error = '*Please Enter your password';
        } elseif (!$email) {
            $error = '*A valid email is required';
        } else {

            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);

            $sql = "SELECT u.*,up.profile_image FROM users u 
                    JOIN user_profile up ON u.id = up.user_id 
                    WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) == 1) {

                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {
                    $password = password_hash($password, PASSWORD_BCRYPT);


                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_country'] = $user['country'];
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_password'] = $password;
                    $_SESSION['user_image'] = $user['profile_image'];

                    header('location: blog.php');
                    exit;
                } else {
                    $error = '*Worng email or password , try again.';
                }
            } else {

                $error = '*Worng email or password , try again';
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
                    <h1 class="header-bg">Sign in to your PUBG acount</h1>
                    <p>
                        You dont Have an account ? &nbsp;
                        <a href="signup.php">Click Here To Open</a>
                    </p>
                </div>
            </div>
            <span class="text-danger"><?= $error; ?></span>

        </section>
        <section id="main-content">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="POST" autocomplete="off" novalidate="novalidate">
                        <input type="hidden" name="csrf_token" value="<?= $token; ?>">
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span>Email</label>
                            <input value="<?= old('email'); ?>" type="email" name="email" id="email"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span>Password</label>
                            <input style="width:90%" type="password" name="password" id="password" class="form-control">
                            <span><i class="fas fa-eye faeye-2 float-right pb-4" id="eye"></i></span>
                        </div>


                        <input type="submit" value="Signin" name="submit" class="btn btn-info w-50 ml-center">





                </div>
                </form>
            </div>
    </div>
    </section>
</main>
<?php include('tpl/footer.php'); ?>