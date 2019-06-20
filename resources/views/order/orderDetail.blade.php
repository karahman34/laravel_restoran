<form action="{{ route('detail_order.status') }}" method="post" class="form-submit no-load need-refresh" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <h4>No Meja: {{ $order->no_meja }}</h4>
            <h4>Waktu Pesan: {{ $order->created_at->diffForHumans() }}</h4>
        </div>
        <div class="col-md-6">
            <a href="{{ route('order.print', $order->id) }}" class="btn btn-primary pull-right" target="_blank"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="table-order">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Masakan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Waktu Pesan</th>
                        <th>Sampai</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 1;
                        $total = 0;
                    @endphp
                    @foreach ($models as $model)
                        @php
                            $total += $model->harga * $model->jumlah;
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $model->nama_masakan }}</td>
                            <td>Rp. {{ number_format($model->harga, 0,',','.') }}</td>
                            <td>{{ $model->jumlah }}</td>
                            <td>{{ $model->created_at->diffForHumans() }}</td>
                            <td>
                                @can('detail_order-edit')
                                    <input type="checkbox" name="ids[]" value="{{ $model->id }}" @if ($model->status_detail_order == 1)
                                        checked
                                    @endif>&nbsp;
                                    <span class="label label-success">Yes</span>
                                @else
                                    <span class="label label-danger">No Action</span>
                                @endcan
                            </td>
                            <td>Rp. {{ number_format($model->harga * $model->jumlah, 0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="7" align="right"><b>Total : Rp. {{ number_format($total, 0,',','.') }}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</form>
