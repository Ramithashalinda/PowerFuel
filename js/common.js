  document.querySelector("form").addEventListener("submit", function(e) {
      e.preventDefault();
      var currentPassword = document.getElementById("current-password").value;
      var newPassword = document.getElementById("new-password").value;
      var confirmPassword = document.getElementById("confirm-password").value;
      var email = document.getElementById("uemail").value;
    
      var currentPasswordError = document.getElementById("current-password-error");
      var newPasswordError = document.getElementById("new-password-error");
      var confirmPasswordError = document.getElementById("confirm-password-error");
    
      var isValid = true;

      if (currentPassword.length < 8) {
        alert("Current password must be at least 8 characters");
        isValid = false;
      }
    
      if (newPassword.length < 8) {
        alert("New password must be at least 8 characters");
        isValid = false;
      }
    
      if (newPassword !== confirmPassword) {
        alert("New passwords do not match");
        isValid = false;
      }
    
      if (isValid) {
        //alert("Data is valid!");
        $.ajax({
          type: 'POST',
          url: 'include/functions.php',
          dataType: 'text',
          data: {currentPassword:currentPassword,email:email, newPassword:newPassword, changePW:"success"},
          success: function (response) {
              alert(response);
          }
        });
      }
    });
    