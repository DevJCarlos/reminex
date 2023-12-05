 $('.edit-button').on('click', function () {
        var userId = $(this).data('id');
        $('#editUserId').val(userId);

        // Fetch user data using AJAX
        $.ajax({
            url: '/users/getUserData/' + userId,
            method: 'GET',
            success: function (data) {
                console.log(data);  // Check if data is received
                // Populate the modal fields with user data
                $('#editusername').val(data.username);
                $('#editname').val(data.name);
                $('#editdept').val(data.department);
                $('#editcourse').val(data.course);
                $('#editsection').val(data.student_sec);
                $('#editstatus').val(data.student_status);
                $('#editemail').val(data.email);
            }
        });
});