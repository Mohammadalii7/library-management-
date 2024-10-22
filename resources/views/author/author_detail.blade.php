@extends('component/layout')

@section('title', 'Dashboard')

@section('content')


<style>
    /* From Uiverse.io by SelfMadeSystem */
    .container {
        cursor: pointer;
    }

    .container input {
        display: none;
    }

    .container svg {
        overflow: visible;
    }

    .path {
        fill: none;
        stroke: black;
        stroke-width: 6;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;
        stroke-dasharray: 241 9999999;
        stroke-dashoffset: 0;
    }

    .container input:checked~svg .path {
        stroke-dasharray: 70.5096664428711 9999999;
        stroke-dashoffset: -262.2723388671875;
    }

    .block {
        background: #ffffff;
    }

    .block .title strong:first-child {
        color: black;
        font-size: 24px;
        font-family: italic;
    }

    .page-header {
        background: #ffffff;
    }

</style>

<div class="page-header">
    <div class="container-fluid">
    </div>
</div>


<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="block margin-bottom-sm">
                    <div class="title"><strong>Authors List</strong></div>
                    <br>
                    <form id="deleteForm" method="POST" action="{{ route('authors.deleteMultiple') }}">
                        @csrf
                        <button type="submit" id="deleteButton" style="display: none;" class="btn btn-danger delete-button">Delete Selected</button>
                        <br>
                        <br>

                        <div class="table-responsive">
                            <table id="author_datatable" class="table table-hover table-compact">
                                <thead>
                                    <tr>
                                        <th data-sortable="false">
                                            <label class="container">
                                                <input type="checkbox" id="selectAll">
                                                <svg viewBox="0 0 64 64" height="1.2em" width="1.5em">
                                                    <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>
                                                </svg>
                                            </label>
                                        </th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Bio</th>
                                        <th>Birth Date</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTable will fill this -->
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    var table = $('#author_datatable').DataTable({
        processing: true
        , serverSide: true
        , ajax: "{{ route('author.list') }}"
        , columns: [{
                data: 'select'
                , name: 'select'
                , orderable: false
                , searchable: false
                , render: function(data, type, full, meta) {
                    return '<label class="container">' +
                        '<input type="checkbox" class="item-checkbox" name="selected_authors[]" value="' + full.id + '">' +
                        '<svg viewBox="0 0 64 64" height="1.2em" width="1.5em">' +
                        '<path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="path"></path>' +
                        '</svg>' +
                        '</label>';
                }
            }
            , {
                data: 'id'
                , name: 'id'
                , render: function(data, type, full, meta) {
                   return  '  <a href="{{ url('author/update') }}/' + data + '" class="update-link " style="color: black;">' +  (meta.row + 1)  + '</a>';
                }
            }
            , {
                data: 'author_name'
                , name: 'author_name'
            },{
                    data: 'bio',
                    name: 'bio'
                },
                {
                    data: 'birth_date',
                    name: 'birth_date'
                },  {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return '<img src="{{ asset('author') }}/' + data + '" alt="Author Image" height="80"/>'; // Display author image
                    }
                }
        ]
    });

     const deleteButton = $('#deleteButton');
    const selectAllCheckbox = $('#selectAll');

    function toggleDeleteButton() {
        const anyChecked = $('.item-checkbox:checked').length > 0;
        deleteButton.css('display', anyChecked ? 'inline-block' : 'none');

        const allChecked = $('.item-checkbox').length === $('.item-checkbox:checked').length;
        selectAllCheckbox.prop('checked', allChecked);
    }

    $(document).on('change', '.item-checkbox', function() {
        toggleDeleteButton();
    });

    selectAllCheckbox.on('change', function() {
        const isChecked = $(this).prop('checked');
        $('.item-checkbox').prop('checked', isChecked);
        toggleDeleteButton();
    });



</script>
@endsection