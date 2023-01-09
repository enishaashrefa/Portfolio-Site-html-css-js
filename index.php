<?php


require 'includes/PHPMailer.php';
require 'includes/Exception.php';
require 'includes/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$pdo = new PDO('mysql:host=localhost;port=3306;dbname=portfolio_form', 'root', '');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$warning_msg = [];


$name = '';
$email = '';



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    if (!$name) {

        $warning_msg[] = 'Name is required';
    }

    if (!$email) {

        $warning_msg[] = 'Email is required';
    }

    if (empty($warning_msg)) {


        $statement = $pdo->prepare("INSERT INTO user (name, email, message) VALUE (:name, :email, :message)");

        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':message', $message);


        $statement->execute();

        header('Location: index.php');


        ///------Mailerfunction-----------


        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";

        $mail->SMTPAuth = "true";


        $mail->SMTPSecure = "tls";

        $mail->Port = "587";

        $mail->Username = "enishaashrefa@gmail.com";

        $mail->Password = "hrcxlnqwppvlysug";

        $mail->setFrom($email);

        $mail->isHTML(true);

        $mail->Subject = "Message for Me";

        $mail->Body = "Hi ! This is " . $name . "." . " " . $message;

        $mail->addAddress("enishaashrefa@gmail.com");

        $mail->Send();


        // if ($mail->Send()) {
        //     echo "email sent";
        // } else {
        //     echo "Error";
        // }

        $mail->smtpClose();
    }
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio Website</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/6eecf5f54b.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="header">
        <div class="container">
            <nav>
                <!----<img src="images/logo.png" class="logo">-->
                <ul id="sidebar">
                    <li><a href="#header">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#research">Research Work</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <i class="fa-solid fa-circle-xmark" onclick="closemenu()"></i>


                </ul>

                <i class="fa-solid fa-bars" onclick="openmenu()"></i>

            </nav>

            <div class="headertext">
                <!-- <p>Web Developer</p> -->
                <h1>Hello! I am <span>Enisha</span>,<br> a Computer Engineer</h1>
            </div>

        </div>





    </div>



    <!------about------>
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="about-col-1">
                    <img src="images/Background1.jpg" alt="">
                </div>
                <div class="about-col-2">
                    <h1 class="subtitle">About Me</h1>
                    <p>I believe in progression . I am always up for the challenges that will lead me to become a better version of me. Therefore, I feel , being a student of Computer Science, there are no other alternatives to hard work and perseverance . And, I am doing it in my way to reach my goal with keeping up the good work and patience.</p>
                    <div class="tab-titles ">
                        <p class="tab-links active-link" onclick="opentab('skills')">Skills</p>
                        <p class="tab-links" onclick="opentab('experience')">Experience</p>
                        <p class="tab-links" onclick="opentab('education')">Education</p>
                    </div>
                    <div class="tab-contents active-tab" id="skills">
                        <ul>
                            <li><span>Web Development, Machine Learning</span><br> Developing web interfaces using HTML, CSS, PHP, BOOTSTRAP, LARAVEL and etc.</li>
                            <li><span>Leadership, Project Management</span><br> Managing and organizing things in the best possible way </li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="experience">
                        <ul>

                            <li><span>2020, Feb - 2021, Jun </span><br> Associate Public Relations at UIU App Forum</li>
                            <li><span>2020, Nov - 2022, Aug </span><br> Instrutor at UIU App Forum</li>
                            <li><span>2021, June - 2022, Aug</span><br> Treasurer at UIU App Forum </li>
                            <li><span>2022, Sep - Present </span><br> Trainee Web Developer at The Recreation IT</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="education">
                        <ul>
                            <li><span>BSc in CSE</span><br>Uinted International University</li>
                            <li><span>HSC in Science</span><br>Brahmanbaria Govt. College</li>
                            <li><span>SSC in Science</span><br>Ideal Residential School and College, Brahmanbaria</li>

                        </ul>
                    </div>


                </div>
            </div>

        </div>
    </div>


    <!--research work -->

    <div id="research">
        <div class="container">
            <div class="row">
                <h1 class="subtitle">Research Work</h1>
                <p>My undergrad thesis was "Development of real time fall risk assessment tool based on centre of gravity and limits of stability information". It was supervised by Mr. Rakibul Haque Sajal and co-supervised by Dr. Arif Reza Anwary. </p>
            </div>
        </div>

    </div>



    <!--Contact-->

    <div id="contact">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <h1 class="subtitle">Contact</h1><br>

                    <p> <i class="fa-solid fa-envelope"></i>eashrefa171057@bscse.uiu.ac.bd</p>
                    <p><i class="fa-solid fa-phone"></i>01848425544</p>
                    <div class="icons">
                        <a href="https://www.linkedin.com/in/enishaashrefa/"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/Enishaaaaaa"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/enisha_ashrefa/"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                    <a href="images/Enisha Ashrefa-CV.pdf" download class="btn btn2">Download CV</a>
                </div>
                <div class="col-2">
                    <form method="POST" action="index.php">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                        <textarea name="message" rows="6" placeholder="Message"></textarea>
                        <button type="submit" class="btn btn2">Submit</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!--Copyright-->
    <div class="copyright">

        <p>Copyright @ Enisha </p>



    </div>




    <script src="jscript.js"></script>


</body>

</html>