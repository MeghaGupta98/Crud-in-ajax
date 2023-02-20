<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .form-group {
        margin-bottom: 10px;
    }

    h1 {
        text-align: center;
        color: blue;
    }
    </style>
</head>

<body>

    <div class="container mt-3">
        <h2>REGISTRATION form</h2>
        <div class="form-group">
            <label for="fname">First_Name</label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="first Name">
        </div>
        <div class="form-group">
            <label for="lname">Last_Name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="last Name">
        </div>
        <div class="form-group">
            <label for="phone">Phone_Number</label>
            <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email_address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <button type="submit" id="submit" class="btn btn-danger">Submit</button>
    </div>

    <!-- FETCHING ALL DATA -->
    <h1>Display user list using Ajax</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>first_Name</th>
                <th>Last_Name</th>
                <th>Phone_Number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($show as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->fname}}</td>
                <td>{{$data->lname}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->email}}</td>
                <td><button type="button" data-url="{{ route('user.edit', $data->id) }}" id="editBtn"
                        class="btn btn-warning">Edit</button></td>
                <td><button type="button" data-url="{{ route('users.delete', $data->id) }}" id="delBtn"
                        class="btn btn-danger">Delete</button></td>
            <tr>
                @endforeach
        </tbody>
    </table>


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registration Form</h4>
                    <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-3">
                        <div class="form-group">
                            <input type="text" name="id" class="form-control" value="" id="editId" hidden>
                            <label for="fname">First_Name</label>
                            <input type="text" class="form-control" value="" name="fname" id="fName"
                                placeholder="first Name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last_Name</label>
                            <input type="text" class="form-control" name="lname" id="lName" placeholder="last Name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone_Number</label>
                            <input type="number" class="form-control" name="phone" id="phone_number"
                                placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email_address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn-close" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="update" data-url="{{ route('user.update') }}"
                        class="btn btn-primary">Update</button>
                </div>

            </div>
        </div>
    </div>


</body>

</html>




<!-- SCRIPT START -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {

    //--------------- save using ajax------------------------------//
    $('#submit').on('click', function() {
        var dataField = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            phone: $('#phone').val(),
            email: $('#exampleInputEmail1').val(),
        }
        // console.log(dataField);
        $.ajax({
            url: "{{route('register.store')}}",
            type: "POST",
            data: {
                regster_data: dataField,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(response) {}
        });
    });
    // **********************edit ***********************//
    $(document).on('click', '#editBtn', function() {
        $('#myModal').show();
        var userURL = $(this).data('url');
        // console.log(userURL);
        $.ajax({
            url: userURL,
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data.editUser.id);
                $('#editId').val(data.editUser.id);
                $('#fName').val(data.editUser.fname);
                $('#lName').val(data.editUser.lname);
                $('#phone_number').val(data.editUser.phone);
                $('#email').val(data.editUser.email);
            }
        });

    });
    $(document).on('click', '#btn-close', function() {
        $('#myModal').hide();
    });
    $(document).on('click', '#btn-close', function() {
        $('#myModal').hide();
    });
    
    //----------------------------- delete using ajax-------------//

    $(document).on('click', '#delBtn', function() {
        var userURL = $(this).data('url');
        var trObj = $(this);
        if (confirm("Are you sure you want to remove this data?") == true) {
            $.ajax({
                url: userURL,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.success);
                    trObj.parents("tr").remove();
                }
            });
        }

    });

    $(document).on('click', '#update', function() {
        var update = {
            id: $('#editId').val(),
            fname: $('#fName').val(),
            lname: $('#lName').val(),
            phone: $('#phone_number').val(),
            email: $('#email').val(),
        }
        $.ajax({
            url: "/update",
            type: "POST",
            data: {
                dataUpdate: update,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(data) {
                alert('hello');
            }
        });
    });
});
</script>

</body>

</html>