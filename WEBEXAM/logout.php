<?php
// Start a new session if there's no existing session
if (!isset($_SESSION)) {
    session_start();
}

// Check if the 'action' parameter is set in the GET request and its value is 'logout'
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      // Destroy the session to log out the user
    session_destroy();  
    header("Location: index.php"); 
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Document type declaration and language specification -->
<head>
   
    <meta charset="UTF-8">
    <title>Logout</title>
            <!-- Linking to Bootstrap CSS for styling and modal support -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

         <!-- Bootstrap modal to confirm logout action -->

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content"> 
            <div class="modal-header">
                <!-- Title for the modal and a close button -->
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <!-- Close button for dismissing the modal -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Message asking if the user really wants to logout -->
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                      <!-- Button to cancel and dismiss the modal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    
                     <!-- Button to confirm the logout action, triggering JavaScript function -->
                <button type="button" class="btn btn-primary" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery for easier DOM manipulation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
          // Show the modal when the page is loaded

        $('#logoutModal').modal('show');

            // Define the function to confirm logout and redirect with the 'logout' action
        window.confirmLogout = function() {
            window.location.href = '?action=logout'; // Navigate to the same page with 'action=logout'
        };
    });
</script>

</body>
</html>
