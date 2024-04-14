<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/verify_schedule" method="post">
        @csrf
        <input type="hidden" name="schedule_id" value="4">
        <input type="hidden" name="status" value="done">
        <input type="hidden" name="last_updated_by" value="2">
        <input type="text" name="remarks" placeholder="Remarks here">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>
