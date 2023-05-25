<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante</title>

    <style>
        body{
          align-items: center;
          justify-content: center;
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 70%;
        }
        
        td, th {
          border: 1px solid #c2c1c1;
          background-color: #dddddd;
          text-align: left;
          padding: 8px;
        }
        </style>
</head>
<body>
    <table class="">
        <h3>Detalles de la orden</h3>
        {{-- <thead> --}}
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        {{-- </thead> --}}
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->products->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <img height="100px" src="{{ Storage::url('uploads/productos/'.$item->products->image) }}" alt="">
                    </td>
                </tr>
            @endforeach
            <h4>Total: ${{ $order->total_price }}</h4>
        </tbody>
    </table>

    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>