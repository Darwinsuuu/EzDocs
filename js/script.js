$(document).ready(function() {

    var DataTable = require('datatables.net');
    
    let table = new DataTable('#documentTableStudent', {
        // config options...
    });
    
    
    
    
    

})

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