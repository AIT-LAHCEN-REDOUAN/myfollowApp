<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bon de Livraison</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin: 20px 0;
        }
        .barcode {
            text-align: center;
        }
        .details {
            margin: 20px 0;
        }
        p {
            margin: 5px 0;
        }
        .signature {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
{{--        <div class="header">--}}
{{--            <h1>Bon de Livraison</h1>--}}
{{--        </div>--}}
        <div class="barcode">
            {!!DNS2D::getBarcodeHTML("$data->Reference", "QRCODE", 3, 3)!!}
        </div>
        <div class="details">
            <p><strong>Référence:</strong> {{$data->Reference}}</p>
            <p><strong>Désignation:</strong> {{$data->Designation}}</p>
            <p><strong>Fournisseur:</strong> {{$data->Fournisseur->name}}</p>
            <p><strong>Prix:</strong> {{$data->Prix}}</p>
        </div>
{{--        <div class="signature">--}}
{{--            <p>Signature: ________________________</p>--}}
{{--        </div>--}}
    </div>
</body>
</html>

