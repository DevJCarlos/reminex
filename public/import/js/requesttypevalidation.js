// Add an event listener to the request type dropdown

    document.getElementById('requestType').addEventListener('change', function () {
        // Get the selected value
        var selectedValue = this.value;

        // Get the timeAvailability div, additionalNote paragraph, and subjectConflictNote paragraph
        var timeAvailabilityDiv = document.getElementById('timeAvailability');
        var additionalNoteParagraph = document.getElementById('additionalNote');
        var subjectConflictNoteParagraph = document.getElementById('subjectConflictNote');

        // Check if the selected value is "Special Exam Request"
        if (selectedValue === 'Special Exam Request') {
            // Hide the timeAvailability div
            timeAvailabilityDiv.style.display = 'none';
            
            // Hide the additionalNote and subjectConflictNote paragraphs
            additionalNoteParagraph.style.display = 'none';
            subjectConflictNoteParagraph.style.display = 'none';
        } else {
            // Show the timeAvailability div
            timeAvailabilityDiv.style.display = 'block';
            
            // Show the additionalNote and subjectConflictNote paragraphs
            additionalNoteParagraph.style.display = 'block';
            subjectConflictNoteParagraph.style.display = 'block';
        }
    });