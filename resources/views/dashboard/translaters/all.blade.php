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
    <table id="translaters-table" class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>info</th>
                <th>gender</th>
                <th>languages_spoken</th>
                <th>status</th>
                <th>action</th>
            </tr>
        </thead>
    </table>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    {{-- @push('scripts') --}}
<script>
$(document).ready(function(){
$('#translaters-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.translaters.all') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'info', name: 'info' },
            { data: 'gender', name: 'gender' },
            { data: 'languages_spoken', name: 'languages_spoken' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
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

