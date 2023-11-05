var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active2");
    var content2 = this.nextElementSibling;
    if (content2.style.display === "block") {
      content2.style.display = "none";
    } else {
      content2.style.display = "block";
    }
  });
}

// document.addEventListener('DOMContentLoaded', function () {
//   // Get the Decline button
//   const declineButton = document.querySelector('#declineButton');

//   // Get the textarea element
//   const textareaElement = document.querySelector('#declineReason');

//   // Add click event listener to the Decline button
//   declineButton.addEventListener('click', function () {
//       // Toggle the visibility of the textarea
//       textareaElement.style.display = textareaElement.style.display === 'none' ? 'block' : 'none';
//   });
// });

//   document.addEventListener('DOMContentLoaded', function () {
//   // Get the Decline button
//   const approveButton = document.querySelector('#approveButton');

//   // Get the textarea element
//   const textareaElement = document.querySelector('#approveReason');

//   // Add click event listener to the Decline button
//   approveButton.addEventListener('click', function () {
//       // Toggle the visibility of the textarea
//       textareaElement.style.display = textareaElement.style.display === 'none' ? 'block' : 'none';
//   });
// });