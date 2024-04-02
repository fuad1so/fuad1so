

    // Contact Form Validation and Submission
    document.getElementById("contactForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Validation logic
        if (!validateForm()) {
            return;
        }

        // Fetch API submission to PHP script
        var formData = new FormData(this);

        fetch("contact_process.php", {
            method: "POST",
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            console.log(data)
            showConfirmationAlert();
            document.getElementById("validationAlert").style.display = "none"
            // Reset the form after successful submission (optional)
            document.getElementById("contactForm").reset();
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    });

    // Form Validation Function
    function validateForm() {
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var subject = document.getElementById("subject").value.trim();
        var message = document.getElementById("message").value.trim();

        // Simple validation - check if fields are not empty
        if (name === "" || email === "" || subject === "" || message === "") {
            showValidationError("Please fill in all fields.");
            return false;
        }

        // Validate email format: A detailed RegEx explanation see below the script
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showValidationError("Please enter a valid email address.");
            return false;
        }

        return true;
    }

    // Display Bootstrap alert for validation errors
    function showValidationError(message) {
        var validationAlert = document.getElementById("validationAlert");
        validationAlert.innerHTML = message;
        validationAlert.style.display = "block";
    }

    // Display Bootstrap alert for confirmation
    function showConfirmationAlert() {
        var confirmationAlert = document.getElementById("confirmation");
        confirmationAlert.style.display = "block";
        setTimeout(function() {
            confirmationAlert.style.display = "none";
        }, 5000); // Hide after 5 seconds (adjust as needed)
    }



    /** 
     * Let's break down the components of this regular expression:
/^[^\s@]+@[^\s@]+\.[^\s@]+$/ => john@gmail.com

/: Delimiters that mark the beginning and end of the regular expression.
^: Anchors the regex at the beginning of the string.

[^\s@]+: Matches one or more characters that are not whitespace (\s) and 
not the "@" symbol.

@: Matches the "@" symbol.

[^\s@]+: Matches one or more characters that are not whitespace (\s) and 
not the "@" symbol.

\.: Escapes the dot (.) to match a literal dot character.

[^\s@]+: Matches one or more characters that are not whitespace (\s) 
and not the "@" symbol.

$: Anchors the regex at the end of the string.
In simpler terms, this regular expression is checking that an email address follows a basic format:

It should not start with or end with whitespace.
It should contain the "@" symbol.
It should not have whitespace around the "@" symbol.
It should have at least one character before and after the "@" symbol.
It should have a dot (.) after the "@" symbol.
It should have at least one character after the dot.
    */