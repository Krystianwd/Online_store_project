<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <script src="js/kupno.js"></script>
        <title>Projekt</title>
        <link rel="icon" type="image/x-icon" href="assets/pobrane1.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand">Bethesda</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href='zaloguj.php?akcja=wyloguj'>Wyloguj</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5"></div>
            <div class = "zaloguj">
                <?php
                include_once 'klasy/Baza.php';
                include_once 'klasy/User.php';
                include_once 'klasy/UserMenager.php';
                include_once 'klasy/LoggedIn.php';
                $db = new Baza("localhost", "root", "", "klienci");
                $um = new UserManager();
                $log = new LoggedIn();
                session_start();
                $sessionId = session_id();
                $userId = $um->getLoggedInUser($db, $sessionId);


                if ($userId == -1) {
                    header("location:zaloguj.php");
                } else {
                    echo "Nazwa zalogowanego u??ytkownika:";
                    echo $db->select("select userName from users where id='" . $userId . "'", ["userName"]);
                    $log->loggedInForm();
                    if (filter_input(INPUT_POST, "Kup")) {
                        header("location:kupno.php");
                    }
                    if (filter_input(INPUT_POST, "Sprawdz")) {
                        echo $db->select("select platform,product,payment from `order` where userId='" . $userId . "'", ["platform", "product", "payment"]);
                    }
                    if (filter_input(INPUT_POST, "Edytuj")) {
                        header("location:Edycja.php");
                    }
                    if (filter_input(INPUT_POST, "Usun")) {
                        $sql = "DELETE FROM `order` WHERE userId = $userId";
                        $db->delete($sql);
                        echo 'Usunieto zamowienie';
                    }
                }
                ?>


            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
