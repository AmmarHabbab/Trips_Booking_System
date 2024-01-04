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
    <table id="suggestions-table" class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>type</th>
                <th>body</th>
                <th>user_id</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
        </thead>
    </table>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    {{-- @push('scripts') --}}
<script>
$(document).ready(function(){
$('#suggestions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.suggestions.all') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { data: 'body', name: 'body' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
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

