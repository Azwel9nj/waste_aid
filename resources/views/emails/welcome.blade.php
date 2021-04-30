<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the Waste-AID {{$profile['name']}}</h2>
<br/>
Your registered email-id is {{$profile['email']}}
<br>
To log into your account , follow the following link: <a href="http://localhost:8000/seller_home">CLICK HERE</a>
<br>
<b>Your default PASSWORD is : {{$profile['password']}}
    <br>
    <h4>YOU ARE ADVISED TO CHANGED THIS PASSWORD AS SOON AS POSSIBLE, BY EDITING YOUR ACCOUNT</h4>
</b>

</body>

</html>