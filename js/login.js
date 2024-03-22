$(document).ready(function() {
    console.log("Document ready!"); // Check if document ready event is firing
    
    // Bind click event to submit button
    $("#sub").click(function() {
        console.log("Submit button clicked!"); // Check if click event is firing
        // Call hit() function when button is clicked
        hit();
    });
});

function hit() {
    var email = $('#email').val();
    var password1 = $('#password1').val();

    $.ajax({
        url: 'php/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
            email: email,
            password: password1
        },
        success: function(response) {
            alert(response.message); // Display the message from PHP script
            if (response.status === "success") {
                // Redirect if login successful
                window.location.href = "profile.html";
            }
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
            alert("An error occurred while logging in.");
        }
    });
}
