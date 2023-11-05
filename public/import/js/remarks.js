    $(document).ready(function() {
        // Hide the declineRemarks div initially
        $(".declineRemarks").hide();

        // Handle the click event of the Decline button
        $("#declineButton").click(function() {
            // Toggle the visibility of the declineRemarks div
            $(".declineRemarks").toggle();
        });
    });

    $(document).ready(function() {
        // Hide the approveReason div initially
        $("#approveReason").hide();

        // Handle the click event of the Approve button
        $("#approveButton").click(function() {
            // Toggle the visibility of the approveReason div
            $("#approveReason").toggle();
        });
    });

    $(document).ready(function() {
        // Hide the declineReason div initially
        $("#declineReason").hide();

        // Handle the click event of the Decline button
        $("#declineButton3").click(function() {
            // Toggle the visibility of the declineReason div
            $("#declineReason").toggle();
        });
    });


