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
                                <div style="position: absolute; top: 0;right:15px;">
                                    <a href="{{url('/daftar-sarpas-unras')}}" class="btn btn-info">Kembali</a>
                                </div>
                                <br><br><br>
                                <form id="detail_operasi" class="form-horizontal">
                                    <div class="jarviswidget jarviswidget-color-greenDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="true" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Detail Operasi</h2>
                                        </header>
                                        <div role="content">
                                            <div class="widget-body">

                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Lokasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" type="text" placeholder="Lokasi" name="lokasi" value="{{$operasi->lokasi}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Mulai Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{tgl_indo($operasi->tgl_mulai)}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Selesai Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{tgl_indo($operasi->tgl_selesai)}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Provinsi</label>
                                                            <div class="col-sm-7">
                                                                <select id="provinsi" name="provinsi" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" disabled="">-- PILIH --</option>
                                                                    @foreach($provinsi as $z)
                                                                    <option value="{{$z->id}}" @if($z->id == $operasi->prov_id) selected @endif>{{$z->nama_prov}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Jumlah Anggaran</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control uang" type="text" id="anggaran" name="anggaran" value="{{$operasi->jml_anggaran}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Status</label>
                                                            <div class="col-sm-7">
                                                                <select id="status" name="status" class="form-control js-example-basic-single" maxlength="200" value="{{$operasi->status}}">
                                                                    <option value="1" @if($operasi->status==1) selected @endif>Perencanaan</option>
                                                                    <option value="2" @if($operasi->status==2) selected @endif>Berlangsung</option>
                                                                    <option value="3" @if($operasi->status==3) selected @endif>Selesai</option>
                                                                    <option value="4" @if($operasi->status==4) selected @endif>Dilanjutkan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jarviswidget jarviswidget-color-magenta" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                                <header role="heading">
                                                    <h2><b>Data Personil</b></h2>
                                                </header>
                                                <div role="content">
                                                    <div class="row">
                                                        <!-- <div class="col-sm-12">
                                                            <h5><b>Data Personil</b></h5>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Jumlah Personil</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="data_personil" name="data_personil" value="{{$operasi->jml_personil}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table id="dt_basic_1" class="table table-striped table-bordered table-hover table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Personil</th>
                                                                        <th>NIP</th>
                                                                        <th>Pangkat</th>
                                                                        <th>Satuan Asal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($personil as $p)
                                                                    <tr>
                                                                        <td>{{$no++}}</td>
                                                                        <td>{{ $p->nama_personil }}</td>
                                                                        <td>{{ $p->nip }}</td>
                                                                        <td>{{ $p->pangkat }}</td>
                                                                        <td>{{ $p->satuan_asal }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jarviswidget jarviswidget-color-magenta" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                                <header role="heading">
                                                    <h2><b>Data Peralatan</b></h2>
                                                </header>
                                                <div role="content">
                                                    <div class="row">
                                                        <!-- <div class="col-sm-12">
                                                            <h5><b>Data Peralatan</b></h5>
                                                        </div> -->
                                                        <div class="col-md-12">
                                                            <table id="dt_basic_1" class="table table-striped table-bordered table-hover table-condensed">
                                                                <thead>
                                                                    <tr class="bg-warning">
                                                                        <th>No</th>
                                                                        <th>Nama Peralatan</th>
                                                                        <th>Jenis</th>
                                                                        <th>Jumlah</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $nom = 1 ?>
                                                                    @foreach($peralatan as $pe)
                                                                    <tr>
                                                                        <td>{{$nom++}}</td>
                                                                        <td>{{ $pe->nama_peralatan }}</td>
                                                                        <td>{{ $pe->jenis }}</td>
                                                                        <td>{{ $pe->jml }}</td>
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
                                </form>
                            </div>
                        </div>
                        <!-- END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    $(document).ready(function() {
        setMask();
        // $('#status').val("{{$operasi->status}}");
    })
    $('.js-example-basic-single').select2({
        width: '100%'
    });


    // flatpickr("#tgl_mulai", {
    //     altInput: true,
    //     altFormat: "d-m-Y",
    //     dateFormat: "Y-m-d",
    //     minDate: "today",
    // });
    // flatpickr("#tgl_selesai", {
    //     altInput: true,
    //     altFormat: "d-m-Y",
    //     dateFormat: "Y-m-d",
    //     minDate: "today",
    // });
</script>
@endsection