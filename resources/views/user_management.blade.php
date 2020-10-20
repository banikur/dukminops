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

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

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
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                    <header role="heading">
                                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                        <h2>User Management</h2>
                                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                    </header>
                                    <div role="content">
                                        <div class="widget-body">
                                            <div class="col-md-12">
                                            <!-- tambah -->
                                            </div>
                                            <br><br><br>
                                            <table id="dt_basic_1" class="table table-hover table-bordered table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th><center>No.</center></th>
                                                        <th><center>Nama</center></th>
                                                        <th><center>Email</center></th>
                                                        <th><center>Status User</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $detail = DB::table('users_detail')->get() ?>
                                                    @foreach($user as $u)
                                                    <tr>
                                                        <td><center>{{$no++}}</center></td>
                                                        <td><center>{{$u->name}}</center></td>
                                                        <td><center>{{$u->name}}</center></td>
                                                        @if($u->id != $u->id_user)
                                                        <td><center>Admin</center></td>
                                                        @elseif(!empty($u->id_provinsi) && empty($u->id_kab_kota))
                                                        <td><center>Polda</center></td>
                                                        @elseif(!empty($u->id_provinsi) && !empty($u->id_kab_kota))
                                                        <td><center>Polres</center></td>
                                                        @else
                                                        <td><center></center></td>
                                                        @endif
                                                        <td>
                                                            <center>
                                                                <button class="btn btn-sm btn-primary" onclick="edit(this)" data-item="{{json_encode($u)}}"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                                <button class="btn btn-sm btn-warning" onclick="view(this)" data-item="{{json_encode($u)}}"><i class="fa fa-edit"></i>&nbsp;Detail</button>
                                                            </center>
                                                        </td>
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
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="exampleModalLabel">Edit User Management</h4>
            </div>
            <form id="formTambah" action="" method="POST">
            @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_kab_kota" id="id_kab_kota">
                    <div class="form-group">
                        <label for="jenis_peralatan" class="col-form-label">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user">
                    </div>
                    <div class="form-group">
                        <label for="jenis_peralatan" class="col-form-label">Provinsi</label>
                        <select class="form-control" name="prov_detail" id="prov_detail" onchange="getKabupaten()">
                            @foreach($provinsi as $p)
                                <option value="{{$p->id}}">{{$p->nama_prov}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_peralatan" class="col-form-label">Kabupaten</label>
                        <select class="form-control" name="kab_detail" id="kab_detail">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="view-user" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Master Jenis Peralatan</h4>
            </div>
            <form id="formEdit" action="{{url('master/jenis-peralatan-dashboard/edit')}}" method="post">
            @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id_edit">
                    <div class="form-group">
                        <label for="jenis_peralatan_edit" class="col-form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="jenis_peralatan_edit" name="jenis_peralatan_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button tton type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#dt_basic_1').DataTable();
    })

    function edit(obj){
        var item = $(obj).data('item');
        getKabupaten();
        console.log(item);
        $('#nama_user').val(item.name);
        $('#prov_detail').val(item.id_provinsi);
        $('#id_kab_kota').val(item.id_kab_kota);

        $('#edit-user').modal('show');
    }

    function getKabupaten(){
        var provinsi = $('#prov_detail').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.get('{{URL::to("/user-management/prov")}}',{ provinsi:provinsi,_token:token},function(data){

            var html = '';
            var kabkota_id = $('#id_kab_kota').val();
            console.log(kabkota_id);
            var selec = '';
            $.each(data, function( index, value ) {
                
            if(kabkota_id == value.id){
                selec = 'selected';
            }else{
                selec = '';
            }
                html += '<option value="'+value.id+'" '+selec+'>'+value.kab_kota+'</option>';
            });

            $('#kab_detail').append(html);
        })
    }

    function EditMaster(obj){
        var data = $(obj).data('item');

        $('#edit-master').modal('show');
        $('#id_edit').val(data.id);
        $('#jenis_peralatan_edit').val(data.jenis_peralatan);
        
    }

    function hapusMaster(id)
        {
            Swal.fire({
              type: 'question',
              title: 'Ingin Hapus Data?',
              showCancelButton: true,
              cancelButtonText: "Batal",
              confirmButtonText: "Hapus",
            }).then(function(result) {
                if(result.value){
                    window.location.href = "{{ URL::to('master/jenis-peralatan-dashboard/hapus/')}}"+'/'+id;
                }else{
                    Swal.fire({
                        type: 'error',
                        text: "Batal Hapus",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
        }
</script>
@endsection