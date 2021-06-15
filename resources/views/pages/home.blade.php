@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header h3 text-center">Contacts List</div>

                <div class="card-body">
                    <div class=" mb-3 text-center">
                        <button class="btn btn-primary add-contact">Add Contact</button>
                    </div>

                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Contact Data" />
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $item)
                                <tr>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->company }}</td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                    <td class="text-center">{{ $item->email }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" >
                                            <button type="button" class="btn btn-primary edit_contact" data-contact="{{ $item }}">Edit</button>
                                            <button type="button" class="btn btn-danger delete_contact" data-contact="{{ $item->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.modals.add_contact')
@include('pages.modals.edit_contact')
@endsection

@section('extraJS')
<script>
    $('body').on('click', '.add-contact', function() {
        $('#add_contact_modal').modal('show');
    })

    $('#add_contact_form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ url('add-contact') }}',
            type: 'Post',
            data: $(this).serialize(),
        })
        .done(function() {
            $('#add_contact_modal').modal('hide');
            swal({
              title: "Good job!", 
              text: "Successfully Added!", 
              icon: "success",
              timer: 1000,
              buttons: false,
            });

            setTimeout(function() {
                location.reload();
            }, 1000);
        })
        .fail(function() {
            console.log("error");
        })
    })

    $('body').on('click', '.edit_contact', function() {
        var contact = $(this).data('contact');

        $('.edit_id').val(contact.id);
        $('.edit_name').val(contact.name);
        $('.edit_company').val(contact.company);
        $('.edit_phone').val(contact.phone);
        $('.edit_email').val(contact.email);

        $('#edit_contact_modal').modal('show');

    })

    $('#edit_contact_form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ url('edit-contact') }}',
            type: 'Post',
            data: $(this).serialize(),
        })
        .done(function() {
            $('#edit_contact_modal').modal('hide');
            swal({
              title: "Good job!", 
              text: "Successfully Updated!", 
              icon: "success",
              timer: 1000,
              buttons: false,
            });

            setTimeout(function() {
                location.reload();
            }, 1000);
        })
        .fail(function() {
            console.log("error");
        })
    })

    $('body').on('click', '.delete_contact', function() {
        var contract_id = $(this).data('contact');

        swal({
            title: "Remove Contact, Are you sure?",
            text: "This will permanently remove the contact!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete,) => {
              if (willDelete) {
                $.ajax({
                    url: '{{ url('delete-contact') }}/'+contract_id,
                    type: 'Post',
                    data: {_token: "{{ csrf_token() }}"},
                })
                .done(function() {
                    $('#edit_contact_modal').modal('hide');
                    swal({
                      title: "Good job!", 
                      text: "Successfully Deleted!", 
                      icon: "success",
                      timer: 1000,
                      buttons: false,
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .fail(function() {
                    console.log("error");
                })
            }
        });

    })

    if($('#search').val() != "") {
        fetch_customer_data();
    }
    

    function fetch_customer_data(query = '') {
        $.ajax({
            url:"{{ url('live_search/action') }}",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data) {
              $('tbody').html(data.table_data);
            }
        })
    }
    
    $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_customer_data(query);
    });
</script>
@endsection
