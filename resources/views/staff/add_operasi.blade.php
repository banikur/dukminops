@extends('template.backend.main')
@section('title')
Dashboard E-Report
@endsection
@section('ribbon')
<style>
    .textAreaIinput {
        width: 100%;
        height: 100px;
    }
</style>
<ol class="breadcrumb">
    <!-- <li>Dashboard</li> -->
    <li class="pull-right"><?php echo date('j F, Y'); ?></li>
</ol>
@endsection
@section('content')
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
                                <?php $link;
                                if (Auth::guard('user')->check()) {
                                    $link = url('/store_data');
                                } else {
                                    $link = url('/pusat/store_data');
                                }

                                ?>
                                <form method="post" class="form-horizontal" action="{{$link}}" enctype="multipart/form-data" id="employee_form">
                                    <div class="jarviswidget jarviswidget-color-magenta" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Tambah Operasi</h2>

                                            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                        </header>
                                        <div role="content">
                                            <div class="jarviswidget-editbox">
                                            </div>
                                            <div class="widget-body">

                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Nomor Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Nomor Operasi" name="nomor_operasi" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Nama Operasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Nama Operasi" name="nama_divisi" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Lokasi</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control" required="" type="text" placeholder="Lokasi" name="lokasi" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Mulai Ops.</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_start" name="tgl_start">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Selesai Ops.</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_end" name="tgl_end">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Jenis Operasi</label>
                                                            <div class="col-sm-7">
                                                                <select id="jenis_operasi" name="jenis_operasi" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" disabled="">-- PILIH --</option>
                                                                    @foreach($master_jo as $mjo)
                                                                    <option value="{{$mjo->id}}">{{$mjo->jenis_operasi}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Provinsi</label>
                                                            <div class="col-sm-7">
                                                                <select id="prov" name="prov" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" disabled="">-- PILIH --</option>
                                                                    @foreach($provinsi as $z)
                                                                    <option value="{{$z->id}}">{{$z->nama_prov}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Kabupaten</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control js-example-basic-single" id="kabupaten" name="kabupaten">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Jumlah Anggaran</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control uang" required="" type="text" id="anggaran" name="anggaran" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Status</label>
                                                            <div class="col-sm-7">
                                                                <!-- <input type="text" class="form-control" id="status" name="status" value="Perencanaan" readonly> -->
                                                                <select id="status" name="status" class="form-control js-example-basic-single" required maxlength="200">
                                                                    <option selected="" value="1">Perencanaan</option>
                                                                    <option value="2">Berlangsung</option>
                                                                    <option value="3">Selesai</option>
                                                                    <option value="4">Dilanjutkan</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-body">
                                                <hr class="simple">
                                                <ul id="myTab1" class="nav nav-tabs bordered">

                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-file"></i>Dokumen Perencanaan</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i>Data Personil</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Data Peralatan</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-file"></i>Pelaporan Akhir Kegiatan Operasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-file"></i>Dokumen Pelaporan Anggaran</a>
                                                    </li>
                                                </ul>

                                                <div id="myTabContent1" class="tab-content padding-10">
                                                    <div class="tab-pane fade in active" id="s1">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        No Renops</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text" name="no_renops" id="no_renops" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Tujuan</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="tujuan" id="tujuan" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Sasaran</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="sasaran" id="sasaran" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Target Operasi</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="target_operasi" id="target_operasi" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Cara Bertindak</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="cara_tindak" id="cara_tindak" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Dokumen Pendukung</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="file" name="dok_perencanaan" id="dok_perencanaan" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s2">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">
                                                                        Export Data</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control" type="file" name="personil" id="personil" autocomplete="off">&nbsp;
                                                                        <label>Contoh Dokumen :</label><a href="{{ asset('upload-dokumen/dok_contoh/data_personil.xlsx') }}" target="_blank"> Download</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            <br />
                                                            <hr />
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
                                                                        NRP</label>
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
                                                                        Jabatan Struktural</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="jab_struk" id="jab_struk" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Jabatan Fungsional</label>
                                                                    <div class="col-sm-7">
                                                                        <input class="form-control" type="text" name="jab_fung" id="jab_fung" autocomplete="off">
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
                                                                        <input class="form-control" readonly="" value="0" type="text" name="count_personil" id="count_personil" autocomplete="off">
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
                                                                                NRP
                                                                            </th>
                                                                            <th>
                                                                                Pangkat
                                                                            </th>
                                                                            <th>
                                                                                Jabatan Struktural
                                                                            </th>
                                                                            <th>
                                                                                Jabatan Fungsional
                                                                            </th>
                                                                            <th>
                                                                                Satuan Asal
                                                                            </th>
                                                                            <th>
                                                                                Aksi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_personil">

                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s3">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">
                                                                        Export Data</label>
                                                                    <div class="col-sm-8">
                                                                        <input class="form-control" type="file" name="peralatan" id="peralatan" autocomplete="off">&nbsp;
                                                                        <label>Contoh Dokumen :</label><a href="{{ asset('upload-dokumen/dok_contoh/data_peralatan.xlsx') }}" target="_blank"> Download</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            <br />
                                                            <hr />
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
                                                                            @foreach($master_jenis_peralatan as $mjp)
                                                                            <option value="{{$mjp->id}}">{{$mjp->jenis_peralatan}}</option>
                                                                            @endforeach
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

                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s4">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Hasil yang Dicapai</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="hasil_akhir" id="hasil_akhir" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Kendala</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="kendala_akhir" id="kendala_akhir" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Analisa dan Evaluasi</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="evaluasi_akhir" id="evaluasi_akhir" autocomplete="off"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Dokumen Pendukung</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="file" name="dok_akhir" id="dok_akhir" autocomplete="off">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s5">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-5 control-label">
                                                                        Dokumen Pelaporan Anggaran</label>
                                                                    <div class="col-sm-7">
                                                                        <!-- <input type="file" accept=".pdf" class="form-control" id="dok_anggaran" name="dok_anggaran"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button type="button" id="add_laporan_anggaran" class="btn bg-color-magenta txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
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
        // $('#dt_basic_3').DataTable();
        // $('#dt_basic_4').DataTable();
        setMask();
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
        // minDate: "today",
    });
    flatpickr("#tgl_start", {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        // minDate: "today",
    });

    $('#prov').on('change', function() {
        var provinsi = $('#prov').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        // if({{Auth::guard('user')->check()}}){
        $.get('{{URL::to("/entry-operasi/prov")}}', {
            provinsi: provinsi,
            _token: token
        }, function(data) {
            var html = '';

            $.each(data, function(index, value) {
                html += '<option value="' + value.id + '">' + value.kab_kota + '</option>';
            });

            $('#kabupaten').append(html);
        })
        // }

        // else{
        //     $.get('{{URL::to("/pusat/entry-operasi/prov")}}', {
        //     provinsi: provinsi,
        //     _token: token
        // }, function(data) {
        //     var html = '';

        //     $.each(data, function(index, value) {
        //         html += '<option value="' + value.id + '">' + value.kab_kota + '</option>';
        //     });

        //     $('#kabupaten').append(html);
        // })
        // }


    });

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

    function delete_detail(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_dok_perencanaan' + no).remove();
    }

    $('#add_dok_laporan').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#nodetaidok_laporan').val();
        var no = parseFloat($('#nodetaidok_laporan').val()) + 1;
        $('#nodetaidok_laporan').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_pelaporan' + $('#nodetaidok_laporan').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_pelaporan[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_pelaporan[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_dok_pelaporan(' + $('#nodetaidok_laporan').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_pelaporan').append(html);
    });

    function delete_dok_pelaporan(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_dok_pelaporan' + no).remove();
    }

    $('#add_laporan_anggaran').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var no = parseFloat($('#nodetaidok_anggaran').val()) + 1;
        $('#nodetaidok_anggaran').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_anggaran' + $('#nodetaidok_anggaran').val() + '">';
        // html += '<td><center>' + $('#nodetaidok_anggaran').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_anggaran[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_anggaran[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_dok_anggaran(' + $('#nodetaidok_anggaran').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_anggaran').append(html);
    });

    function delete_dok_anggaran(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_dok_anggaran' + no).remove();
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

        var jab_struk = $('#jab_struk').val();
        var jab_fung = $('#jab_fung').val();

        $('#nodetail').val(no + 1);
        $('#halu').css("display", "none");

        var table = $('#dt_basic_3').DataTable();

        html += '<tr id="id_table_personil' + $('#count_personil').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nip_s[]" value="' +
            nip + '">' + nip + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="pangkat_s[]" value="' +
            pangkat + '">' + pangkat_name + '</td>';
        html += '<td><center><input type="text" style="display:none;" name="jab_struk[]" value="' +
            jab_struk + '">' + jab_struk + '</td>';
        html += '<td><center><input type="text" style="display:none;" name="jab_fung[]" value="' +
            jab_fung + '">' + jab_fung + '</td>';
        html += '<td><center><input type="text" style="display:none;" name="satuan_s[]" value="' +
            satuan + '">' + satuan + '</td>';

        html += '<td><center><button type="button" onclick="delete_personil(' + $('#count_personil').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        // $('#id_table_personil').append(html);
        var nama_data = '<td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        var nip_data = '<td><center><input type="text" style="display:none;" name="nip_s[]" value="' +
            nip + '">' + nip + '</center></td>';
        var pangkat_data = '<td><center><input type="text" style="display:none;" name="pangkat_s[]" value="' +
            pangkat + '">' + pangkat_name + '</td>';
        var jab_struk_data = '<td><center><input type="text" style="display:none;" name="jab_struk[]" value="' +
            jab_struk + '">' + jab_struk + '</td>';
        var jab_fung_data = '<td><center><input type="text" style="display:none;" name="jab_fung[]" value="' +
            jab_fung + '">' + jab_fung + '</td>';
        var satuan_data = '<td><center><input type="text" style="display:none;" name="satuan_s[]" value="' +
            satuan + '">' + satuan + '</td>';
        var hapus_data = '<td><center><button type="button" onclick="delete_personil(' + $('#count_personil').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        $.post('{{URL::to("/entry-operasi/cek-personil")}}',{
                _token:"{{csrf_token()}}",
                nip:nip}, function (data) {
                if(data.length > 0){
                    Swal.fire({
                        type: 'error',
                        text: 'Personil dengan NRP '+nip+' Sudah Dalam Operasi Lain',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    table.row.add([
                        nama_data,
                        nip_data,
                        pangkat_data,
                        jab_struk_data,
                        jab_fung_data,
                        satuan_data,
                        hapus_data
                    ]).draw(false);
                }

        });
        clear_personil();
    });

    function delete_personil(no) {
        console.log(no);
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_personil' + no).remove();
        $('#dt_basic_3').DataTable().row($('#id_table_personil' + no).closest('tr').remove());
        var count_personil = parseFloat($('#count_personil').val()) - 1;
        $('#count_personil').val(count_personil);
    }

    function clear_personil() {
        var nama_personil = $('#nama_personil').val('');
        var nip = $('#nip').val('');
        var satuan = $('#nama_satuan').val('');
        var jab_struk = $('#jab_struk').val('');
        var jab_fung = $('#jab_fung').val('');
    }

    $('#add_peralatan').on('click', function() {
        var html = '';
        var no = 0;
        //var doc = $('#dok_perencanaan').val();
        var nama_personil = $('#nama_alat').val();
        var nip = $('#jenis_peralatan').val();
        var nip_text = $('#jenis_peralatan :selected').text();
        var pangkat = $('#jumlah_alat').val();
        var count_alat = parseFloat($('#count_alat').val()) + 1;
        $('#count_alat').val(count_alat);

        $('#halu').css("display", "none");

        var table = $('#dt_basic_4').DataTable();

        html += '<tr id="id_table_peralatan' + $('#count_alat').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nama_peralatan_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jenis_alat_array[]" value="' +
            nip + '">' + nip_text + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jumlah_alat[]" value="' +
            pangkat + '">' + pangkat + '</td>';
        html += '<td><center><button type="button" onclick="delete_peralatan(' + $('#count_alat').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        console.log(nip_text);
        // $('#id_table_peralatan').append(html);
        var nama_data = '<td><center><input type="text" style="display:none;" name="nama_peralatan_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        var nip_data = '<td><center><input type="text" style="display:none;" name="jenis_alat_array[]" value="' +
            nip + '">' + nip_text + '</center></td>';
        var pangkat_data = '<td><center><input type="text" style="display:none;" name="jumlah_alat[]" value="' +
            pangkat + '">' + pangkat + '</td>';
        var hapus_data = '<td><center><button type="button" onclick="delete_peralatan(this)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';
        table.row.add([
            nama_data,
            nip_data,
            pangkat_data,
            hapus_data
        ]).draw(false);
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
<script>
    var files = false;
    var type_files = false;
    $('#personil').change(function() {
        files = this.files[0];
        type_files = this.files[0].type;

        importFile();
    })

    function importFile() {
        if (!$('#personil').val()) {
            files = false;
        }
        if (files) {
            $('.bgSpinner').show();
            var type = 3;
            var color = '#3388FF';
            var promise = false;
            var json = '';
            var arr = [];
            var arr2 = [];
            var html = '';
            var no = 0;
            var nama_pangkat;
            var x, result_pangkat;
            var token = $('meta[name="csrf-token"]').attr('content');
            promise = ObjectControl.excelToJSON(files);
            if (promise) {
                promise.then(function(data) {
                    if (data.length > 0) {
                        $.each(data, function(az, value) {
                            $('#nodetail').val(no + 1);
                            $('#halu').css("display", "none");
                            var param = '';
                            var nip = data[az]['nrp'];
                            let product = data[az]['pangkat'];
                            if (product == 1) {
                                param = 'Jenderal Polisi (Jend. Pol.)';
                            } else if (product == 2) {
                                param = 'Komisaris Jenderal (Komjen Pol.)';
                            } else if (product == 3) {
                                param = 'Inspektur Jenderal (Irjen Pol.)';
                            } else if (product == 4) {
                                param = 'Brigadir Jenderal (Brigjen Pol.)';
                            } else if (product == 5) {
                                param = 'Komisaris Besar (Kombes Pol.)';
                            } else if (product == 6) {
                                param = 'Ajun Komisaris Besar (AKBP)';
                            } else if (product == 7) {
                                param = 'Komisaris Polisi (Kompol)';
                            } else if (product == 8) {
                                param = 'Ajun Komisaris Polisi (AKP)';
                            } else if (product == 9) {
                                param = 'Inspektur Satu (Iptu)';
                            } else if (product == 10) {
                                param = 'Inspektur Dua (Ipda)';
                            } else if (product == 11) {
                                param = 'Ajun Inspektur Polisi Satu (AIPTU)';
                            } else if (product == 12) {
                                param = 'Ajun Inspektur Polisi Dua (AIPDA)';
                            } else if (product == 13) {
                                param = 'Brigadir Kepala (Bripka)';
                            } else if (product == 14) {
                                param = 'Brigadir Polisi (Brigpol)';
                            } else if (product == 15) {
                                param = 'Brigadir Satu (Briptu)';
                            } else if (product == 16) {
                                param = 'Brigadir Dua (Bripda)';
                            } else if (product == 17) {
                                param = 'Ajun Brigadir Polisi (Abrip)';
                            } else if (product == 18) {
                                param = 'Ajun Brigadir Satu (Abriptu)';
                            } else if (product == 19) {
                                param = 'Ajun Brigadir Dua (Abripda)';
                            } else if (product == 20) {
                                param = 'Bhayangkara Kepala (Bharaka)';
                            } else if (product == 21) {
                                param = 'Bhayangkara Satu (Bharatu)';
                            } else if (product == 22) {
                                param = 'Bhayangkara Dua (Bharada)';
                            }
                            html += '<tr id="id_table_personil' + az + '">';
                            html += '<td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="' +
                                data[az]['nama'] + '">' + data[az]['nama'] + '</center></td>';
                            html += '<td><center><input type="text" style="display:none;" name="nip_s[]" value="' +
                                data[az]['nrp'] + '">' + data[az]['nrp'] + '</center></td>';
                            html += '<td><center><input type="text" style="display:none;" name="pangkat_s[]" value="' +
                                data[az]['pangkat'] + '">' + param + '</td>';
                            html += '<td><center><input type="text" style="display:none;" name="jab_struk[]" value="' +
                                data[az]['jabatan_struktural'] + '">' + data[az]['jabatan_struktural'] + '</td>';
                            html += '<td><center><input type="text" style="display:none;" name="jab_fung[]" value="' +
                                data[az]['jabatan_fungsional'] + '">' + data[az]['jabatan_fungsional'] + '</td>';
                            html += '<td><center><input type="text" style="display:none;" name="satuan_s[]" value="' +
                                data[az]['satuan_asal'] + '">' + data[az]['satuan_asal'] + '</td>';

                            html += '<td><center><button type="button" onclick="delete_personil(' + az +
                                ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

                            html += '</tr>';
                                
                            var table = $('#dt_basic_3').DataTable();

                            var nama_data = '<td><center><input type="text" style="display:none;" name="nama_personil_s[]" value="' +
                                data[az]['nama'] + '">' + data[az]['nama'] + '</center></td>';
                            var nip_data = '<td><center><input type="text" style="display:none;" name="nip_s[]" value="' +
                                data[az]['nrp'] + '">' + data[az]['nrp'] + '</center></td>';
                            var pangkat_data = '<td><center><input type="text" style="display:none;" name="pangkat_s[]" value="' +
                                data[az]['pangkat'] + '">' + param + '</td>';
                            var jab_struk_data = '<td><center><input type="text" style="display:none;" name="jab_struk[]" value="' +
                                data[az]['jabatan_struktural'] + '">' + data[az]['jabatan_struktural'] + '</td>';
                            var jab_fung_data = '<td><center><input type="text" style="display:none;" name="jab_fung[]" value="' +
                                data[az]['jabatan_fungsional'] + '">' + data[az]['jabatan_fungsional'] + '</td>';
                            var satuan_data= '<td><center><input type="text" style="display:none;" name="satuan_s[]" value="' +
                                data[az]['satuan_asal'] + '">' + data[az]['satuan_asal'] + '</td>';

                            var hapus_data = '<td><center><button type="button" onclick="delete_personil(' + az +
                                ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

                            var textPesan = 'Personil dengan NRP '+nip+' Sudah Dalam Operasi Lain';
                            $.post('{{URL::to("/entry-operasi/cek-personil")}}',{
                                    _token:"{{csrf_token()}}",
                                    nip:nip}, function (data) {
                                    if(data.length > 0){
                                        // alert(textPesan);
                                        console.log(textPesan);
                                    }else{
                                        $('#count_personil').val(textPesan.length);
                                        table.row.add([
                                            nama_data,
                                            nip_data,
                                            pangkat_data,
                                            jab_struk_data,
                                            jab_fung_data,
                                            satuan_data,
                                            hapus_data
                                        ]).draw(false);
                                    // $('#id_table_personil').append(html);
                                    }

                            });
                        });
                        clear_personil();

                    }
                })
            }

        }
    }

    function getname(params) {
        var arr2;
        var url = "{{route('get_masterpangkat_id', '')}}" + "/" + params;
        var token = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            url: url,
            type: 'get',
            dataType: 'text/html',
            success: function(data) {
                return (data);
            },
            error: function() {
                return "Hello";
            }
        });

    }
</script>
<script>
    var files = false;
    var type_files2 = false;
    $('#peralatan').change(function() {
        files = this.files[0];
        type_files2 = this.files[0].type;

        importFile2();
    })

    function importFile2() {
        if (!$('#peralatan').val()) {
            files = false;
        }
        if (files) {
            $('.bgSpinner').show();
            var type = 3;
            var color = '#3388FF';
            var promise = false;
            var json = '';
            var arr = [];
            var arr2 = [];
            var html = '';
            var no = 0;
            var nama_pangkat;
            var x, result_pangkat;
            var token = $('meta[name="csrf-token"]').attr('content');
            promise = ObjectControl.excelToJSON(files);
            if (promise) {
                promise.then(function(data) {
                    if (data.length > 0) {
                        $.each(data, function(az, value) {
                            $('#nodetail').val(no + 1);
                            var count_alat = $('#count_alat').val();
                            $('#count_alat').val(az + 1);

                            $('#halu').css("display", "none");
                            var param = '';
                            var product = data[az]['jenis'];
                            if (product == 1) {
                                param = 'Kendaraan R2';
                            } else if (product == 2) {
                                param = 'Kendaraan R4';
                            } else if (product == 3) {
                                param = 'Kendaraan R6';
                            } else if (product == 4) {
                                param = 'Senjata Laras Panjang';
                            } else if (product == 5) {
                                param = 'Senjata Laras Pendek';
                            } else {
                                param = 'Lain-Lain';
                            }
                            html += '<tr id="id_table_peralatan' + az + '">';
                            // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
                            html += '<td><center><input type="text" style="display:none;" name="nama_peralatan_s[]" value="' +
                                data[az]['nama_alat'] + '">' + data[az]['nama_alat'] + '</center></td>';
                            html += '<td><center><input type="text" style="display:none;" name="jenis_alat_array[]" value="' +
                                data[az]['jenis'] + '">' + param + '</center></td>';
                            html += '<td><center><input type="text" style="display:none;" name="jumlah_alat[]" value="' +
                                data[az]['jumlah'] + '">' + data[az]['jumlah'] + '</td>';
                            html += '<td><center><button type="button" onclick="delete_peralatan(' + az +
                                ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

                            html += '</tr>';
                        });

                        $('#id_table_peralatan').append(html);
                        clear_peralatan();

                    }
                })
            }

        }
    }

    function getname(params) {
        var arr2;
        var url = "{{route('get_masterpangkat_id', '')}}" + "/" + params;
        var token = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            url: url,
            type: 'get',
            dataType: 'text/html',
            success: function(data) {
                return (data);
            },
            error: function() {
                return "Hello";
            }
        });

    }
