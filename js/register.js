$(document).ready(function() {
  $("#submitBtn").click(function() {
      var name = $("#name").val();
      var email = $("#email").val();
      var password1 = $("#password1").val();
      var password2 = $("#password2").val();

      if (password1 !== password2) {
          alert("Passwords do not match");
          return;
      }

      var data = {
          name: name,
          email: email,
          password1: password1,
          password2: password2
      };
      
      $.ajax({
          url: 'php/register.php',
          type: 'post',
          data: data,
          success: function(response) {
              console.log(response);
              if (response.trim() === "Registration Successful") {
                  alert("Registration Successful");
                  location.replace("login.html");
              } else {
                  alert(response); // Display any other response
              }
          },
          error: function(xhr, status, error) {
              console.log("An error occurred:", error);
              console.log("Status:", status);
              console.log("Response Text:", xhr.responseText);
          }
      });
  });
});
