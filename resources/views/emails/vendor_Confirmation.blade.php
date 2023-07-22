<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <th><td>Dear :{{$email}} !</td></th>
    <th><td>&nbsp;</td></th>
    <th><td>Please click on the Below link to confirm Your  Vendor Account :-< </td></th>
    <th><td><a href="{{url('vendor/confirm/'.$code)}}">{{url('vendor/confirm/'.$code)}}</a></td></th>
    <th><td>&nbsp;</td></th>
    <th><td>Thanks & Regards ,</td></th>
    <th><td>Stack Devloper</td></th>
    <th><td></td></th>
</body>
</html>