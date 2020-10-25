@extends('template.backend.main')
@section('title')
Dashboard E-Report
@endsection
@section('ribbon')
<ol class="breadcrumb">
    <!-- <li>Dashboard</li> -->
    <li class="pull-right"><?php echo date('j F, Y'); ?></li>
</ol>
@endsection
@section('content')
<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        @if($errors->any())
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning fade in">
                                    <button class="close" data-dismiss="alert">
                                        ×
                                    </button>
                                    <i class="fa-fw fa fa-warning"></i>
                                    <strong>Peringatan</strong> {{$errors->first()}}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success fade in">
                                    <button class="close" data-dismiss="alert">
                                        ×
                                    </button>
                                    <i class="fa-fw fa fa-check"></i>
                                    <strong>Sukses</strong> {{session()->get('message')}}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                    <header role="heading">
                                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                        <h2>Master Pangkat</h2>
                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="widget-body">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambah-master"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                                            </div>
                                            <br><br><br>
                                            <table id="dt_basic_1" class="table table-hover table-bordered table-striped table-responsive">
                                                <thead> 
                                                    <tr>
                                                        <th><center>No.</center></th>
                                                        <th><center>Nama Pangkat</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1 ?>
                                                    @foreach($master_pangkat as $mp)
                                                    <tr>
                                                        <td><center>{{ $no++ }}</center></td>
                                                        <td><center>{{ $mp->nama_pangkat }}</center></td>
                                                        <td><center>
                                                            <button type="submit" class="btn btn-sm btn-primary" onclick="EditMaster(this)" data-item="{{json_encode($mp)}}"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="hapusMaster('{{$mp->id}}')"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                        </center></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="tambah-master" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="exampleModalLabel">Tambah Master Pangkat</h4>
            </div>
            <form id="formTambah" action="{{ url('master/pangkat-dashboard/tambah') }}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pangkat" class="col-form-label">Nama Pangkat</label>
                        <input type="text" class="form-control" id="pangkat" name="pangkat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="edit-master" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Master Pangkat</h4>
            </div>
            <form id="formEdit" action="{{url('master/pangkat-dashboard/edit')}}" method="post">
            @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id_edit">
                    <div class="form-group">
                        <label for="pangkat_edit" class="col-form-label">Nama Pangkat</label>
                        <input type="text" class="form-control" id="pangkat_edit" name="pangkat_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button tton type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#dt_basic_1').DataTable();
    })

    function EditMaster(obj){
        var data = $(obj).data('item');

        $('#edit-master').modal('show');
        $('#id_edit').val(data.id);
        $('#pangkat_edit').val(data.nama_pangkat);
        
    }

    function hapusMaster(id)
        {
            Swal.fire({
              type: 'question',
              title: 'Ingin Hapus Data?',
              showCancelButton: true,
              cancelButtonText: "Batal",
              confirmButtonText: "Hapus",
            }).then(function(result) {
                if(result.value){
                    window.location.href = "{{ URL::to('master/pangkat-dashboard/hapus/')}}"+'/'+id;
                }else{
                    Swal.fire({
                        type: 'error',
                        text: "Batal Hapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
        }
</script>
@endsection