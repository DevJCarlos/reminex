
    $(document).ready(function () {
        // When the "Edit" button is clicked
        $("#editButton").click(function (e) {
            // Prevent the default action of the link
            e.preventDefault();

            // Toggle the visibility of the form container
            $("#editFormContainer").toggle();
        });
});
