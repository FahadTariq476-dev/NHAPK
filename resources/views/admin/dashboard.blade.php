<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Welcome your are logged in. Now</h1>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </body>
</html>