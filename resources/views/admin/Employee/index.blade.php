@extends('admin.admin-navbar')

@section('title')
    All Employess - POS
@endsection

@section('admin-content')
    <style>
        .paid-badge-glow {
            position: relative;
            display: inline-block;
            padding: 15px 15px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            box-shadow: 0 0 1px #28a745, 0 0 10px #28a745, 0 0 15px #28a745;
        }

        .badge-glow {
            position: relative;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background-color: orange;
            /* Green background */
            color: white;
            font-weight: bold;
            box-shadow: 0 0 1px orange, 0 0 10px orange, 0 0 15px orange;
        }
        .resigned-badge-glow {
            position: relative;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background-color: red;
            /* Green background */
            color: white;
            font-weight: bold;
            box-shadow: 0 0 1px red, 0 0 10px red, 0 0 15px red;
        }
    </style>

    <div class="box-shadow mt-5">
        <div>
            <h3 class="text-center">Employees List</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div style="display:flex; justify-content:right">
                <a href="{{ route('create.employee') }}" class="button1 btn btn-lg"><i class="fa-solid fa-plus"></i></a>
            </div>


            <table class="table mt-3" id="employee-table">
                <thead class="thead text-light"style="background-color: black;">
                    <tr>
                        <th scope="col">S no.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Father Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Id Card Number</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Leaving Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $('#employee-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('all.employees') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'father_name'
                    },
                    {
                        data: 'phone_number'
                    },
                    {
                        data: 'id_card_number'
                    },
                    {
                        data: 'dob'
                    },
                    {
                        data: 'salary'
                    },
                    {
                        data: 'joining_date'
                    },
                    {
                        data: 'leaving_date'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row.leaving_date === 'NULL') {
                                let editUrl = `/edit-employee-page/${row.id}`;
                                return `<a class="button1" href="${editUrl}"><i class="fa fa-pencil"></i></a>`;
                            } else {
                                return `<span class="badge badge-pill badge-danger" style="box-shadow: 0px 0px 10px 5px red">Resigned</span>`;
                            }
                        }
                    }
                ]
            });
        });
    </script>
@endsection
