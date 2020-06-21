<?php

require_once 'app/helpers.php';
session_start();

$page_title = 'Blog Page';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");
$sql = "SELECT u.name,up.profile_image,p.*, DATE_FORMAT(p.date, '%d/%m/%Y %H:%i:%s') pdate FROM posts p 
        JOIN users u ON u.id = p.user_id 
        JOIN user_profile up ON u.id = up.user_id 
        ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);
?>

<?php include('tpl/header.php'); ?>
<main class="min-height-900px mb-4 pb-4">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 mt-1">
                    <h1>PUBG Blog</h1>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <p>Here you see all the PUBG players posts</p>
                        </div>
                        <div class="col-6">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                            <span class="float-right">
                                <a href="add_post.php" class="btn btn-success">Add Post <i class="fas fa-plus"></i></a>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php if ($result && mysqli_num_rows($result) > 0) : ?>
        <section id="main-content">
            <div class="row">
                <?php while ($post = mysqli_fetch_assoc($result)) : ?>
                <div class="col-12 mb-3">
                    <div class="card mt-2">
                        <div class="card-header">
                            <img width="50" src="images/<?= $post['profile_image'] ?>" class="rounded-circle mr-3"
                                alt="profile image">
                            <span class="text-dark " style="font-size: 25px"><?= htmlentities($post['name']) ?></span>
                            <span class="float-right text-dark mt-2"
                                style="font-size: 25px"><?= $post['pdate'] ?></span>
                        </div>
                        <div class="card-body">
                            <h3><?= $post['title']; ?></h3>
                            <p><?= str_replace("\n", '<br>', $post['article']); ?></p>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                            <div class="float-right">
                                <div class="dropdown ">
                                    <a class="text-dark dropdown-toggle-no-arrow dropdown-toggle text-decoration-none"
                                        href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h pr-1 pt-1 fa-2x"></i>
                                    </a>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="edit_post.php?pid=<?= $post['id']; ?>"> <i
                                                class="fas fa-marker pr-2 text-success"></i> Edit</a>
                                        <a class="delete-post-btn dropdown-item"
                                            href="delete_post.php?pid=<?= $post['id']; ?>"> <i
                                                class="fas fa-trash-alt pr-2 text-danger"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
</main>
<?php include('tpl/footer.php'); ?>