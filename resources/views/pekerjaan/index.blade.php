<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pekerjaan') }}
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
                    <h1 class="mt-5 mb-2">Tabel Daftar Pekerjaan</h1>
                    <a class="btn btn-success mt-5 mb-5" href="javascript:void(0)" id="createNewPekerjaan"> Tambah Pekerjaan</a>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perusahaan</th>
                                <th>Posisi Pekerjaan</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Deksripsi</th>
                                <th>Status</th>
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
                                <form id="pekerjaanForm" name="pekerjaanForm" class="form-horizontal">
                                <input type="hidden" name="website_id" id="website_id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Nama Perusahaan</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="namaPerusahaan" name="namaPerusahaan" placeholder="Masukkan Nama Perusahaan" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Posisi Pekerjaan</label>
                                        <div class="col-sm-12">
                                            <textarea id="posisiPekerjaan" name="posisiPekerjaan" placeholder="Masukkan Posisi Pekerjaan" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kategori Pekerjaan</label>
                                        <div class="col-sm-12">
                                            <textarea id="kategoriPekerjaan" name="kategoriPekerjaan" placeholder="Masukkan Kategori" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Lokasi</label>
                                        <div class="col-sm-12">
                                            <textarea id="lokasiPekerjaan" name="lokasiPekerjaan" placeholder="Masukkan Lokasi" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Deksripsi</label>
                                        <div class="col-sm-12">
                                            <textarea id="deskripsiPekerjaan" name="deskripsiPekerjaan" placeholder="Masukkan Deskripsi Pekerjaan" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-12">
                                            <textarea id="status" name="status" placeholder="Masukkan Deskripsi Pekerjaan" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
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

        $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pekerjaan') }}",
                complete: () => {
                    //Edit
                    $('.editPekerjaan').on('click', function () {
                        var website_id = $(this).data('id');
                        $.get("{{ route('pekerjaan.edit') }}" +'/' + website_id, function (data) {
                            $('#modelHeading').html("Edit Pekerjaan");
                            $('#saveBtn').val("edit-user");
                            $('#ajaxModel').modal('show');
                            $('#website_id').val(data.id);
                            $('#namaPerusahaan').val(data.namaPerusahaan);
                            $('#posisiPekerjaan').val(data.posisiPekerjaan);
                            $('#kategoriPekerjaan').val(data.kategoriPekerjaan);
                            $('#lokasiPekerjaan').val(data.lokasiPekerjaan);
                            $('#deskripsiPekerjaan').val(data.deskripsiPekerjaan);
                            $('#status').val(data.status);
                        });
                    });
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namaPerusahaan', name: 'namaPerusahaan'},
                {data: 'posisiPekerjaan', name: 'posisiPekerjaan'},
                {data: 'kategoriPekerjaan', name: 'kategoriPekerjaan'},
                {data: 'lokasiPekerjaan', name: 'lokasiPekerjaan'},
                {data: 'deskripsiPekerjaan', name: 'deskripsiPekerjaan'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

        //Click Add Button
        $('#createNewPekerjaan').click(function () {
            $('#saveBtn').val("create-product");
            $('#website_id').val('');
            $('#pekerjaanForm').trigger("reset");
            $('#modelHeading').html("Tambah Daftar Pekerjaan");
            $('#ajaxModel').modal('show');
        });

        //Create data
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
            data: $('#pekerjaanForm').serialize(),
            url: "{{ route('pekerjaan.add') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#pekerjaanForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });

        // $('body').on('click', '.editPekerjaan', function () {
        //     var website_id = $(this).data('id');
        //     $.get("{{ route('pekerjaan.edit') }}" +'/' + website_id +'/edit', function (data) {
        //         $('#modelHeading').html("Edit Website");
        //         $('#saveBtn').val("edit-user");
        //         $('#ajaxModel').modal('show');
        //         $('#website_id').val(data.id);
        //         $('#namaPerusahaan').val(data.namaPerusahaan);
        //         $('#posisiPekerjaan').val(data.posisiPekerjaan);
        //         $('#kategoriPekerjaan').val(data.kategoriPekerjaan);
        //         $('#lokasiPekerjaan').val(data.lokasiPekerjaan);
        //         $('#deskripsiPekerjaan').val(data.deskripsiPekerjaan);
        //         $('#status').val(data.status);
        //     })
        // });

        //Delete 
        $('body').on('click', '.deletePekerjaan', function () {
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
