<!DOCTYPE html>
<html>
<head>
    <title></title>    
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }}! </td>
        </tr>
        <tr>
            <td>Click on below button to activate your account</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><a href="{{ url('confirm/'.$code) }}">Activate Account</a></td>
        </tr>
    </table>
</body>   
</html>