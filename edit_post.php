<?php

require_once 'app/helpers.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: signin.php');
    exit;
}

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {

    $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

    if ($pid) {

        $uid = $_SESSION['user_id'];
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        mysqli_query($link, "SET NAMES utf8");

        $pid = mysqli_real_escape_string($link, $pid);
        $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result)  == 1) {

            $post = mysqli_fetch_assoc($result);
        } else {
            header('location: blog.php');
            exit;
        }
    } else {
        header('location: blog.php');
        exit;
    }
} else {
    header('location: blog.php');
    exit;
}

$error = [
    'title' => '',
    'article' => '',
];

$page_title = 'Edit Post Form';

if (isset($_POST['submit'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $title = trim($title);
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING);
    $article = trim($article);
    $form_vaild = true;

    if (!$title || mb_strlen($title) < 2) {
        $error['title'] = '*Title is requierd for min 2 chars';
        $form_vaild = false;
    }

    if (!$article || mb_strlen($article) < 2) {
        $error['article'] = '*Article is requierd for min 2 chars';
        $form_vaild = false;
    }


    if ($form_vaild) {

        $title = mysqli_real_escape_string($link, $title);
        $article = mysqli_real_escape_string($link, $article);
        $sql = "UPDATE posts SET title = '$title',article = '$article' WHERE id = $pid";
        $result = mysqli_query($link, $sql);
        header('location: blog.php');
        exit;
    }
}


?>

<?php include('tpl/header.php'); ?>
<main class="min-height-900px">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 mt-1">
                    <h1>Edit you post</h1>
                    <p>Here you can edit your post, do not forget to <b style="text-decoration: underline">Save
                            Changes</b> ! </p>
                </div>
            </div>
        </section>
        <section id="main-content">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="POST" autocomplete="off" novalidate="novalidate">
                        <div class="form-group">
                            <label for="title">*Title</label>
                            <span class="text-danger"><?= $error['title'] ?></span>
                            <input type="text" name="title" id="title" class="form-control"
                                value="<?= $post['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="article">*Article</label>
                            <span class="text-danger"><?= $error['article'] ?></span>
                            <textarea class="form-control" name="article" id="article" cols="30"
                                rows="10"><?= $post['article']; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="submit" name="submit" value="Save changes"
                                    class="btn btn-success ml-center w-50">
                            </div>
                            <div class="col-6">
                                <a href="blog.php" class="btn btn-danger ml-center w-50">Cancle</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include('tpl/footer.php'); ?>