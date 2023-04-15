@extends('layouts.app')
@section('title','Karyawan')
@once
  @push('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush
@endonce
@section('content')
<br>
<div class="container">
    <h1>Tabel Karyawan</h1>
    <br>
    <table class="table table-bordered table-karyawan">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Name</th>
                <th width="20%">Jenis Kelamin</th>
                <th width="13%">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br>
</div>
@endsection
@once
  @push('js')
<script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //READ
    $(function () {
      var table = $('.table-karyawan').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('getkaryawan') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'nama', name: 'nama'},
              {data: 'jk', name: 'jk'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });
    });
</script>
  @endpush
@endonce
