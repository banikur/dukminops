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
<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
    <header role="heading">
        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
        <h2>Detail Operasi di Wilayah {{$wil}}</h2>
        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
    </header>
    <div role="content">
        <div class="widget-body">
            <table id="dt_basic_1" width="100%" class="table table-hover table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>
                            <center>No.</center>
                        </th>
                        <th>
                            <center>Level Operasi</center>
                        </th>
                        <th>
                            <center>Satuan</center>
                        </th>
                        <th>
                            <center>Nama Operasi</center>
                        </th>
                        <th>
                            <center>Lokasi</center>
                        </th>
                        <th>
                            <center>Jumlah Personil</center>
                        </th>
                        <th>
                            <center>Tgl. Mulai Operasi</center>
                        </th>
                        <th>
                            <center>Status Operasi</center>
                        </th>
                        <th>
                            <center>Jenis Operasi</center>
                        </th>
                        <th>
                            <center>Aksi</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach($operasi as $op)
                    <tr>
                        <td>
                            <center>{{ $no++ }}</center>
                        </td>
                        <td>
                            @if(!empty($op->id_polda))
                            <center>Polda</center>
                            @elseif(!empty($op->id_polda) && !empty($op->id_polres))
                            <center>Polres</center>
                            @else
                            <center>Mabes Polri</center>
                            @endif
                        </td>
                        <td>
                            @if(!empty($op->id_polda))
                            <?php $data = DB::table('users')->where('id_polda', $op->id_polda)->get(); ?>
                            <center>{{$data[0]->name}}</center>
                            @elseif(!empty($op->id_polda) && !empty($op->id_polres))
                            <?php $data = DB::table('users')->where('id_polres', $op->id_polda)->get(); ?>
                            <center>{{$data[0]->name}}</center>
                            @else
                            <center>Mabes Polri</center>
                            @endif
                        </td>
                        <td>
                            <center>{{ $op->nama_operasi }}</center>
                        </td>
                        <td>
                            <center>{{ $op->lokasi }}</center>
                        </td>
                        <td>
                            <center>{{ $op->jml_personil }}</center>
                        </td>
                        <td>
                            <center>{{ tgl_indo($op->tgl_mulai) }}</center>
                        </td>
                        @if($op->status==1)
                        <td>
                            <center>Perencanaan</center>
                        </td>
                        @elseif($op->status==2)
                        <td>
                            <center>Berlangsung</center>
                        </td>
                        @elseif($op->status==3)
                        <td>
                            <center>Selesai</center>
                        </td>
                        @elseif($op->status==4)
                        <td>
                            <center>Dilanjutkan</center>
                        </td>
                        @endif
                        <td>
                            @if($op->id_jenis_operasi == 0)
                            Operasi Intelijen
                            @elseif($op->id_jenis_operasi == 2)
                            Operasi Penegakan Hukum
                            @elseif($op->id_jenis_operasi == 3)
                            Operasi Pengamanan Kegiatan
                            @elseif($op->id_jenis_operasi == 4)
                            Operasi Pemeliharaan Keamanan
                            @elseif($op->id_jenis_operasi == 5)
                            Operasi Kontijensi Keamanan
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <center>
                                <a href="{{ url('/operasi-inteligen-wilayah/detail/'.$op->id) }}" class="btn btn-sm btn-warning">Detail</a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dt_basic_1').DataTable();
        $('.js-example-basic-single').select2({
            width: '100%'
        });
    })
</script>