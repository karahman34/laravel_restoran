@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Order</h3>
            </div>
            <div class="box-body">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Form --}}
                <form action="" method="get" class="row">
                    <div class="form-group col-md-3">
                        <input type="text" name="no_meja" id="no_meja" class="form-control" placeholder="No Meja">
                    </div>

                    <div class="form-group col-md-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>&nbsp; Cari</button>
                    </div>
                </form>
                {{-- /Form --}}

                <table class="table table-responsive table-hover table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Meja</th>
                            <th>Sampai</th>
                            <th>Waktu Pesan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if (count($models) == 0)
                            <tr>
                                <td colspan="6" class="text-center">There is no data in here</td>
                            </tr>
                        @else
                            @foreach ($models as $model)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $model->no_meja }}</td>
                                    <td>{{ $status_order_1 }} / {{ count($model->detail_orders)}}</td>
                                    <td>{{ $model->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('order.show', $model->id) }}" class="btn btn-primary btn-show" data-toggle="tooltip" data-placement="left" title="Detail Order" data-title="Detail Order"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('body').on('click', '.btn-sampai', function(e){
        $(this).closest('td').find('#form-status').submit();
    });
</script>
@endpush
