


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento pedido {{ $order->tracking_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center; /* Centra el contenido del tbody */
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Seguimiento del pedido</h1>

        <p><strong>Número de seguimiento:</strong> {{ $order->tracking_number }}</p>
        
        <p><strong>Estado del pedido:</strong> 
        @php
            $status = '';
            if ($order->status  == 0) {
                $status = 'Pendiente';
            } elseif ($order->status == 1) {
                $status = 'Aprobado';
            } else {
                $status = 'Completado';
            }
        @endphp
        {{ $status }}</p>

        <p><strong>Valor total del pedido:</strong> ${{ $order->total_price }}</p>

        <h2>Detalles del pedido:</h2>

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
    </div>
</body>
</html>