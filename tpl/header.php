<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/icon.png">
    <title>PUBG BLOG | <?= $page_title; ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="./"><img src="images/icon.png" alt="website icon"></a>
                <button class="navbar-toggler " type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light mt-1 text-center" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light mt-1 text-center" href="blog.php">Blog</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <?php if (!isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-light mt-1 text-center" href="signin.php">Singin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light mt-1 text-center" href="signup.php">Singup</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item">

                            <a class="nav-link text-light text-center"
                                href="profile.php?uid=<?= $_SESSION['user_id']; ?>">
                                <img class="rounded-circle" width="40" src="images/<?= $_SESSION['user_image']; ?>"
                                    alt="user-profile-image"> &nbsp;
                                <?= htmlentities($_SESSION['user_name']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger text-center margin-for-nav" href="logout.php">Logout</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>