<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Get the forgot password button and password recovery form elements
const forgotPasswordBtn = document.getElementById('forgot-password-btn');
const passwordRecoveryForm = document.getElementById('password-recovery-form');

// Add an event listener to the forgot password button
forgotPasswordBtn.addEventListener('click', () => {
  // Show the password recovery form
  passwordRecoveryForm.style.display = 'block';
});

// Add an event listener to the send recovery email button
const sendRecoveryEmailBtn = document.getElementById('send-recovery-email-btn');
sendRecoveryEmailBtn.addEventListener('click', () => {
  // Get the email address from the form
  const email = document.getElementById('email').value;

  // Send an AJAX request to the password recovery PHP script
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'password-recovery.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(`email=${email}`);

  // Handle the response from the server
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert('Password recovery email sent successfully!');
    } else {
      alert('Error sending password recovery email.');
    }
  };
});
</script>
<?php
include ("_conn/connection.php");
// Get the email address from the request
$email = $_POST['emailAddress'];

// Check if the email address exists in the database
// (assuming you have a students table with an email column)
$query = "SELECT * FROM student_tbl WHERE emailAddress = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Generate a password recovery token and store it in the database
  $token = bin2hex(random_bytes(16));
  $query = "INSERT INTO password_recovery (student_id, token, expires_at) VALUES (?, ?, ?)";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param("isi", $student_id, $token, $expires_at);
  $stmt->execute();

  $subject = "Password Recovery";
  $message = "Click the link to reset your password: <a href='https://example.com/reset-password.php?token=$token'>Reset Password</a>";
  mail($email, $subject, $message);
  echo "Password recovery email sent successfully!";
} else {
  echo "Email address not found.";
}


?>

