<!DOCTYPE html>
<html>

<head>
    <title>User Information Form</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <h1>User Information Form</h1>
    <form method="post" action="update-card-info.php" onsubmit="return validateForm()">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        <div id="username-error" class="error"></div>

        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" autocomplete="cc-num">
        <div id="card_number-error" class="error"></div>

        <label for="expiration_date">Expiration Date</label>
        <input type="text" name="expiration_date" id="expiration_date"  placeholder="MM/YY" autocomplete="cc-exp">
        <div id="expiration_date-error" class="error"></div>

        <label for="cvv">CVV</label>
        <input type="text" name="cvv" id="cvv" placeholder="CVV" autocomplete="cc-csc">
        <div id="cvv-error" class="error"></div>

        <button type="submit" name="submit">Submit</button>
    </form>
    <script>
        // Handle form submission
        function validateForm() {
            var username = document.getElementById('username');
            var card_number = document.getElementById('card_number');
            var expiration_date = document.getElementById('expiration_date');
            var cvv = document.getElementById('cvv');

            // Validate required fields
            if (username.value === "") {
                setError(username, "Please enter your username.");
                return false;
            }

            
            var card_number_pattern = /^\d{16}$/;
            var expiration_date_pattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
            var cvv_pattern = /^\d{3}$/;

            if (!card_number_pattern.test(card_number.value) || !expiration_date_pattern.test(expiration_date.value) || !cvv_pattern.test(cvv.value)){
                // Validate credit card number
                if (!card_number_pattern.test(card_number.value)) {
                    setError(card_number, "Please enter a valid 16-digit credit card number.");
                }

                // Validate expiration date
                if (!expiration_date_pattern.test(expiration_date.value)) {
                    setError(expiration_date, "Please enter a valid expiration date in MM/YY format.");
                }

                // Validate CVV
                if (!cvv_pattern.test(cvv.value)) {
                    setError(cvv, "Please enter a valid 3-digit CVV number.");
                }
                return false;
            }   

            // If all checks pass, return true
            return true;
        }

        function setError(field, message) {
            field.classList.add("error-field");
            field.nextElementSibling.textContent = message;
        }
    </script>
</body>

</html>
