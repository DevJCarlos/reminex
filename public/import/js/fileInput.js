// Display selected file name
function displayFileName() {
  const fileInput = document.getElementById('fileInput');
  const fileNameSpan = document.getElementById('fileName');

  fileNameSpan.textContent = fileInput.files[0].name;
}