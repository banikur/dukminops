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
                                        <h2>Data Dukungan Operasi Kepolisian</h2>
                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="panel panel-greenDark pricing-big">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Jumlah Operasi</h3>
                                                        </div>
                                                        <div class="panel-body no-padding text-align-center">
                                                            <div class="the-price">
                                                                <h1 id="jumlah_ops"><strong>0</strong></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="panel panel-teal pricing-big">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Jumlah Operasi Berlangsung</h3>
                                                        </div>
                                                        <div class="panel-body no-padding text-align-center">
                                                            <div class="the-price">
                                                                <h1 id="jumlah_ops_now"><strong>0</strong></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="panel panel-orange pricing-big">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Jumlah Personil di Lapangan</h3>
                                                        </div>
                                                        <div class="panel-body no-padding text-align-center">
                                                            <div class="the-price">
                                                                <h1 id="jumlah_personil"><strong>0</strong></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <div id="maps"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="simple">

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

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Detail Operasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="modal_body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">Tutup</button>
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
            // console.log(json);
            // var data = [
            //     [json.kode_provinsi, json.count],
            // ];
            Highcharts.mapChart('maps', {
                chart: {
                    map: 'countries/id/id-all'
                },
                title: {
                    text: 'Data Dukungan Operasi Kepolisian'
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
                    min: 0,
                    maxColor: '#ff0000',
                    minColor: '#fff3f3'
                },

                plotOptions: {
                    series: {
                        point: {
                            events: {
                                click: function() {
                                    // alert();
                                    var id_prov = this.properties['hc-key'];

                                    Swal.fire({
                                        title: 'Jumlah Operasi di ' + this.name + ' Adalah Sebanyak : ' + this.value,
                                        type: 'info',
                                        showCancelButton: true,
                                        confirmButtonColor: '#5cb85c',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lihat Detail',
                                        cancelButtonText: 'Tutup',
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if (result.value) {
                                            // form.submit();
                                            $.ajax({
                                                url: "{{route('get_detail_maps')}}",
                                                type: "post",
                                                data: {
                                                    id_prov: id_prov,
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                beforeSend: function() {
                                                    $('#loader').show();
                                                },
                                                success: function(data) {
                                                    $('#loader').hide();
                                                    $('#modal-tambah').modal('show');
                                                    $('#modal_body').append('<div id="body" class="col-md-12"></div>')
                                                    $('#body').html(data);
                                                }
                                            });
                                        } else {
                                            // Swal.fire({
                                            //     title: "Terimakasih",
                                            //     type: "success",
                                            //     allowOutsideClick: false,
                                            // })
                                        }
                                    })
                                }
                            }
                        }
                    }
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
            // console.log(json);
            $('#jumlah_personil').text(json.personil);
            $('#jumlah_ops_now').text(json.berlangsung);
            $('#jumlah_ops').text(json.alldata);
        });
    });
</script>
@endsection