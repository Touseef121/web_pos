@extends('admin.admin-navbar')

@section('title')
    All Users - POS
@endsection

@section('admin-content')
<div class="box-shadow mt-5">
    <div>
        <h3 class="text-center">Employees List</h3>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table mt-3" id="users-table">
            <thead class="thead text-light"style="background-color: black;">
                <tr>
                    <th scope="col">S no.</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        // Initialize the DataTable
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('all.users') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'user_name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (row.id) {
                            return `<a class="button1" href="/delete-user/${row.id}"><i class="fa fa-trash"></i></a>`;
                        } else {
                            return '';
                        }
                    }
                    
                }
                

            ]
        });
    });
</script>
@endsection