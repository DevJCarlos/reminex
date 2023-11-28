 $('.edit-button').on('click', function () {
        var userId = $(this).data('id');
        $('#editUserId').val(userId);

        // Fetch user data using AJAX
        $.ajax({
            url: '/users/getUserData/' + userId,
            method: 'GET',
            success: function (data) {
                // Populate the modal fields with user data
                $('#editusername').val(data.username);
                $('#editname').val(data.name);
                $('#editdept').val(data.department);
                $('#editcourse').val(data.course);
                $('#editemail').val(data.email);
            }
        });
});