<!-- resources/views/emails/registration.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Registration</title>
</head>
<body>
    <h2>New User Registration</h2>

    <ul>
        <li><strong>Name:</strong> {{ $userData['Nom'] }}</li>
        <br>
        <li><strong>Email:</strong> {{ $userData['email_pro'] }}</li>
        <br>
        <li><strong>Nom de Societe:</strong> {{ $userData['Nom_de_Societe'] }}</li>
        <br>
        <li><strong>Phone Number:</strong> {{ $userData['Phone_Number'] }}</li>
        <br>
        <li><strong>Registration Date:</strong> {{ $userData['Date_time_demande'] }}</li>
    </ul>

</body>
</html>
