<!doctype html>
<html lang="ru">
<head>
    <title>Server Data</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .user-box {
            margin-bottom: 30px;
        }
        .input-group-text {
            min-width: 120px;
        }
    </style>
</head>
<body>
<section class="container-fluid">
    <main class="py-3 px-1">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="user-box card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Student</h4>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Login</span></div>
                            <input value="{{ $student }}" type="text" class="form-control" placeholder="Login">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Password</span></div>
                            <input value="password" type="text" class="form-control" placeholder="Password">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="user-box card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Teacher</h4>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Login</span></div>
                            <input value="{{ $teacher }}" type="text" class="form-control" placeholder="Login">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Password</span></div>
                            <input value="password" type="text" class="form-control" placeholder="Password">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="user-box card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Company</h4>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Login</span></div>
                            <input value="{{ $company }}" type="text" class="form-control" placeholder="Login">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Password</span></div>
                            <input value="password" type="text" class="form-control" placeholder="Password">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="user-box card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Admin</h4>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Login</span></div>
                            <input value="{{ $admin }}" type="text" class="form-control" placeholder="Login">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                        <div class="input-group mb-3 inputGroup">
                            <div class="input-group-prepend"><span class="input-group-text">Password</span></div>
                            <input value="password" type="text" class="form-control" placeholder="Password">
                            <div class="input-group-append"><button class="btn btn-info" onclick="copy(this)">Copy</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<script>
    function copy(elem) {
        elem.parentElement.parentElement.querySelector('input').select();
        document.execCommand("copy");
    }
</script>
</body>
</html>
