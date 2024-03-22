@extends('layout')

@section('data-tables-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')

@include('pages.partials.system_messages')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Articles</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of articles</h6>
        </div>
        <div class="card-body">
            @if(\Illuminate\Support\Facades\Gate::allows('isAuthor'))
                <div class="my-lg-3 d-flex">
                    <a href="{{ route('articles.create') }}"
                       class="btn btn-success mr-auto waves-effect">
                        <span class="btn-label">
                            <i class="ion-android-add"></i>
                        </span> Create Article
                    </a>
                </div><br>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="articles_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Publication Status</th>
                            <th>Last Update</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Check</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p  style="margin:0;">Are you sure you want to delete this article?</p>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger waves-effect"><i class="ion-android-remove"></i> Delete</button>
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('data-tables-js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script>
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#articles_table').DataTable( {
            processing: true,
            serverSide: true,
            ajax: '{{ route('articles.fetch') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'publication_status_id', name: 'publication_status_id' },
                {
                    data: 'updated_at',
                            "render": function ( data, type, full, meta ) {
                                return moment(data).format('DD MMM, YYYY. (HH:mm:ss)');
                            },
                    name: 'updated_at'
                },
                {
                    "render": function ( data, type, full, meta ) {
                        var articleShowURL = '{{ route("articles.show", ":id") }}';
                        var articleEditURL = '{{ route("articles.edit", ":id") }}';
                        articleShowURL = articleShowURL.replace(':id', full.id);
                        articleEditURL = articleEditURL.replace(':id', full.id);
                        return '<a href="'+articleShowURL+'" class="btn btn-secondary btn-small waves-effect"><i class="ion-show">' +
                            '</i> Show</a> <a href="'+articleEditURL+'" class="btn btn-primary btn-small waves-effect"><i class="ion-edit"></i> Edit</a> ' +
                            '<button type="button" name="delete" id="'+full.id+'" class="delete btn btn-danger btn-small waves-effect">' +
                            '<i class="ion-android-remove"></i> Delete</button>';
                    }
                }
            ],
            "order": [[ 0, "desc" ]],
        } );

        var ship_id;

        $(document).on('click', '.delete', function() {
            ship_id = $(this).attr('id');

            $('#confirmModal').modal('show');
        });

        {{--$('#ok_button').click(function() {--}}

        {{--    var _token = "{{ csrf_token() }}";--}}
        {{--    var shipDeleteUrl = '{{ route("ships.destroy", ":id") }}';--}}
        {{--    shipDeleteUrl = shipDeleteUrl.replace(':id', ship_id);--}}

        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $.ajax({--}}
        {{--        url: shipDeleteUrl,--}}
        {{--        type: 'delete',--}}
        {{--        dataType: "json",--}}
        {{--        data: {--}}
        {{--            'id': ship_id,--}}
        {{--            '_token':_token--}}
        {{--        },--}}
        {{--        success: function(data) {--}}
        {{--                setTimeout(function() {--}}
        {{--                    $('#confirmModal').modal('hide');--}}
        {{--                    $('#ships_table').DataTable().ajax.reload();--}}
        {{--                }, 300);--}}
        {{--            }--}}
        {{--        })--}}
        {{--});--}}

    } );
</script>
@endsection
