<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento pedido {{ $orders->tracking_number }}</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">

        <h1 style="text-align: center;">Seguimiento del pedido</h1>

        <p><strong>Número de seguimiento:</strong> {{ $orders->tracking_number }}</p>
        
        <p><strong>Estado del pedido:</strong> 
        @php
            $status = '';
            if ($orders->status  == 0) {
                $status = 'Pendiente';
            } elseif ($orders->status == 1) {
                $status = 'Aprobado';
            } else {
                $status = 'Completado';
            }
        @endphp
        {{ $status }}</p>

        <p><strong>Valor total del pedido:</strong> ${{ $orders->total_price }}</p>

        <h2>Detalles del pedido:</h2>

        <table class="table table-bordered" style="width: 100%;">
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
                        @php
                        $product = App\Models\Product::where('id', $item->prod_id)->first();
                        @endphp
                        <td>{{ $product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->price * $item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p style="font-size: 12px; margin-top: 20px;">
        Esta es una respuesta automática. Por favor, no responda a este correo.
        Si tiene alguna pregunta o consulta, póngase en contacto con nosotros a través de nuestra página web.
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
