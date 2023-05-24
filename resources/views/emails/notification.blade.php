<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento pedido {{ $orders->tracking }}</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">

        <h1 style="text-align: center;">Seguimiento pedido</h1>

        <p><strong>Número de seguimiento:</strong> {{ $orders->tracking }}</p>

        <p><strong>Estado del pedido:</strong> {{ $orders->status }}</p>

        <p><strong>Monto pedido:</strong> ${{ $orders->total_price }}</p>

        <h2>Detalles del pedido:</h2>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Precio total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItem as $item)
                    <tr>
                        <td>{{ $item->prod_id }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->price * $item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
