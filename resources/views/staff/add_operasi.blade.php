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
                                <form method="post" class="form-horizontal" action="" id="employee_form">
                                    <div class="jarviswidget" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Daftar Operasi</h2>

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
                                                                Jumlah Anggaran</label>
                                                            <div class="col-sm-7">
                                                                <input class="form-control uang" required="" type="text" id="anggaran" name="anggaran" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                                Status</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" id="status" name="status" value="Perencanaan" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">
                                                            </label>
                                                            <div class="col-sm-7">
                                                                <button type="submit" onclick="konfirmasi()" class="btn btn-success btn-sm pull-right"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Simpan
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="simple">
                                        </div>
                                    </div>

                                    <div class="jarviswidget" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                        <header role="heading">
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>Daftar Operasi</h2>

                                            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                        </header>
                                        <div role="content">
                                            <div class="jarviswidget-editbox">
                                            </div>
                                            <div class="widget-body">
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
                                                        </div>
                                                        <div class="tab-pane fade" id="s2">
                                                        </div>
                                                        <div class="tab-pane fade" id="s3">
                                                        </div>
                                                        <div class="tab-pane fade" id="s4">
                                                        </div>
                                                        <div class="tab-pane fade" id="s5">
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
        setMask();
    })
    $('.js-example-basic-single').select2();
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

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function konfirmasi() {

        var x = $("#totals").val();
        var c = x.split('.').join("");
        var total = c.split(',').join(".");

        var a = $("#bayar").val();
        var b = a.split('.').join("");
        var bayar = b.split(',').join(".");

        var due = bayar - total;
        $("#label_kembali").html(numberFormat(due, 2, ',', '.'));
        $('#kembalian').val(numberFormat(due, 2, ',', '.'));

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
</script>
@endsection