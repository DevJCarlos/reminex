document.addEventListener('DOMContentLoaded', function () {
        // Get the elements
        var requestTypeSelect = document.querySelector('[name="request_type"]');
        var timeAvailableTextarea = document.querySelector('[name="time_available"]');

        // Add event listener to the requestTypeSelect
        requestTypeSelect.addEventListener('change', function () {
            // Check if "Special Exam Request" is selected
            if (requestTypeSelect.value === "Special Exam Request") {
                // Set the value to "Special Exam"
                timeAvailableTextarea.value = "Special Exam";
                // Make the input readonly
                timeAvailableTextarea.readOnly = true;
            } else {
                // If another option is selected, clear the value and make it editable
                timeAvailableTextarea.value = "";
                timeAvailableTextarea.readOnly = false;
            }
        });
    });
