@extends('layouts.app')


@section('content')  
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include Bootstrap CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.min.js"></script>


<!-- <div> -->
    <div class="container"> 
        <table id="newexample" class="table table-striped table-bordered table-light" style="width:100%">
            <thead>
            <tr>
                <th>Room Name</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>data

            </thead>
            <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <th>
                    <span>{{ $room->room_name }}</span>
                    </th>   
                    <th>
                    <span>{{ $room->updated_at }}</span>
                    </th>
                    <td>
                    <button class="btn btn-success btn-sm"data-room-id1="{{ $room->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-room-id="{{ $room->id }}">Delete</button>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button id="addRoomButton" class="btn btn-primary" style="width: 150px;">Add Room</button>
        <br>
           
    </div>
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="roomNameInput">Room Name</label>
                        <input type="text" class="form-control" id="roomNameInput">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addRoom">Add Room</button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editRoomForm">
                        @csrf
                        <input type="hidden" id="editRoomId" name="room_id" value="">
                        <div class="form-group">
                            <label for="editRoomName">Room Name:</label>
                            <input type="text" class="form-control" id="editRoomName" name="room_name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEditRoom">Save Changes</button>
                </div>
            </div>
        </div>
    </div>    


<!-- </div> -->


    

@endsection




@section('scripts')


<script>
      $(document).ready(function() {
          $('#newexample').dataTable({      

          });
      });

      $(document).ready(function() {
    $('#addRoomButton').on('click', function() {
        $('#addRoomModal').modal('show');
    });
    
    $('#addRoom').on('click', function() {
        const roomName = $('#roomNameInput').val();
        console.log(roomName);
        $('#addRoomModal').modal('hide');
        $.ajax({
            type: 'POST',
            url: '/add-room',
            data: {
                _token: '{{ csrf_token() }}', 
                room_name: roomName,
            },
            success: function(response) {
            
            if (response.message === 'success') {
                alert('Room added successfully');
                location.reload();
            } else {
                alert('Failed to add room');
            }
        }
        });
    });
});


$(document).ready(function() {
    $('#newexample').on('click', '.btn-danger', function() {
        const roomId = $(this).data('room-id');
        console.log('delete',roomId);
        if (confirm('Are you sure you want to delete this room?')) {
            
            $.ajax({
                type: 'POST',
                url: '/delete-room',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: roomId,
                },
                success: function(response) {
                    
                    if (response.message === 'success') {
                        alert('Room deleted successfully');

                        
                        $(this).closest('tr').remove();
                        location.reload();
                    } else {
                        alert('Failed to delete room');
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the room');
                },
            });
        }
    });
});

$(document).ready(function() {
    $('#newexample').on('click', '.btn-success', function() {
        
        // const roomNames = $(this).closest('tr').find('span').text();
        const roomIds = $(this).closest('tr').find('.btn-success').data('room-id1');

        const roomText = $(this).closest('tr').find('span').text();
        const roomNames = roomText.split('2023','2024', '2025', '2026')[0].trim();

        
        $('#editRoomName').val(roomNames);
        $('#editRoomId').val(roomIds);      
        $('#editRoomModal').modal('show');
        
    });
});

$(document).ready(function() {
    // Handle the "Save Changes" button click
    $('#saveEditRoom').on('click', function() {
        // Get the edited room ID and name
        const roomId1 = $('#editRoomId').val();
        const newRoomName1 = $('#editRoomName').val();
        console.log('roomid', roomId1);
        console.log('roomid', newRoomName1);

        // Prepare the data for the AJAX request
        const requestData = {
            _token: '{{ csrf_token() }}',
            room_id: roomId1,
            room_name: newRoomName1
        };

        
        $.ajax({
            type: 'POST',
            url: '/update-room', 
            data: requestData,
            success: function(response) {
                console.log(response);
                if (response.message === 'Room name updated') {
                    alert('Room updated successfully');
                    $('#editRoomModal').modal('hide');
                    location.reload();
                } else {
                    alert('Failed to update room');
                }
            },
            error: function() {
                alert('An error occurred while updating the room');
            }
        });
    });
});




</script>

@endsection