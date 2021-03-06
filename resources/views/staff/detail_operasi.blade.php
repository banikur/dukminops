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
                                <form method="post" class="form-horizontal" action="{{url('/store_data')}}" enctype="multipart/form-data" id="employee_form">
                                    <div class="jarviswidget" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Detail Operasi</h2>

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
                                                                <input type="text" class="form-control" id="tgl_start" name="tgl_start" value="{{tgl_indo($operasi->tgl_mulai)}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Tanggal Selesai Ops.</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="tgl_end" name="tgl_end" value="{{tgl_indo($operasi->tgl_selesai)}}">
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
                                                                    <option value="{{$mjo->id}}" @if($operasi->id_jenis_operasi==$mjo->id) selected @endif>{{$mjo->jenis_operasi}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
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
                                                            <!-- <div class="col-sm-7">
                                                                <button type="submit" onclick="konfirmasi()" class="btn btn-success btn-sm pull-right"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Simpan
                                                                </button>
                                                            </div> -->
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        No Renops</label>
                                                                    <div class="col-sm-4">
                                                                        <input class="form-control" type="text" name="no_renops" id="no_renops" value="{{$perencanaan->no_renops}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Tujuan</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="tujuan" id="tujuan">{{$perencanaan->tujuan}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Sasaran</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="sasaran" id="sasaran">{{$perencanaan->sasaran}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Target Operasi</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="target_operasi" id="target_operasi">{{$perencanaan->target_operasi}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Cara Bertindak</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="cara_tindak" id="cara_tindak">{{$perencanaan->cara_bertindak}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-10 col-md-offset-1">
                                                                        <table id="dt_basic_0" class="table table-striped table-bordered table-hover" width="100%">
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
                                                                                @foreach($dok_lapor as $dl)
                                                                                <tr>
                                                                                    <td>{{$no++}}</td>
                                                                                    <td>{{$dl->nama_dokumen}}</td>
                                                                                    <td><a href="{{asset($dl->path.$dl->dokumen)}}" target="_blank" class="btn btn-default">Dokumen</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="s2">
                                                        <div class="row" style="padding: 2% 0 2% 0;">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label">
                                                                        Data Personil</label>
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
                                                                                No.
                                                                            </th>
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
                                                                                Jabatan Struktural
                                                                            </th>
                                                                            <th>
                                                                                Jabatan Fungsional
                                                                            </th>
                                                                            <th>
                                                                                Satuan Asal
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_personil">
                                                                        @foreach($personil as $p)
                                                                        <tr>
                                                                            <td>{{$no++}}</td>
                                                                            <td>{{$p->nama_personil}}</td>
                                                                            <td>{{$p->nip}}</td>
                                                                            <td>{{$p->nama_pangkat}}</td>
                                                                            <td>{{$p->jabatan_struktural}}</td>
                                                                            <td>{{$p->jabatan_fungsional}}</td>
                                                                            <td>{{$p->satuan_asal}}</td>
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
                                                                        Data Peralatan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_4" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                No.
                                                                            </th>
                                                                            <th>
                                                                                Nama Peralatan
                                                                            </th>
                                                                            <th>
                                                                                Jenis
                                                                            </th>
                                                                            <th>
                                                                                Jumlah
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_peralatan">
                                                                        @foreach($peralatan as $pe)
                                                                        <tr>
                                                                            <td>{{$no++}}</td>
                                                                            <td>{{$pe->nama_peralatan}}</td>
                                                                            <td>{{($pe->jenis==1)?'Peralatan Pendukung':'Peralatan Utama'}}</td>
                                                                            <td>{{$pe->jml}}</td>
                                                                        </tr>
                                                                        @endforeach
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
                                                                        <textarea class="textAreaIinput" type="text" name="hasil_akhir" id="hasil_akhir">{{ $pa->hasil }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Kendala</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="kendala_akhir" id="kendala_akhir">{{$pa->kendala}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Analisa dan Evaluasi</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="textAreaIinput" type="text" name="evaluasi_akhir" id="evaluasi_akhir">{{$pa->evaluasi}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">
                                                                        Dokumen Pendukung</label>
                                                                    <div class="col-sm-4">
                                                                        <a href="{{ asset('upload-dokumen/dok_laporan/'.$pa->dokumen) }}" target="_blank" class="btn btn-default" style="color: orange;background-color:#525252;"> <i class="fa fa-download"></i>&nbspDownload</a>
                                                                    </div>
                                                                </div>
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
                                                            <!-- <div class="col-sm-6">
                                                                <button type="button" id="add_laporan_anggaran" class="btn bg-color-blueLight txt-color-white btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Tambah</button>
                                                            </div>
                                                            <input type="hidden" name="nodetaidok_anggaran" id="nodetaidok_anggaran" value="0" /> -->
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12"></div>
                                                            <div class="col-sm-12">
                                                                <?php $no = 1; ?>
                                                                <table id="dt_basic_6" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                No.
                                                                            </th>
                                                                            <th>
                                                                                Nama Dokumen
                                                                            </th>
                                                                            <th>
                                                                                Dokumen
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php $no = 1; ?>
                                                                    <tbody id="id_table_dok_anggaran">
                                                                        @foreach($dokumenAnggaran as $da)
                                                                        <tr>
                                                                            <td>{{$no++}}</td>
                                                                            <td>{{$da->nama_dokumen}}</td>
                                                                            <td><a href="{{asset($da->path.$da->dokumen)}}" target="_blank" class="btn btn-default">Dokumen</td>
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
        $('#dt_basic_3').DataTable();
        $('#dt_basic_4').DataTable();
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

    // flatpickr("#tgl_end", {
    //     altInput: true,
    //     altFormat: "d-m-Y",
    //     dateFormat: "Y-m-d",
    //     minDate: "today",
    // });
    // flatpickr("#tgl_start", {
    //     altInput: true,
    //     altFormat: "d-m-Y",
    //     dateFormat: "Y-m-d",
    //     minDate: "today",
    // });
    function getKabupaten() {
        var provinsi = $('#prov').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.get('{{URL::to("/entry-operasi/prov")}}', {
            provinsi: provinsi,
            _token: token
        }, function(data) {

            var html = '';
            var kabkota_id = '{{$operasi->kabkota_id}}';
            var selec = '';
            $.each(data, function(index, value) {

                if (kabkota_id == value.id) {
                    selec = 'selected';
                } else {
                    selec = '';
                }
                html += '<option value="' + value.id + '" ' + selec + '>' + value.kab_kota + '</option>';
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
        var no = parseFloat($('#nodetaidok_rencana').val()) + 1;
        $('#nodetaidok_rencana').val(no);
        $('#halu').css("display", "none");

        html += '<tr id="id_table_dok_perencanaan' + no + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" class="form-control" name="name_dok_perencanaans[]"></center></td>';
        html += '<td><center><input type="file" class="form-control" name="dok_perencanaans[]"></center></td>';
        html += '<td><center><button type="button" onclick="delete_detail(' + no +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_dok_perencanaan').append(html);
    });

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

        html += '<td><center><button type="button" onclick="delete_personil(' + $('#count_personil').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_personil').append(html);
        clear_personil();
    });

    function delete_personil(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_personil' + no).remove();
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
        var pangkat = $('#jumlah_alat').val();
        var count_alat = parseFloat($('#count_alat').val()) + 1;
        $('#count_alat').val(count_alat);

        $('#halu').css("display", "none");

        html += '<tr id="id_table_peralatan' + $('#count_alat').val() + '">';
        // html += '<td><center>' + $('#nodetail').val() + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="nama_peralatan_s[]" value="' +
            nama_personil + '">' + nama_personil + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jenis_alat_array[]" value="' +
            nip + '">' + nip + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="jumlah_alat[]" value="' +
            pangkat + '">' + pangkat + '</td>';
        html += '<td><center><button type="button" onclick="delete_peralatan(' + $('#count_alat').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#id_table_peralatan').append(html);
        clear_peralatan();
    });

    function delete_peralatan(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#id_table_peralatan' + no).remove();
    }

    function clear_peralatan() {
        var nama_personil = $('#nama_alat').val('');
        var nip = $('#jenis_peralatan').val('');
        var pangkat = $('#jumlah_alat').val('');
    }
</script>
@endsection