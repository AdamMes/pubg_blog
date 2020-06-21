<?php


$for_time = 60 * 60 * 24 * 30;
session_set_cookie_params($for_time);
session_start();

$page_title = 'Home'

?>

<?php include('tpl/header.php'); ?>
<main class="min-height-900px">
    <div class="max-height-600px">
        <div class="img-fluid img-bg"></div>
        <div class="container">
            <section id="header-content">
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <h1>Welcome to PUBG Blog!</h1>
                        <p>Website blog for all the PUBG players all over the world.</p>
                        <p class="mt-4">
                            <button><a href="signup.php">Join Us Now!</a></button>
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <section class="main-content pt-4 mb-4 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">What is PUBG?</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">

                        <p>PlayerUnknown's Battlegrounds (PUBG) is an online multiplayer battle royale game developed
                            and published by PUBG Corporation, a subsidiary of South Korean video game company Bluehole.
                            The game is based on previous mods that were created by Brendan "PlayerUnknown" Greene for
                            other games, inspired by the 2000 Japanese film Battle Royale, and expanded into a
                            standalone game under Greene's creative direction. In the game, up to one hundred players
                            parachute onto an island and scavenge for weapons and equipment to kill others while
                            avoiding getting killed themselves. The available safe area of the game's map decreases in
                            size over time, directing surviving players into tighter areas to force encounters. The last
                            player or team standing wins the round.</p>


                    </div>
                    <div class="col-lg-4">
                        <p>Battlegrounds was first released for Microsoft Windows via Steam's early access beta program
                            in March 2017, with a full release in December 2017. The game was also released by Microsoft
                            Studios for the Xbox One via its Xbox Game Preview program that same month, and officially
                            released in September 2018. A free-to-play mobile version for Android and iOS was released
                            in 2018, in addition to a port for the PlayStation 4. A version for the Google Stadia
                            streaming platform was released in April 2020. Battlegrounds is one of the best-selling and
                            most-played video games of all time. As of December 2019, the PC and console versions of the
                            game have sold over 60 million units, in addition to PUBG Mobile having crossed 600 million
                            downloads.</p>


                    </div>
                    <div class="col-lg-4" align="center">
                        <iframe width="100%" height="300" src="https://www.youtube-nocookie.com/embed/4rQ6ahrzUdU"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="row hp-bg-2 py-4 pl-4">
                    <div class="col-12">
                        <div class="container">
                            <div class="jumbotron my-3">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis necessitatibus
                                    eos
                                    eaque voluptate tempora iusto cupiditate voluptatum, fugiat odio veniam voluptas
                                    nulla
                                    sit! Aperiam, libero vel. Odit, error, natus ullam dolorum voluptatem minus, non
                                    reiciendis eos quas quisquam accusamus dolor ipsum sit voluptatum porro quidem
                                    doloribus
                                    odio doloremque maiores necessitatibus. Laudantium nesciunt ut rerum? Maxime
                                    molestias
                                    placeat eius reprehenderit eveniet, error cumque repellat reiciendis. Dolorum,
                                    expedita
                                    magni quam magnam est nisi? Eius ea voluptatum magni id corrupti dolores ipsam
                                    adipisci
                                    placeat pariatur ipsa vitae laudantium sunt corporis, aut rerum nihil distinctio
                                    iusto

                                    architecto magni, voluptate assumenda ullam perspiciatis distinctio eligendi et
                                    similique ea labore placeat hic expedita cum nam! Dolores sunt aliquid reprehenderit
                                    mollitia aperiam adipisci voluptas fugiat ipsam quam! Adipisci vero, modi
                                    iure quos obcaecati quidem ex ad praesentium. Ratione repudiandae non iusto

                                </p>
                            </div>


                        </div>


                    </div>
                </div>
            </div>


        </section>
</main>
<?php include('tpl/footer.php');