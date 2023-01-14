<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Website Informasi') }}
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
                    <h1 class="mt-5 mb-2">Tabel Daftar Informasi</h1>
                    <a class="btn btn-success mt-5 mb-5" href="javascript:void(0)" id="createNewInformasi"> Tambah Website</a>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Website</th>
                                <th>Tautan</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Deskripsi</th>
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
                                <form id="websiteForm" name="websiteForm" class="form-horizontal">
                                <input type="hidden" name="website_id" id="website_id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Nama Website</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="website" name="website" placeholder="Masukkan nama website" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tautan</label>
                                        <div class="col-sm-12">
                                            <textarea id="tautan" name="tautan" placeholder="Masukkan Tautan" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kategori</label>
                                        <div class="col-sm-12">
                                            <textarea id="kategori" name="kategori" placeholder="Masukkan Kategori" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sub Kategori</label>
                                        <div class="col-sm-12">
                                            <textarea id="subKategori" name="subKategori" placeholder="Masukkan Sub Kategori" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Deksripsi</label>
                                        <div class="col-sm-12">
                                            <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" class="form-control" required></textarea>
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

                <div class="modal fade" id="ajaxModelDua" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modelHeading"></h4>
                            </div>
                            <div class="modal-body">
                                <form id="websiteFormDua" name="websiteFormDua" class="form-horizontal">
                                <input type="hidden" name="website_id2" id="website_id2">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Nama Website</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="website2" name="website" placeholder="Masukkan nama website" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tautan</label>
                                        <div class="col-sm-12">
                                            <textarea id="tautan2" name="tautan" placeholder="Masukkan Tautan" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kategori</label>
                                        <div class="col-sm-12">
                                            <textarea id="kategori2" name="kategori" placeholder="Masukkan Kategori" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sub Kategori</label>
                                        <div class="col-sm-12">
                                            <textarea id="subKategori2" name="subKategori" placeholder="Masukkan Sub Kategori" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Deksripsi</label>
                                        <div class="col-sm-12">
                                            <textarea id="deskripsi2" name="deskripsi" placeholder="Masukkan Deskripsi" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtnEdit">Save changes
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
            var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('informasi') }}",
                complete: () => {
                    //Show Edit Modal
                    $('.editInformasi').on('click', function () {
                        var website_id2 = $(this).data('id');
                        $.get("{{ route('informasi.edit') }}" +'/' + website_id2, function (data) {
                            $('#modelHeading').html("Edit Website");
                            $('#saveBtnEdit').val("edit-user");
                            $('#ajaxModelDua').modal('show');
                            $('#website_id2').val(data.id);
                            $('#website2').val(data.website);
                            $('#tautan2').val(data.tautan);
                            $('#kategori2').val(data.kategori);
                            $('#subKategori2').val(data.subKategori);
                            $('#deskripsi2').val(data.deskripsi);
                        });
                    });
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'website', name: 'website'},
                {data: 'tautan', name: 'tautan'},
                {data: 'kategori', name: 'kategori'},
                {data: 'subKategori', name: 'subKategori'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    

        //Show Create Modal
        $('#createNewInformasi').click(function () {
            $('#saveBtn').val("create-product");
            $('#website_id').val('');
            $('#websiteForm').trigger("reset");
            $('#modelHeading').html("Tambah Daftar Website");
            $('#ajaxModel').modal('show');
        });

        //Create Event
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
            data: $('#websiteForm').serialize(),
            url: "{{ route('informasi.add') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#websiteForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

        //Edit Event
        $('#saveBtnEdit').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            var website_id = $(this).data('id');

            $.ajax({
            data: $('#websiteFormDua').serialize(),
            url: "{{ route('informasi.ubah') }}" +'/' + website_id2.value,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#websiteFormDua').trigger("reset");
                $('#ajaxModelDua').modal('hide');
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtnEdit').html('Save Changes');
            }
        });

        //Delete Event
        $('body').on('click', '.deleteInformasi', function () {
    
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
