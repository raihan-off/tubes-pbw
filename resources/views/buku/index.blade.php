<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <h1 class="mt-5 mb-2">Tabel Daftar Buku</h1>
                    <a class="btn btn-success mt-5 mb-5" href="javascript:void(0)" id="createNewBuku"> Tambah Buku</a>
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Halaman</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="bukuForm" name="bukuForm" class="form-horizontal">
                            <input type="hidden" name="website_id" id="website_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Buku</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Buku" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Penerbit</label>
                                    <div class="col-sm-12">
                                        <textarea id="penerbit" name="penerbit" placeholder="Masukkan Penerbit" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-12">
                                        <textarea id="kategori" name="kategori" placeholder="Masukkan Kategori" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jumlah Halaman</label>
                                    <div class="col-sm-12">
                                        <textarea id="jumlahHalaman" name="jumlahHalaman" placeholder="Masukkan Jumlah Halaman" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn">Save changes
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Render Table
    $(function () {
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                url: "{{ route('buku') }}",
                complete: () => {
                    //Edit
                    $('.editBuku').on('click', function () {
                        var website_id = $(this).data('id');
                        $.get("{{ route('buku.edit') }}" +'/' + website_id, function (data) {
                            $('#modelHeading').html("Edit Buku");
                            $('#saveBtn').val("edit-user");
                            $('#ajaxModel').modal('show');
                            $('#website_id').val(data.id);
                            $('#judul').val(data.judul);
                            $('#penerbit').val(data.penerbit);
                            $('#kategori').val(data.kategori);
                            $('#jumlahHalaman').val(data.jumlahHalaman);
                        });
                    });
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'judul', name: 'judul'},
                {data: 'penerbit', name: 'penerbit'},
                {data: 'kategori', name: 'kategori'},
                {data: 'jumlahHalaman', name: 'jumlahHalaman'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
        //Click Add Button
        $('#createNewBuku').click(function () {
            $('#saveBtn').val("create-product");
            $('#website_id').val('');
            $('#bukuForm').trigger("reset");
            $('#modelHeading').html("Tambah Daftar Buku");
            $('#ajaxModel').modal('show');
        });

        //Create data
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
            data: $('#bukuForm').serialize(),
            url: "{{ route('buku.add') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#bukuForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });

        //Delete 
        $('body').on('click', '.deleteBuku', function () {
            var website_id = $(this).data("id");
            confirm("Anda yakin ingin menghapus data ?");
            $.ajax({
                type: "DELETE",
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
});
</script>

</x-app-layout>