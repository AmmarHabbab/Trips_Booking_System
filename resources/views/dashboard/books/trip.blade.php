<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  


    <title>Document</title>
</head>
<body>
    <table id="books-table" class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>trip_id</th>
                <th>trip_name</th>
                <th>trip_status</th>
                <th>payment_id</th>
                <th>payment_amount</th>
                <th>payment_status</th>
                <th>status</th>
                <th>translater</th>
                <th>action</th>
                {{-- <th>action</th> --}}
            </tr>
        </thead>
    </table>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    {{-- @push('scripts') --}}
<script>
$(document).ready(function(){
    var id = {{$trip->id}};
$('#books-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.books.trip',$trip->id) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'trip_id', name: 'trip_id' },
            { data: 'trip_name', name: 'trip_name' },
            { data: 'trip_status', name: 'trip_status' },
            { data: 'payment_id', name: 'payment_id' },
            { data: 'payment_amount', name: 'payment_amount' },
            { data: 'payment_status', name: 'payment_status' },
            { data: 'status', name: 'status' },
            { data: 'translater', name: 'translater' },
            { data: 'action', name: 'action' },
            // { data: 'action', name: 'action' },
        ]
});
});
// $(function() {
//     $('#posts-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: '{{ route("dashboard.posts.all") }}',
//         columns: [
//             { data: 'title', name: 'title' },
//             { data: 'content', name: 'content' },
//             { data: 'created_at', name: 'created_at' },
//             { data: 'updated_at', name: 'updated_at' },
//         ]
//     });
// });
</script>
{{-- @endpush --}}
</body>
</html>

