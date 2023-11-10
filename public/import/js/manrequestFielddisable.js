function submitForm() {
    // Hide the button after clicking
    document.getElementById('scheduleForm').querySelector('input[type="submit"]').style.display = 'none';

    // Optionally, you can also disable the button to prevent multiple submissions
    // document.getElementById('scheduleForm').querySelector('input[type="submit"]').disabled = true;

    // You can also submit the form if needed
    // document.getElementById('scheduleForm').submit();
}