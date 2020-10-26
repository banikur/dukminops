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
                    <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning fade in">
                                    <button class="close" data-dismiss="alert">
                                        ×
                                    </button>
                                    <i class="fa-fw fa fa-warning"></i>
                                    <strong>Selamat Datang,</strong> {{Auth::guard('user')->user()->name}}
                                </div>
                            </div>
                        </div>
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
                                        <h2>Sebaran Operasi yang Sedang Berlansung</h2>

                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <br />
                                            <br />
                                            <!-- <center>
                                                <a href="{{url('/tambah-operasi')}}" class="btn btn-lg btn-warning">
                                                    <strong>Tambah Operasi</strong>
                                                </a>
                                            </center>
                                            <br/><br/> -->
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <div id="maps"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="simple">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card bg-warning">
                                                    <div class="card-header">
                                                        <h5 class="card-title" style="text-align: center; font-weight: 1000;">Jumlah Operasi</h5>
                                                    </div>
                                                    <div class="card-body" style="text-align: center;">
                                                        <h5 id="jumlah_ops">0</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-info">
                                                    <div class="card-header">
                                                        <h5 class="card-title" style="text-align: center; font-weight: 1000;">Jumlah Operasi Berlangsung</h5>
                                                    </div>
                                                    <div class="card-body" style="text-align: center;">
                                                        <h5 id="jumlah_ops_now">0</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        <h5 class="card-title" style="text-align: center; font-weight: 1000;">Jumlah Personil di Lapangan</h5>
                                                    </div>
                                                    <div class="card-body" style="text-align: center;">
                                                        <h5 id="jumlah_personil">0</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script>
    $(document).ready(function() {
        $.get("{{route('get_map')}}", function(data) {
            json = JSON.parse(data);
            console.log(json);
            // var data = [
            //     [json.kode_provinsi, json.count],
            // ];
            Highcharts.mapChart('maps', {
                chart: {
                    map: 'countries/id/id-all'
                },
                title: {
                    text: 'Sebaran Operasi yang Sedang Berlansung'
                },

                subtitle: {
                    text: ''
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0
                },

                series: [{
                    data: json.kode,
                    name: 'Jumlah Operasi',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]
            });
        })
        $.get("{{route('dashboard_box')}}", function(data) {
            json = JSON.parse(data);
            console.log(json);
            $('#jumlah_personil').text(json.personil);
            $('#jumlah_ops_now').text(json.berlangsung);
            $('#jumlah_ops').text(json.alldata);
        });
    });
</script>
@endsection