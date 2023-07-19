<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Customer Support</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <style>
        h2 {
            font-family: fantasy;
            text-align: center;
        }

        .container .inquiry {
            font-family: cursive;
            font-size: 2em;
        }

        .contact_form {
            opacity: 85%;
            margin-bottom: 10%;
            height: 80%;
        }

        .form_box {
            width: 45%;
            height: 2em;
            font-size: 15px;
        }

        .footer_left {
            margin-top: 0%;
            margin-bottom: 0%;
        }

        .form_info {
            font-family: Georgia, 'Times New Roman', Times, serif;
            color: rgb(25, 100, 25);
        }

        .Add {
            width: 32%;
            height: 2em;
            font-size: 15px;
        }

        .country {
            width: 25%;
            font-size: 15px;
        }

        .message {
            width: 100%;
            font-size: 15px;
        }

        .button {
            align-items: center;
        }

        .footer {
            margin-left: 15%;
            margin-right: 15%;
            width: 60%;
            height: 40%;
            padding-top: 2%;
            padding-bottom: 2%;
            padding-left: 5%;
            padding-right: 5%;
            font-size: 100%;
            opacity: 90%;
            text-align: center;
        }

        .footer a {
            color: rgb(5, 48, 85);
        }

        .container .button {
            background-color: rgb(25, 100, 25);
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            justify-content: center;
        }

        /* Additional Styles */
        .contact_form {
            background-color: rgb(5, 48, 85);
            margin-top: 0%;
            align-self: center;
            margin-left: 5%;
            margin-right: 5%;
            padding-left: 5%;
            padding-right: 5%;
            color: aliceblue;
            width: 80%;
            padding-bottom: 10%;
        }

        .form_box {
            align-self: center;
            padding-left: 2%;
            padding-right: 2%;
        }

        .form_info {
            color: #fff;
        }

        .message {
            padding-left: 2%;
        }

        .button {
            margin-top: 2%;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="home.php">
                <img src="logo.png" alt="Recipe App Logo">
            </a>
        </div>
        <nav>
            <ul class="centered">
                <li><a href="about-us.php">About</a></li>
                <li><a href="recipeQuery.php">Recipes</a></li>
                <li><a href="customer_support.php">Support</a></li>
                <li class="login"><a class="usertext" href="
                    <?php
                        if (isset($_SESSION[" username"])) { echo "editProf.php" ; } else { echo "login.php" ; } ?>
                        ">Login</a></li>
            </ul>
        </nav>
    </header>

    <?php
            if (isset($_SESSION["username"])) {
                echo "<script> document.getElementsByClassName('usertext')[0].innerHTML = '" . $_SESSION["username"] . "' </script>";
            }
        ?>


    <div class="faqs">
        <h2>FAQs</h2>
        <h3>1. What types of dietary preferences does the app cater to?</h3>
        <p>The app caters to a wide range of dietary preferences, including
            vegan, gluten-free, and many more. Simply tell us your dietary
            needs and we'll suggest recipes that fit your preferences.</p>

        <h3>2. How does the app suggest recipes?</h3>
        <p>Our app uses a unique algorithm to suggest recipes based on your
            personal dietary preferences. You can filter by cuisine,
            ingredient, and cooking time to find the perfect recipe for
            any occasion.</p>

        <h3>3. What if I don't have all the ingredients for a recipe?</h3>
        <p>No problem! Our app also offers a convenient ingredient delivery
            service that can get your selected recipe's ingredients
            delivered to your doorstep in under 30 minutes. Simply add the
            recipe and number of people to your cart and sit back as we
            handle the rest.</p>

        <h3>4. Can I save my favorite recipes for later?</h3>
        <p>Absolutely! You can save your favorite recipes to your profile
            for easy access later on. Plus, our app also suggests similar
            recipes that you might enjoy based on your saved favorites.</p>

        <h3>5. What is the subscription model?</h3>
        <p>The app is free to use for a month! After which there is a $4.99
            subscription fee. You can also verify your student status and
            get the student plan for just $2.99/month. Ingredient
            delivery fees may apply if you choose to use that service.</p>
    </div>

    <div class='container'>
        <p class="inquiry">General Inquiry</p>
        <br />
        <p class="form_info">
            Questions about what we do or our services? Any suggestions?
            <br />
            Please leave your queries, concerns or comments below and we'll respond promptly.
            <br /> <br />
        </p>
        <form method="post" name="form1" id="form1">
            <input type='text' name="fname" class="form_box" placeholder="First Name">
            <input type='text' name="lname" class="form_box" placeholder="Last Name">
            <br />
            <br />
            <input type='text' name="email" class="form_box" placeholder="Email Address">
            <input type='text' name="phone" class="form_box" placeholder="Phone Number">
            <br />
            <br />
            <textarea class="message" rows='5' placeholder="Write your message here"></textarea>
            <br />
            <br />
            <input type='reset' class="button">
            <input type='button' class="button" value='send inquiry' name="submit">
            <br />

    </div>
    <div class="footer">
        <p class="footer_left" ;>Email :
            <a href="mailto:info@gotorecipes.com">info@gotorecipes.com</a>
        </p>

        <br />
        <p class="footer_left" ;>Phone: +1 999 999 9999</p>
        <br />
        <p class="footer_left" ;>Address:
            GoTo Recipes, 14 Summer St, Somerville, MA 02144</p>

    </div>
    <script>
        function validate() {

            // Getting all form elements in order to be able to validate

            var fname = document.getElementsByName("fname")[0].value;
            var lname = document.getElementsByName("lname")[0].value;
            var phone = document.getElementsByName("phone")[0].value;
            var email = document.getElementsByName("email")[0].value;


            if (!fname) {
                alert("Please enter your first name.");
                return false;
            }

            if (!lname) {
                alert("Please enter your last name.");
                return false;
            }

            if (!phone.match(/^\d{7}|\d{10}$/)) {
                alert("Please enter a valid phone number with 7 or 10 digits.");
                return false;
            }

            return true;
            alert("reached return true");

        }

        var submitButton = document.querySelector('input[name="submit"]');
        submitButton.addEventListener('click', () => {
            if (validate()) {
                var fname = document.getElementsByName("fname")[0].value;
                var message = "Thank you for connecting with us, " + fname + " !";
                alert(message);
                document.getElementById("form1").reset();
            }
        });

    </script>
</body>

</html>