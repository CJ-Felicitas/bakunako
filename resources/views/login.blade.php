<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login as Parent</title>
    <link href="/uikit/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/uikit/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/uikit/css/ruang-admin.min.css" rel="stylesheet">
    <link href="/uikit/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom-font-size.css">
</head>

<body>
    <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 justify-content-center">
            <div class="col-md-12 text-center"> <!-- Removed justify-content-center -->
                <img src="/images/navbar1-logo.webp" width="70%" alt="">
            </div>
            <div class="form-group mt-5">
                <form action="/parentlogin_" method="post">
                    @csrf
                    <div class="card shadow p-3">
                        <h3 class="text-center">Login as Parent</h3>
                        <input value="{{ old('username') }}" type="text" name="username"
                        class="mb-2 form-control form-control-lg" placeholder="Username">

                    <input value="{{ old('password') }}" type="password" name="password"
                        class="form-control form-control-lg mb-1" placeholder="Password">
                    @if (session('error'))
                        <div class="alert alert-danger mt-1" role="alert">
                            Invalid Credentials
                        </div>
                    @endif

                    @if (session('account_error'))
                    <div class="alert alert-danger mt-1" role="alert">
                        This account is not a Parent
                    </div>
                @endif

                        <input type="submit" style="background-color:#cd9f8e" class="btn btn-block text-dark" value="Login">
                        <div class="mt-4"></div>
                        <h5 class="text-center">Don't have an account? <a href="/register">Click here</a> to register</h5>
                        <a class="mt-3" href="/">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
</html>
