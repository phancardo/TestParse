
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-body" style="margin-top: 20px">
                        <form method="POST" action="{{ route('insertionUser') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 form-label ">User name</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 form-label ">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 form-label ">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('signUp') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table  table-striped col-md-8" >
            <thead>
                <tr>
                    <td>ObjectId</td>
                    <td>Nom client</td>
                    <td>Update</td>
                    <td>Supression</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $data)
                <tr>
                    <th>{{ ($data->getObjectId()) }}</th>
                    <th>{{ $data->username }}</th>
                    <form action="{{ route('updateClient',$data->getObjectId()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <th class="col-md-6">
                            <div class="row ">
                                <div class="col-md-4">
                                    <input type="text" class="form-control col-md-2" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary">update</button>
                                </div>
                            </div>
                        </th>
                    </form>
                    <form action="{{ route('deleteClient',$data->getObjectId()) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <th>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </th>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

