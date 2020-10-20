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
                                <form method="post" class="form-horizontal" action="{{url('/update_data')}}" enctype="multipart/form-data" id="employee_form">
                                    <div class="jarviswidget" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Edit Operasi</h2>

                                            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                        </header>
                                        <div role="content">
                                            <div class="jarviswidget-editbox">
                                            </div>
                                            <div class="widget-body">

                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                                <input type="hidden" name="id_operasi" id="id_operasi" value="{{ $operasi->id }}" />

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Nomor Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Nomor Operasi" name="nomor_operasi" value="{{$operasi->nomor_operasi}}" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Nama Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Nama Operasi" name="nama_divisi" value="{{$operasi->nama_operasi}}" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Lokasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Lokasi" name="lokasi" value="{{$operasi->lokasi}}" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Mulai Ops.</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_start" name="tgl_start" value="{{$operasi->tgl_mulai}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Selesai Ops.</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_end" name="tgl_end" value="{{$operasi->tgl_selesai}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Provinsi</label>
                                                            <div class="col-sm-7">
                                                                <select id="prov" name="prov" onchange="getKabupaten()" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" disabled="">-- PILIH --</option>
                                                                    @foreach($provinsi as $z)
                                                                    <option value="{{$z->id}}" @if($operasi->prov_id==$z->id) selected @endif>{{$z->nama_prov}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Kabupaten</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control" id="kabupaten" name="kabupaten">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Jumlah Anggaran</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control uang" required="" type="text" id="anggaran" name="anggaran" value="{{$operasi->jml_anggaran}}" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Status</label>
                                                            <div class="col-sm-7">
                                                                <!-- <input type="text" class="form-control" id="status" name="status" value="Perencanaan" readonly> -->
                                                                <select id="status" name="status" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" value="1" @if($operasi->status ==1) selected @endif>Perencanaan</option>
                                                                    <option value="2" @if($operasi->status ==2) selected @endif>Berlangsung</option>
                                                                    <option value="3" @if($operasi->status ==3) selected @endif>Selesai</option>
                                                                    <option value="4" @if($operasi->status ==4) selected @endif>Dilanjutkan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                            </label>
                                                            <div class="col-sm-7">
                                                                <!-- <button type="submit" onclick="konfirmasi()" class="btn btn-success btn-sm pull-right"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Simpan
                                                                </button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-body">
                                                <hr class="simple">
                                                <ul id="myTab1" class="nav nav-tabs bordered">

                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Dokumen Perencanaan</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Data Personil</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Data Peralatan</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Dokumen Pelaporan Kegiatan Operasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Dokumen Pelaporan Anggaran</a>
                                                    </li>
                                                </ul>

                                                <div id="myTabContent1" class="tab-content padding-10">
                                                    <div class="tab-pane fade in active" id="s1">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Dokumen Perencanaan</label>
                                                                    <!-- <div class="col-sm-7">
                                                                            <input type="file" accept=".pdf" class="form-control" id="dok_perencanaan" name="dok_perencanaan">
                                                                        </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="button" id="add_dok_perencanaan" class="btn bg-color-blueLight txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                            </div>
                                                            <input type="hidden" name="nodetaidok_rencana" id="nodetaidok_rencana" value="0" />

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_2" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Nama Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_dok_perencanaan">
                                                                        @foreach($dokumenRencana as $d)
                                                                        <tr>
                                                                            <td><input type="hidden" value="{{$d->nama_dokumen}}" name="name_dok_perencanaans[]">{{$d->nama_dokumen}}</td>
                                                                            <td><input type="file" style="display:none;" value="{{$d->dokumen}}" class="form-control" name="dok_perencanaans[]"><a href="{{$d->path}}" class="btn btn-default">Dokumen</a></td>
                                                                            <td><center><button type="button" onclick="delete_detail(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s2">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Nama Personil</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="nama_personil" id="nama_personil" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        NIP</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="nip" id="nip" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Pangkat</label>
                                                                    <div class="col-sm-7">
                                                                        <select id="pangkat" name="pangkat" class="form-control" required maxlength="200">
                                                                            <option selected="" disabled="">-- PILIH --</option>
                                                                            @foreach($master_pangkat as $mp)
                                                                            <option value="{{$mp->id}}">{{$mp->nama_pangkat}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Satuan</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="nama_satuan" id="nama_satuan" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                    </label>
                                                                    <div class="col-sm-7">
                                                                        <button type="button" id="add_personil" class="btn bg-color-magenta txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Jumlah Personil</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" readonly="" type="text" name="count_personil" id="count_personil" value="{{count($personil)}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_3" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Nama Personil
                                                                            </th>
                                                                            <th>
                                                                                NIP
                                                                            </th>
                                                                            <th>
                                                                                Pangkat
                                                                            </th>
                                                                            <th>
                                                                                Satuan Asal
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="id_table_personil">
                                                                        @foreach($personil as $p)
                                                                        <tr>
                                                                            <td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="{{$p->nama_personil}}">{{$p->nama_personil}}</center></td>
                                                                            <td><center><input type="text" style="display:none;" name="nip_s[]" value="{{$p->nip}}">{{$p->nip}}</center></td>
                                                                            <td><center><input type="text" style="display:none;" name="pangkat_s[]" value="{{$p->pangkat}}">{{$p->nama_pangkat}}</center></td>
                                                                            <td><center><input type="text" style="display:none;" name="satuan_s[]" value="{{$p->satuan_asal}}">{{$p->satuan_asal}}</center></td>
                                                                            <td>
                                                                                <center>
                                                                                <button type="button" onclick="delete_personil(this)"
                                                                                class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                                                                </center>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s3">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                        <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Nama Peralatan</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="nama_alat" id="nama_alat" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Jenis</label>
                                                                    <div class="col-sm-7">
                                                                        <select id="jenis_peralatan" name="jenis_peralatan" class="form-control js-example-basic-single" required maxlength="200">
                                                                            <option selected="" value="1">Peralatan Pendukung</option>
                                                                            <option value="2">Peralatan Utama</option>
                                                                        </select>
                                                                        <!-- <input class="form-control" type="text" name="jenis_peralatan" id="jenis_peralatan" autocomplete="off"> -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Jumlah</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control uang" type="text" name="jumlah_alat" id="jumlah_alat" autocomplete="off">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                    </label>
                                                                    <div class="col-sm-7">
                                                                        <button type="button" id="add_peralatan" class="btn bg-color-magenta txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="count_alat" id="count_alat" value="0" />

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_4" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Nama Peralatan
                                                                            </th>
                                                                            <th>
                                                                                Jenis
                                                                            </th>
                                                                            <th>
                                                                                Jumlah
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_peralatan">
                                                                        @foreach($peralatan as $pe)
                                                                        <tr>
                                                                            <td><input type="text" style="display:none;" name="nama_peralatan_s[]" value="{{$pe->nama_peralatan}}">{{$pe->nama_peralatan}}</td>
                                                                            <td><input type="text" style="display:none;" name="jenis_alat_array[]" value="{{$pe->jenis}}">{{($pe->jenis==1)?'Peralatan Pendukung':'Peralatan Utama'}}</td>
                                                                            <td><input type="text" style="display:none;" name="jumlah_alat[]" value="{{$pe->jml}}">{{$pe->jml}}</td>
                                                                            <td><center><button type="button" onclick="delete_peralatan(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s4">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Dokumen Pelaporan Operasi</label>
                                                                    <div class="col-sm-7">
                                                                        <!-- <input type="file" accept=".pdf" class="form-control" id="dokpelaporan" name="pelaporan"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="button" id="add_dok_laporan" class="btn bg-color-blueLight txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                            </div>
                                                            <input type="hidden" name="nodetaidok_laporan" id="nodetaidok_laporan" value="0" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_5" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Nama Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_dok_pelaporan">
                                                                        @foreach($dokumenPelaporan as $dp)
                                                                            <tr>
                                                                                <td>{{$dp->nama_dokumen}}</td>
                                                                                <td><a href="{{$dp->path}}" class="btn btn-default">Dokumen</td>
                                                                                <td><center><button type="button" onclick="delete_dok_pelaporan(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s5">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Dokumen Pelaporan Anggaran</label>
                                                                    <div class="col-sm-7">
                                                                        <!-- <input type="file" accept=".pdf" class="form-control" id="dok_anggaran" name="dok_anggaran"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="button" id="add_laporan_anggaran" class="btn bg-color-blueLight txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                            </div>
                                                            <input type="hidden" name="nodetaidok_anggaran" id="nodetaidok_anggaran" value="0" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_6" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Nama Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_dok_anggaran">
                                                                        @foreach($dokumenAnggaran as $da)
                                                                            <tr>
                                                                                <td>{{$da->nama_dokumen}}</td>
                                                                                <td><a href="{{$da->path}}" class="btn btn-default">Dokumen</td>
                                                                                <td><center><button type="button" onclick="delete_dok_anggaran(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr class="simple">
                                            <div class="form-group">
                                                <label class="col-sm-5 control-label">
                                                </label>
                                                <div class="col-sm-7">
                                                    <button type="submit" onclick="konfirmasi()" class="btn btn-lg btn-success btn-sm pull-right"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Simpan
                                                    </button>
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
        getKabupaten();
        $('#pangkat').select2({
            width: '100%'
        });
    })
    $('.js-example-basic-single').select2({
        width: '100%'
    });
    const numberFormat = (value, decimals, decPoint, thousandsSep) => {
        decPoint = decPoint || '.';
        decimals = decimals !== undefined ? decimals : 2;
        thousandsSep = thousandsSep || ' ';

        if (typeof value === 'string') {
            value = parseFloat(value);
        }

        let result = value.toLocaleString('en-US', {
            maximumFractionDigits: decimals,
            minimumFractionDigits: decimals
        });

        let pieces = result.split('.');
        pieces[0] = pieces[0].split(',').join(thousandsSep);

        return pieces.join(decPoint);
    };

    flatpickr("#tgl_end", {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });
    flatpickr("#tgl_start", {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });

    function getKabupaten(){
        var provinsi = $('#prov').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.get('{{URL::to("/entry-operasi/prov")}}',{ provinsi:provinsi,_token:token},function(data){

            var html = '';
            var kabkota_id = '{{$operasi->kabkota_id}}';
            var selec = '';
            $.each(data, function( index, value ) {
                
            if(kabkota_id == value.id){
                selec = 'selected';
            }else{
                selec = '';
            }
                html += '<option value="'+value.id+'" '+selec+'>'+value.kab_kota+'</option>';
            });

            $('#kabupaten').append(html);
        })
    }

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function konfirmasi() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form

        Swal.fire({
            title: 'Apakah Data yang di Masukan Sudah Benar ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                form.submit();

            } else {
                Swal.fire({
                    title: "Batal memverifikasi",
                    type: "error",
                    allowOutsideClick: false,
                })
            }
        })

    }

    $('#add_dok_perencanaan').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var no = parseFloat($('#nodetaidok_rencana').val()) +1;
        $('#nodetaidok_rencana').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_perencanaan' +no + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_perencanaans[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_perencanaans[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_detail(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_perencanaan').append(html);
    });

    function delete_detail(no) {
        $(obj).closest("tr").remove();
    }

    $('#add_dok_laporan').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#nodetaidok_laporan').val();
        var no = parseFloat($('#nodetaidok_laporan').val()) +1;
        $('#nodetaidok_laporan').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_pelaporan' + $('#nodetaidok_laporan').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_pelaporan[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_pelaporan[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_dok_pelaporan(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_pelaporan').append(html);
    });

    function delete_dok_pelaporan(obj) {
        $(obj).closest("tr").remove();
    }

    $('#add_laporan_anggaran').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var no = parseFloat($('#nodetaidok_anggaran').val()) +1;
        $('#nodetaidok_anggaran').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_anggaran' + $('#nodetaidok_anggaran').val() + '">';
        // html += '<td><center>' + $('#nodetaidok_anggaran').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_anggaran[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_anggaran[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_dok_anggaran(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_anggaran').append(html);
    });

    function delete_dok_anggaran(no) {
        $(obj).closest("tr").remove();
    }

    $('#add_personil').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var count_personil = parseFloat($('#count_personil').val()) + 1;
        $('#count_personil').val(count_personil);
        var nama_personil = $('#nama_personil').val();
        var nip = $('#nip').val();
        var pangkat = $('#pangkat').val();
        var pangkat_name = $('#pangkat :selected').text();
        var satuan = $('#nama_satuan').val();

        $('#nodetail').val(no + 1);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_personil' + $('#count_personil').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nip_s[]" value="' +
            nip + '">' + nip + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="pangkat_s[]" value="' +
            pangkat + '">' + pangkat_name + '</td>';
        html += '<td><center><input type="text" style="display:none;" name="satuan_s[]" value="' +
            satuan + '">' + satuan + '</td>';

        html += '<td><center><button type="button" onclick="delete_personil(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_personil').append(html);
        clear_personil();
    });

    function delete_personil(obj) {
        var count_personil = parseFloat($('#count_personil').val()) - 1;
        $('#count_personil').val(count_personil);
        $(obj).closest("tr").remove();
    }

    function clear_personil() {
        var nama_personil = $('#nama_personil').val('');
        var nip = $('#nip').val('');
        var satuan = $('#nama_satuan').val('');
    }

    $('#add_peralatan').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var nama_personil = $('#nama_alat').val();
        var nip = $('#jenis_peralatan').val();
        var nip_name = $('#jenis_peralatan :selected').text();
        var pangkat = $('#jumlah_alat').val();
        var count_alat = parseFloat($('#count_alat').val()) + 1;
        $('#count_alat').val(count_alat);

        $('#halu').css("display", "none");

        html += '<tr id="id_table_peralatan' + $('#count_alat').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nama_peralatan_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jenis_alat_array[]" value="' +
            nip + '">' + nip_name + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jumlah_alat[]" value="' +
            pangkat + '">' + pangkat + '</td>';
        html += '<td><center><button type="button" onclick="delete_peralatan(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_peralatan').append(html);
        clear_peralatan();
    });

    function delete_peralatan(obj) {
        $(obj).closest("tr").remove();
    }

    function clear_peralatan() {
        var nama_personil = $('#nama_alat').val('');
        var nip = $('#jenis_peralatan').val('');
        var pangkat = $('#jumlah_alat').val('');
    }
</script>
@endsection