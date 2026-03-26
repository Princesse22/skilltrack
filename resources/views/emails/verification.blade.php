<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>code de verification</title>
</head>
<body>
<p>bonjour Mr./Mme <strong>{{ $users->name }}</strong> ,</p>
<p>votre code de verification et: <b>{{ $code }}.</b></p>
<p>Il est valide pendant 5 minutes.</p>
<p>Merci!</p>
</body>
</html>
