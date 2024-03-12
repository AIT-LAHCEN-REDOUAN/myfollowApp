<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table id="myTable" class='table-auto w-full '>
        <thead>
          <tr class='bg-gray-100'>
            <th class='px-4 py-2 text-center'>QR Code</th>
            <th class='px-4 py-2 text-center'>Reference</th>
            <th class='px-4 py-2 text-center'>Désignation</th>
            <th class='px-4 py-2 text-center'>Quantite Unitaire</th>
            <th class='px-4 py-2 text-center'>Fournisseur</th>
            <th class='px-4 py-2 text-center'>Prix</th>
            <th class='px-4 py-2 text-center'>Date de creation</th>
            <th class='px-4 py-2 text-center'>Date de modification</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <td><img src="{{public_path("{$item->Qr_code}") }}" alt="QR Code"></td>
            <td class='px-4 py-2 text-center'>{{$item->Reference}}</td>
            <td class='px-4 py-2 text-center'>{{$item->Designation}}</td>
            <td class='px-4 py-2 text-center'>{{$item->Qte_Unitaire}}</td>
            <td class='px-4 py-2 text-center'>{{$item->Fournisseur->name}}</td>
            <td class='px-4 py-2 text-center'>{{$item->Prix}}</td>
            <td class='px-4 py-2 text-center'>{{$item->created_at}}</td>
            <td class='px-4 py-2 text-center'>{{$item->updated_at}}</td>
          </tr>
          @endforeach
        </tbody>

      </table>
</body>
</html>
