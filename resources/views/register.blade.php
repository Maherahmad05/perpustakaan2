<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Buku | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

    <style>
        .main {
            height: 100vh;
        }
        .register-box {
            width: 500px;
            border: solid 1px;
            padding: 30px;
        }
        form div{
            margin-bottom: 15px;
        }
    </style>

<body>
    
    <div class="main d-flex flex-column justify-content-center align-items-center">
            @if ($errors->any())
            <div class="alert alert-danger" style="widht: 500px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" style="width   : 500px">
                {{ session('message')}}
            </div>
            @endif
        <div class="register-box">
        <form action="" method="post">
                    @csrf
                    <div>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" >
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    <div>
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div>
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="5" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary form-control">Register</button>
                    </div>
                    <div class="text-center">
                       Have account? <a href="login"> Login</a>
                    </div>
        </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>