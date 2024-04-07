<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@extends('master')
@section('master-space')
    <div class="container">
        <a href="{{ route('logout') }}" class="btn my-3 btn-danger">Logout</a>
        <div class="row">
            <div class="col-lg-12">
                <h3 align="center" class="text-success my-4">Welcome {{ Auth::user()->name }}</h3>
                <div class="table-responsive">
                    <table id="register_table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @if (count($users))
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td><button type="button" data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                data-gender="{{ $user->gender }}" data-mobile="{{ $user->mobile }}"
                                                class="btn btn-info btn-sm edit" data-toggle="modal"
                                                data-target="#edit_modal">Edit</button></td>
                                        <td><button type="button" data-id="{{ $user->id }}"
                                                class="btn btn-danger btn-sm delete" data-toggle="modal"
                                                data-target="#delete_modal">Delete</button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr align="center">
                                    <td colspan="5">No Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('msg'))
        <!-- <div class="alert my-2 alert-success alert-dismissible  fade show">
                    <span class="close">&times;</span>
                    {{ Session::get('msg') }}
                </div> -->
        <script>
            swal("Success", "{{ Session::get('msg') }}", "success", {
                button: true,
            });
        </script>
    @endif

    <!-- Edit Student Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <form id="edit_form_modal">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Edit Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" id="name" required class="form-control"
                                placeholder="Enter Name">
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" required class="form-control"
                                placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="gender" id="gender" required class="form-control"
                                placeholder="Enter Gender">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="mobile" id="mobile" required class="form-control"
                                placeholder="Enter Mobile No">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="edit_btn">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Delete Student Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <form id="del_form_modal">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Delete Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="del_id" id="del_id">
                        <p>Are you sure to want to Delete this Student?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#register_table').DataTable();

            // Edit
            $('.edit').click(function(e) {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var email = $(this).attr('data-email');
                var gender = $(this).attr('data-gender');
                var mobile = $(this).attr('data-mobile');
                $('#id').val(id);
                $('#name').val(name);
                $('#email').val(email);
                $('#gender').val(gender);
                $('#mobile').val(mobile);
            });

            $("#edit_form_modal").submit(function(event) {
                event.preventDefault();
                var formdata = $(this).serialize();
                $.ajax({
                    url: "{{ route('edit.record') }}",
                    type: "post",
                    data: formdata,
                    beforeSend: function() {
                        $('#edit_btn').html('Updating...');
                        $('#edit_btn').attr('disabled', true);
                    },
                    success: function(response) {
                        // console.log(response);
                        var message = response.msg;

                        if (response.status == true) {
                            $('#edit_btn').html('Save');
                            $('#edit_btn').attr('disabled', false);
                            $('#edit_form_modal').modal('hide');
                            window.location.reload();
                        } else {
                            alert(response.msg);
                        }
                    }
                });
            });

            $('.delete').click(function(e) {
                var del_id = $(this).attr('data-id');
                $('#del_id').val(del_id);
            });

            $("#del_form_modal").submit(function(event) {
                event.preventDefault();
                var formdata = $(this).serialize();
                $.ajax({
                    url: "{{ route('delete.record') }}",
                    type: "post",
                    data: formdata,
                    success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            alert(response.msg);
                        }
                    },
                });
            });
        });
    </script>
@endsection
