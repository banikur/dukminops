@extends('template.backend.main')
@section('title')
SIDUKOPS
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
                                <div class="panel panel-warning">
                                    <div class="panel-heading" style="background-color:#f78c40;color:white;"><strong>Filter</strong></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php $url = url('/operasi-inteligen-wilayah/filter/' . $param); ?>
                                            <form id="formFilter" method="post" action="{{$url}}">
                                                @csrf
                                                <input class="form-control" type="hidden" id="param" name="param" value="{{$param}}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">
                                                            Polda</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control js-example-basic-single" name="polda">
                                                                <option selected="" value="">Semua</option>
                                                                @foreach($data_polda as $pda)
                                                                <option value="{{$pda->id_polda}}">{{$pda->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div><br><br>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">
                                                            Polres</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control js-example-basic-single" name="polres">
                                                                <option selected="" value="">Semua</option>
                                                                @foreach($data_polres as $res)
                                                                <option value="{{$res->id_polres}}">{{$res->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">
                                                            Status Operasi</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control js-example-basic-single" name="lokasi_filter">
                                                                <option selected="" value="">Semua</option>
                                                                <option value="1">Perencanaan</option>
                                                                <option value="2">Berlangsung</option>
                                                                <option value="3">Selesai</option>
                                                                <option value="4">Dilanjutkan</option>
                                                            </select>
                                                        </div>
                                                    </div><br><br>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">
                                                            Tanggal Operasi</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" type="text" placeholder="Tanggal Mulai" id="tanggal_filter" name="tanggal_filter">
                                                        </div>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>&nbsp;Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                    <header role="heading">
                                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                        <h2>Operasi Wilayah</h2>
                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="widget-body">
                                            <table id="dt_basic_1" class="table table-hover table-bordered table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <center>No.</center>
                                                        </th>
                                                        <th>
                                                            <center>Level Operasi</center>
                                                        </th>
                                                        <th>
                                                            <center>Satuan</center>
                                                        </th>
                                                        <th>
                                                            <center>Nama Operasi</center>
                                                        </th>
                                                        <th>
                                                            <center>Lokasi</center>
                                                        </th>
                                                        <th>
                                                            <center>Jumlah Personil</center>
                                                        </th>
                                                        <th>
                                                            <center>Tgl. Mulai Operasi</center>
                                                        </th>
                                                        <th>
                                                            <center>Status Operasi</center>
                                                        </th>
                                                        <th>
                                                            <center>Aksi</center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    @foreach($operasi as $op)
                                                    <tr>
                                                        <td>
                                                            <center>{{ $no++ }}</center>
                                                        </td>
                                                        <td>
                                                            @if(!empty($op->id_polda))
                                                            <center>Polda</center>
                                                            @elseif(!empty($op->id_polda) && !empty($op->id_polres))
                                                            <center>Polres</center>
                                                            @else
                                                            <center>Mabes Polri</center>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($op->id_polda))
                                                            <?php $data = DB::table('users')->where('id_polda', $op->id_polda)->get(); ?>
                                                            <center>{{$data[0]->name}}</center>
                                                            @elseif(!empty($op->id_polda) && !empty($op->id_polres))
                                                            <?php $data = DB::table('users')->where('id_polres', $op->id_polda)->get(); ?>
                                                            <center>{{$data[0]->name}}</center>
                                                            @else
                                                            <center>Mabes Polri</center>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <center>{{ $op->nama_operasi }}</center>
                                                        </td>
                                                        <td>
                                                            <center>{{ $op->lokasi }}</center>
                                                        </td>
                                                        <td>
                                                            <center>{{ $op->jml_personil }}</center>
                                                        </td>
                                                        <td>
                                                            <center>{{ tgl_indo($op->tgl_mulai) }}</center>
                                                        </td>
                                                        @if($op->status==1)
                                                        <td>
                                                            <center>Perencanaan</center>
                                                        </td>
                                                        @elseif($op->status==2)
                                                        <td>
                                                            <center>Berlangsung</center>
                                                        </td>
                                                        @elseif($op->status==3)
                                                        <td>
                                                            <center>Selesai</center>
                                                        </td>
                                                        @elseif($op->status==4)
                                                        <td>
                                                            <center>Dilanjutkan</center>
                                                        </td>
                                                        @endif
                                                        <td>
                                                            <center>
                                                                <a href="{{ url('/operasi-inteligen-wilayah/detail/'.$op->id) }}" class="btn btn-sm btn-warning">Detail</a>
                                                            </center>
                                                        </td>
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
                <h4 class="modal-title" id="exampleModalLabel">Tambah Master Jenis Peralatan</h4>
            </div>
            <form id="formTambah" action="{{ url('master/jenis-peralatan-dashboard/tambah') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis_peralatan" class="col-form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="jenis_peralatan" name="jenis_peralatan">
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
                <h4 class="modal-title">Edit Master Jenis Peralatan</h4>
            </div>
            <form id="formEdit" action="{{url('master/jenis-peralatan-dashboard/edit')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id_edit">
                    <div class="form-group">
                        <label for="jenis_peralatan_edit" class="col-form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="jenis_peralatan_edit" name="jenis_peralatan_edit">
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
        $('.js-example-basic-single').select2({
            width: '100%'
        });
    })

    function EditMaster(obj) {
        var data = $(obj).data('item');

        $('#edit-master').modal('show');
        $('#id_edit').val(data.id);
        $('#jenis_peralatan_edit').val(data.jenis_peralatan);

    }

    flatpickr("#tanggal_filter", {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        // minDate: "today",
    });

    function hapusMaster(id) {
        Swal.fire({
            type: 'question',
            title: 'Ingin Hapus Data?',
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Hapus",
        }).then(function(result) {
            if (result.value) {
                window.location.href = "{{ URL::to('master/jenis-peralatan-dashboard/hapus/')}}" + '/' + id;
            } else {
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