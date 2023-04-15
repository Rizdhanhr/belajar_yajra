@extends('layouts.app')
@section('title','Pegawai')
@section('content')
@once
   @push('css')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   @endpush
@endonce
<br>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="" id="ajaxForm">
                <input type="hidden" name="kode" id="kode" class="form-control" readonly>
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Umur</label>
                    <input type="number" id="umur" name="umur" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control">
                </div>
          <br>
                    <button type="button" class="btn btn-primary form-control tombol-simpan">Submit</button>
            </form>
        </div>
    </div>
    <br>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Name</th>
                <th width="5%">Umur</th>
                <th>Jabatan</th>
                <th width="13%">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br>
</div>
@once
@push('js')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //READ
    $(function () {
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('getpegawai') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'nama', name: 'nama'},
              {data: 'umur', name: 'umur'},
              {data: 'jabatan', name: 'jabatan'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });
    });



    $('.tombol-simpan').click(function() {
        //UPDATE
        var nama = $('#nama').val();
        var umur = $('#umur').val();
        var jabatan = $('#jabatan').val();
        var id = $("#kode").val();
        if (id) {
            $.ajax({
            url: 'pegawai/' + id,
            type:'PUT',
            data:{
                nama, umur, jabatan, id
            },
            success:function(response){
                if(response.error){
                    var values = '';
                    $.each(response.error, function(key, value){
                    values += value
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: values,
                    });
                    });
                }else{
                Swal.fire(
                'Sukses',
                'Data Berhasil Diupdate',
                'success'
                );
                document.getElementById("ajaxForm").reset();
                $('.yajra-datatable').DataTable().ajax.reload();
                }
            }
        });
        }else{
            //CREATE
            $.ajax({
            url:"{{ route('pegawai.store') }}",
            type:'POST',
            data:{
                nama, umur, jabatan
            },
            success:function(response){
                if(response.error){
                    var values = '';
                    $.each(response.error, function(key, value){
                    values += value
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: values,
                    });
                    });
                }else{
                Swal.fire(
                'Sukses',
                'Data Berhasil Disimpan',
                'success'
                );
                document.getElementById("ajaxForm").reset();
                $('.yajra-datatable').DataTable().ajax.reload();
                }
            }
        });
        }

    });



  //EDIT
  $('body').on('click','.edit', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url : 'pegawai/' + id + '/edit',
        type : 'GET',
        success : function(response) {
          $('#nama').val(response.result.nama);
          $('#umur').val(response.result.umur);
          $('#jabatan').val(response.result.jabatan);
          $('#kode').val(response.result.id);
          $('.tombol-simpan').click(function() {
            simpan(id);
         });
        }
    });

  });
  //DELETE
  $('body').on('click','.delete', function(e){
    e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda ingin menghapus data ?',
                text: "Data akan terhapus !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'pegawai/' + id,
                        type : 'DELETE'
                    });

                    Swal.fire(
                    'Sukses',
                    'Data Berhasil Dihapus',
                    'success'
                    );
                    $('.yajra-datatable').DataTable().ajax.reload();
                }
            })
  });


  </script>
@endpush
@endonce
@endsection
