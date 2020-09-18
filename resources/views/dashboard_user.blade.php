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
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                    <header role="heading">
                                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                        <h2>Data Diri</h2>

                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-lg-6">
                                                        @foreach($employee as $emp)
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                Nama Pegawai</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->nama_empl}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                Jenis Kelamin</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->gender}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                Nomor Induk Pegawai</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->nip}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                Alamat</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->alamat}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                Alamat E-Mail</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->email}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">
                                                                No. Telp</label>
                                                            <div class="col-sm-8">
                                                                {{$emp->telp}}
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Scan This For Absence !</h6>
                                                        <br/>
                                                        <?php $aaa = 'https://localhost/dukminops/public/absence-input/' . base64_encode($employee[0]->nip) . '/' . base64_encode(date('Y-m-d h:m:s')); //dd($aaa);
                                                        ?>
                                                        <!-- {{$aaa}} -->
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/images/logo.png', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 50%;">
                                                    </div>
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

    function haha() {
        var sum = 0;
        //alert("masul");
        var x = $("#totals").text();
        var a = x.split(',').join(".");
        $(".totalharga").each(function() {
            var tmpNilai = this.value.split('.').join("");
            var nilai = tmpNilai.split(',').join(".");
            if (!isNaN(nilai) && nilai.length != 0) {
                sum += parseFloat(nilai);
                // $(this).css("background-color", "#FEFFB0");
            } else if (nilai.length != 0) {

            } else {
                //add only if the value is number
                sum += parseFloat(nilai);
                if (!isNaN(nilai) && nilai.length != 0) {
                    sum += parseFloat(nilai);
                    // $(this).css("background-color", "#FEFFB0");
                } else if (nilai.length != 0) {
                    sum += parseFloat(nilai);
                }
            }
        });
        $('#totals').val(numberFormat(sum, 2, ',', '.'));
        $("#labelnya").html(numberFormat(sum, 2, ',', '.'));
    }

    function selectmenu() {
        var category = $("#category").val();
        var json = null;
        $.get('{{URL::to("/Cashier/cek_menu/")}}/' + category, function(data) {
            json = JSON.parse(data);
            console.log(json);
            test =
                "<option class='mst_perusahaan' disabled='' selected='' value='0'>-PILIH-</option>";
            for (let i = 0; i < json.length; i++) {
                test += "<option class='mst_perusahaan' value='" + json[i].id_menu +
                    "'>" + json[i].nama_menu + "</option>";
            }
            $('#menu').html(test);
            // $('#menu').val(json.no_meja);
            // for (let index = 0; index < json.length; index++) {
            //     console.log(json);

            // }
        });
        clear();
    }

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

    function getdetail() {
        var menu = $("#menu").val();
        var json = null;
        $.get('{{URL::to("/Cashier/get_detail_menu/")}}/' + menu, function(data) {
            json = JSON.parse(data);
            console.log(json);

            for (let i = 0; i < json.length; i++) {
                var x = json[i].price;
                $('#harga').val(x);
            }
        });
        clear();
    }

    function clear() {
        $('#qty').val('');
        $('#total').val('');
        $('#harga').val('');
    }


    function dikali() {
        var harga = parseInt($('#harga').val());
        var qty = parseInt($('#qty').val());
        var total_bayar = harga * qty;
        $('#total').val(total_bayar);
    }
    $('#addmore').on('click', function() {
        var html = '';
        var no = 0;
        var menu = $('#menu :selected').text();
        var qty = $('#qty').val();
        var harga = $('#harga').val();
        var id_menu = $('#menu :selected').val();
        var total = $('#total').val();
        if (menu == 'undefined' || harga == 'undefined' || qty == 'undefined' || total == 'undefined') {
            menu = '';
            harga = '';
            total = '';
            qty = '';
        }
        $('#nodetail').val(no + 1);
        $('#halu').css("display", "none");

        html += '<tr id="isiContentTable' + $('#nodetail').val() + '">';
        html += '<td><center><input type="text" style="display:none;" name="nama_menu[]" value="' +
            id_menu + '">' + menu + '</center></td>';
        html += '<td><center><input type="text" style="display:none;" name="qty[]" value="' +
            qty + '">' + qty + '</td>';
        html += '<td><center><input type="text" style="display:none;" name="hargasat[]" value="' +
            harga + '">' + numberFormat(harga, 2, ',', '.') + '</center></td>';
        html +=
            '<td><center><input type="text" style="display:none;"id="totalharga" class="totalharga" name="totalharga[]" value="' +
            total + '">' + numberFormat(total, 2, ',', '.') + '</center></td>';
        html += '<td><center><button type="button" onclick="delete_detail(' + $('#nodetail').val() +
            ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></center></td>';

        html += '</tr>';
        $('#isiTableedit').append(html);
        clear();
        haha();
    });

    function delete_detail(no) {
        var cek = parseInt($('#nodetail').val());
        if (cek != 0) {
            $('#nodetail').val(cek - 1);
        }
        $('#isiContentTable' + no).remove();
        clear();
        haha();
    }
</script>
@endsection