</script>
<script>
    var ObjectControl = {
        excelToJSON: function(file) {
            if (!window.FileReader || !window.File) {
                return Promise.reject('Does not support File API');
            }
            if (!(file instanceof File)) {
                return Promise.reject('Not a file');
            }

            return new Promise(function(resolve, reject) {
                var reader = new FileReader();

                reader.onerror = function(err) {
                    reject(err);
                };

                // Closure to capture the file information.
                reader.onload = function() {
                    let data = event.target.result;
                    let workbook = XLSX.read(data, {
                        type: "binary"
                    });
                    let rowObject = [];
                    let json_object = [];
                    workbook.SheetNames.forEach(sheet => {
                        rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                        json_object = JSON.stringify(rowObject);
                    });
                    resolve(rowObject);
                };

                // Read in the image file as a data URL.
                reader.readAsBinaryString(file);
            });
        },
        toGeoJSON: function(layer) {
            var j = "";
            // if(layer instanceof L.Ellipse){
            // 	var lnglat = layer.getLatLng();
            // 	j = {
            // 		"type" : "Feature",
            // 		"geometry" : {
            // 			"coordinates" : [lnglat.lng,lnglat.lat],
            // 			"type" : "Point"
            // 		},
            // 		"properties" : layer.options
            // 	}
            // 	j.properties.mRadiusX = layer._mRadiusX;
            // 	j.properties.mRadiusY = layer._mRadiusY;
            // }else{
            j = layer.toGeoJSON();
            // }
            var feature = "";
            j.properties = layer.options;
            j.uniqueID = layer._leaflet_id;
            feature += JSON.stringify(j)
            return JSON.parse(feature);
        }

    }
</script>
@endsection