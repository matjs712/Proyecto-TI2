<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento pedido {{ $orders->tracking_number }}</title>
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

        <p><strong>Número de seguimiento:</strong> {{ $orders->tracking_number }}</p>
        
        <p><strong>Estado del pedido:</strong> 
        @php
            $status = '';
            if ($orders->status  == 0) {
                $status = 'Pendiente de pago';
            } elseif ($orders->status == 1) {
                $status = 'Completado';
            } else {
                $status = 'Pago aprobado';
            }
        @endphp
        {{ $status }}</p>

        <p><strong>Valor total del pedido:</strong> ${{ $orders->total_price }}</p>

        <h2>Detalles del pedido:</h2>

        <table>
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
</body>
</html>