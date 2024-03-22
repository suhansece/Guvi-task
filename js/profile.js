$(document).ready(function() {
    $("#sub").click(function() {
        var data = {
            img: $("#img").val(),
            name: $("#name").val(),
            email: $("#email").val(),
            dob: $("#dob").val(),
            phone: $("#phone").val(),
            address: $("#address").val()
        };
  
        $.ajax({
            url: 'php/profile.php',
            type: 'post',
            data: data,
            success: function(response) {
                // Handle success and possible redirects
                console.log(response);
                // Example: reload page upon success
                window.location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
                alert("An error occurred while updating profile.");
            }
        });
    });
  });
  