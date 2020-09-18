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
                                        <h2>Form Divisi</h2>

                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form method="post" class="form-horizontal" action="{{url('/store_nilai_pegawai')}}" id="employee_form">
                                                        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Nama Pegawai</label>
                                                                <div class="col-sm-7">
                                                                    <select class="form-control select2" onchange="selectmenu()" required="" id="pegawai" name="pegawai">
                                                                        <option></option>
                                                                        @foreach($penilaian_user as $div)
                                                                        <option value="{{$div->id_empl}}">{{$div->nama_empl}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Parameter Penilaian</label>
                                                                <div class="col-sm-7">
                                                                    <select class="form-control select2" required="" id="parameter_nilai" name="parameter_nilai">
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Nilai</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control cashier" type="text" name="nilai" id="nilai" autocomplete="off">
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="simple">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                <header role="heading">
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>List Upah Pegawai</h2>

                                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                </header>
                                <div role="content">
                                    <div class="jarviswidget-editbox">
                                    </div>
                                    <div class="widget-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php $no = 1; ?>
                                                <table id="dt_basic_1" class="table table-striped table-bordered table-hover" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                No.
                                                            </th>
                                                            <th>
                                                                Nama Pegawai
                                                            </th>
                                                            <th>
                                                                Parameter Penilaian
                                                            </th>
                                                            <th>
                                                                Nilai
                                                            </th>
                                                            <th>
                                                                AKSI
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <?php $no = 1; ?>
                                                    <tbody id="isiTableedit">
                                                        @foreach($list_nilai as $div)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$div->nama_empl}}</td>
                                                            <td>{{$div->parameter_penilaian}}</td>
                                                            <td>{{$div->value}}</td>
                                                            <td>
                                                                <center>
                                                                    <button type="button" data-item="{{$div->id_record}}" id="edit_barang" onclick="modal_employee(this)" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Ubah
                                                                    </button>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <hr class="simple">
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

<div class="modal fade bs-example-modal-lg" id="modal_employee" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Ubah Penilaian Pegawai</h2>
            </div>
            <form id="verif_invoice" class="form-horizontal" action="{{url('/update_nilai_pegawai')}}" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="col-sm-7">
                            <input class="form-control" readonly="" type="hidden" name="id_payroll_edit" id="id_payroll_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Nama Employee</label>
                        <div class="col-sm-7">
                            <input class="form-control" readonly type="text" name="nama_employee_edit" id="nama_employee_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Parameter Penilaian</label>
                        <div class="col-sm-7">
                            <input class="form-control" readonly type="text" name="nama_div_edit" id="nama_div_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Nilai</label>
                        <div class="col-sm-7">
                            <input class="form-control cashier" type="text" name="nama_upah_edit" id="nama_upah_edit" autocomplete="off">
                        </div>
                    </div>

                </div>
                <div class="modal-footer" id="modal_footer">
                    <button type="button" onclick="return konfirmasi2()" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="refresh()">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        setMask();
        $('#dt_basic_1').dataTable();
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

    $(".select2").select2({
        placeholder: "Select a state",
        allowClear: true
    });

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
                    title: "Batal Input",
                    type: "error",
                    allowOutsideClick: false,
                })
                refresh();
            }
        })
    }

    function konfirmasi2() {
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
                    title: "Batal Ubah Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                refresh();
            }
        })

    }

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function selectmenu() {
        var category = $("#pegawai").val();
        var json = null;
        $.get('{{URL::to("/get_data_user_penilaian/")}}/' + category, function(data) {
            json = JSON.parse(data);
            console.log(json);
            test =
                "<option class='mst_perusahaan' disabled='' selected='' value='0'>-PILIH-</option>";
            for (let i = 0; i < json.length; i++) {
                if (json[i].length != 0) {
                    test += "<option class='mst_perusahaan' value='" + json[i].id_penilaian +
                        "'>" + json[i].parameter_penilaian + "</option>";
                }
            }
            $('#parameter_nilai').html(test);
        });
    }

    function modal_employee(button) {
        $('#modal_employee').modal('show');
        var id = $(button).data('item');
        //alert(id_supp);
        $.get('{{url("/get_data_penilaian_pegawai")}}/' + btoa(id), function(data) {
            json = JSON.parse(data);
            console.log(json);

            $('#id_payroll_edit').val(json[0].id_record);
            $('#nama_employee_edit').val(json[0].nama_empl);
            $('#nama_div_edit').val(json[0].parameter_penilaian);
            $('#nama_upah_edit').val(numberFormat(json[0].value, 2, ',', '.'));
        });
    }
</script>
@endsection