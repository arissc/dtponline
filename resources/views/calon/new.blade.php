@extends('template')

@section('content')
<div class="row mt-5 mb-5">
  <div class="col-lg-12 margin-tb">
      <div class="float-left">
          <h2>Tambah Data Pelamar</h2>
      </div>
      <div class="float-right">
          <a class="btn btn-secondary" href="{{ route('dtp.index') }}"> Back</a>
      </div>
  </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<form action="{{ route('dtp.store') }}" method="POST">
  @csrf

  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Nama:</strong>
              <input type="text" name="name" class="form-control" placeholder="Nama" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Alamat:</strong>
              <input type="text" name="address" class="form-control" placeholder="Alamat" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>KTP:</strong>
              <input type="text" name="ktp" class="form-control" placeholder="KTP" required>
          </div>
      </div>
  </div>
  <br>
  <h3>Pendidikan</h3>
  <div class="row">
      <div class="col-lg-3">
          <input type="text" id="Sekolah" class="form-control" placeholder="Nama Sekolah">
      </div>
      <div class="col-lg-3">
          <input type="text" id="Jurusan" class="form-control" placeholder="Jurusan">
      </div>
      <div class="col-lg-3">
          <input type="number" id="Masuk" class="form-control" placeholder="Tahun Masuk">
      </div>
      <div class="col-lg-3">
          <input type="number" id="Lulus" class="form-control" placeholder="Tahun Lulus">
      </div>
  </div>
  <div class="row mt-2">
      <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="button" id="add-pend" class="btn btn-primary">Tambah Pendidikan</button>
      </div>
  </div>
  <div class="row mt-2">
      <div class="col-lg-12">
          <table id="tabled" class="table nambah table-bordered table-hover datatable-highlight">
              <thead>
                  <tr>
                      <th rowspan="2" >#</th>
                      <th rowspan="2" class="text-center">Nama Sekolah</th>
                      <th rowspan="2" class="text-center">Jurusan</th>
                      <th rowspan="2" class="text-center">Tahun Masuk</th>
                      <th rowspan="2" class="text-center">Tahun Lulus</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
          </table>
      </div>
      <button style="margin:10px 5px;" type="button" class="delete-pend btn btn-danger">Delete Pendidikan</button>
  </div>
  <br>
  <h3>Pengalaman</h3>
  <div class="row">
      <div class="col-lg-3">
          <input type="text" id="Perusahaan" class="form-control" placeholder="Perusahaan">
      </div>
      <div class="col-lg-3">
          <input type="text" id="Jabatan" class="form-control" placeholder="Jabatan">
      </div>
      <div class="col-lg-3">
          <input type="number" id="Tahun" class="form-control" placeholder="Tahun">
      </div>
      <div class="col-lg-3">
          <input type="text" id="Keterangan" class="form-control" placeholder="Keterangan">
      </div>
  </div>
  <div class="row mt-2">
      <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="button" id="add-jobs" class="btn btn-primary">Tambah Pengalaman</button>
    </div>
</div>
<div class="row mt-2">
  <div class="col-lg-12">
    <table id="tablep" class="table nambah table-bordered table-hover datatable-highlight">
      <thead>
          <tr>
              <th rowspan="2" >#</th>
              <th rowspan="2" class="text-center">Perusahaan</th>
              <th rowspan="2" class="text-center">Jabatan</th>
              <th rowspan="2" class="text-center">Tahun</th>
              <th rowspan="2" class="text-center">Keterangan</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
  </table>
</div>
<button style="margin:10px 5px;" type="button" class="delete-jobs btn btn-danger">Delete Pengalaman</button>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Save Data Pelamar</button>
</div>
</form>
<br>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $("#add-jobs").click(function(){
          var p = $("#Perusahaan").val();
          var j = $("#Jabatan").val();
          var t = $("#Tahun").val();
          var k = $("#Keterangan").val();
          if (p=="") {
              alert("harus diisi");
          }else if(j==""){
              alert("harus diisi");
          }else if(t==""){
              alert("harus diisi");
          }else if(k==""){
              alert("harus diisi");

          }else{
              var markup = "<tr>\
              <td class='text-center'><input type='checkbox' name='record'></td>\
              <td><input type='hidden' name='Perusahaan[]' value='"+p+"'>"+p+"</td>\
              <td><input type='hidden' name='Jabatan[]' value='"+j+"'>"+j+"</td>\
              <td><input type='hidden' name='Tahun[]' value='"+t+"'>"+t+"</td>\
              <td><input type='hidden' name='Keterangan[]' value='"+k+"'>"+k+"</td>\
              </tr>";

              $("#tablep tbody").append(markup);
              document.getElementById("Perusahaan").value = "";
              document.getElementById("Jabatan").value = "";
              document.getElementById("Tahun").value = "";
              document.getElementById("Keterangan").value = "";
          }
      });
      $(".delete-jobs").click(function(){
          $("#tablep tbody").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){
                  $(this).parents("tr").remove();
              }
          });
      });

      // pendidikan //
      $("#add-pend").click(function(){
          var s = $("#Sekolah").val();
          var r = $("#Jurusan").val();
          var m = $("#Masuk").val();
          var l = $("#Lulus").val();
          if (s=="") {
              alert("harus diisi");
          }else if(r==""){
              alert("harus diisi");
          }else if(m==""){
              alert("harus diisi");
          }else if(l==""){
              alert("harus diisi");

          }else{
              var markups = "<tr>\
              <td class='text-center'><input type='checkbox' name='record'></td>\
              <td><input type='hidden' name='Sekolah[]' value='"+s+"'>"+s+"</td>\
              <td><input type='hidden' name='Jurusan[]' value='"+r+"'>"+r+"</td>\
              <td><input type='hidden' name='Masuk[]' value='"+m+"'>"+m+"</td>\
              <td><input type='hidden' name='Lulus[]' value='"+l+"'>"+l+"</td>\
              </tr>";

              $("#tabled tbody").append(markups);
              document.getElementById("Sekolah").value = "";
              document.getElementById("Jurusan").value = "";
              document.getElementById("Masuk").value = "";
              document.getElementById("Lulus").value = "";
          }
      });
      $(".delete-pend").click(function(){
          $("#tabled tbody").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){
                  $(this).parents("tr").remove();
              }
          });
      });

  });    

</script>
@endsection