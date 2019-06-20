<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <style>
        body{
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>
<body>
        <span>Kasir : {{ Auth::user()->nama_user }}</span><br>
        <span>Waktu : {{ $models['0']->created_at }}</span>
        <table border="0">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Nama Masakan</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $hartot = 0;
                @endphp
                @foreach ($models as $model)
                    @php
                        $hartot += $model->jumlah * $model->harga;
                    @endphp

                    <tr>
                        <td>{{ $model->jumlah }}</td>
                        <td>{{ $model->nama_masakan }}</td>
                        <td>Rp {{ number_format($model->harga, 0,',','.') }}</td>
                        <td>Rp {{ number_format($model->jumlah * $model->harga, 0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">Total Harga : </td>
                    <td>Rp {{ number_format($hartot, 0,',','.') }}</td>
                </tr>
            </tfoot>
        </table>

    <script>
        window.print();
    </script>
</body>
</html>
