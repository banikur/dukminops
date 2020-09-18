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
                                        <h2>Form Pegawai</h2>

                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form method="post" class="form-horizontal" action="{{url('/store_employee')}}" id="employee_form">
                                                        <div class="col-lg-6">
                                                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                                                            <input class="form-control" readonly="" value="{{$autonya}}" type="hidden" name="id_empl" id="id_empl" autocomplete="off">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Nama Employee</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control" required="" type="text" placeholder="Nama Pegawai" name="nama_empl" id="nama_empl" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Gender</label>
                                                                <div class="col-sm-7">
                                                                    <div class="radio">
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="gender" value="Laki-Laki" checked>Laki-Laki</label>
                                                                        <label class="radio-inline"><input type="radio" name="gender" value="Perempuan">Perempuan</label>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    NIP</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control" required="" placeholder="NIP" type="text" name="nip" id="nip" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    No. Telepon</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control xxx" required="" type="text" name="telp" id="telp" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Alamat</label>
                                                                <div class="col-sm-7">
                                                                    <textarea name="alamat" required="" style="resize: vertical;" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Email</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control" required="" type="email" name="email" id="email" autocomplete="off" placeholder="example@hotmail.com">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Password</label>
                                                                <div class="col-sm-7">
                                                                    <input class="form-control" required="" type="password" name="pass" id="pass" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">
                                                                    Position</label>
                                                                <div class="col-sm-7">
                                                                    <select class="form-control select2" required="" name="position">
                                                                        <option></option>
                                                                        @foreach($divisi as $div)
                                                                        <option value="{{$div->id_divisi}}">{{$div->divisi_name}}</option>
                                                                        @endforeach
                                                                    </select>
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
                                            <hr class="simple">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                    <header role="heading">
                                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                        <h2>List Pegawai</h2>

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
                                                                    Nama Employee
                                                                </th>
                                                                <th>
                                                                    Gender
                                                                </th>
                                                                <th>
                                                                    No Telepon
                                                                </th>
                                                                <th>
                                                                    Alamat
                                                                </th>
                                                                <th>
                                                                    Email
                                                                </th>
                                                                <th>
                                                                    Position
                                                                </th>
                                                                <th>
                                                                    AKSI
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <?php $no = 1; ?>
                                                        <tbody id="isiTableedit">
                                                            @foreach($employee as $item)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$item->nama_empl}}</td>
                                                                <td>{{$item->gender}}</td>
                                                                <td>{{$item->telp}}</td>
                                                                <td>{{$item->alamat}}</td>
                                                                <td>{{$item->email}}</td>
                                                                <td>
                                                                    {{$item->divisi_name}}
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <button type="button" data-item="{{$item->id_empl}}" id="edit_barang" onclick="modal_employee(this)" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Ubah
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
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Ubah Employee</h2>
            </div>
            <form id="verif_invoice" class="form-horizontal" action="{{url('/update_employee')}}" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Employee ID</label>
                        <div class="col-sm-7">
                            <input class="form-control" readonly="" type="text" name="id_emp_edit" id="id_emp_edit" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Nama Employee</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="nama_emp_edit" id="nama_emp_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Gender</label>
                        <div class="col-sm-7">

                            <select class="form-control" required="" id="gender_edit" name="gender_edit">
                                <option> -- PILIH -- </option>
                                <option value="Laki-Laki"> Laki-Laki </option>
                                <option value="Perempuan"> Perempuan </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            No Telepon</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="telp_edit" id="telp_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Alamat</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="alamat_edit" id="alamat_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Email</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="email_edit" id="email_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Password</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="password" name="pass_edit" id="pass_edit" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Position</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" required="" id="position_edit" name="position_edit">
                                <option></option>
                                @foreach($divisi as $div)
                                <option value="{{$div->id_divisi}}">{{$div->divisi_name}}</option>
                                @endforeach
                            </select>
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

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function modal_employee(button) {
        $('#modal_employee').modal('show');
        var id = $(button).data('item');
        //alert(id_supp);
        $.get('{{URL::to("/get_data_emp/")}}/' + btoa(id), function(data) {
            json = JSON.parse(data);
            console.log(json);
            $('#id_emp_edit').val(json[0].id_empl);
            $('#nama_emp_edit').val(json[0].nama_empl);
            $('#gender_edit').val(json[0].gender);
            $('#telp_edit').val(json[0].telp);
            $('#alamat_edit').val(json[0].alamat);
            $('#email_edit').val(json[0].email);
            $('#pass_edit').val(json[0].pass);
            $('#position_edit').val(json[0].id_divisi).change();
        });
    }
</script>
@endsection