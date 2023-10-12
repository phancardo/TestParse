
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
    <div class="container ">
        <div class="row justify-content-center" style="margin-top: 50px">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('insertionClient') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Non client') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __(' password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

     <table class="table  table-striped table-hover" >
        <thead>
            <tr>
                <td>ObjectId</td>
                <td>Nom client</td>
                <td>Update</td>
                <td>Supression</td>
                <td>Adresse</td>
                <td>Poste</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($client as $data)
            <tr>
                <th>{{ ($data->getObjectId()) }}</th>
                <th>{{ $data->name }}</th>
                <th>
                    <form action="{{ route('updateClient',$data->getObjectId()) }}" method="POST">
                        @csrf
                        @method('PUT')

                            <input type="text" class=" col-md-4" name="name" value="{{ old('name') }}" required autofocus>
                            <button type="submit" class="btn btn-secondary">update</button>
                    </form>
                </th>
                <form action="{{ route('deleteClient',$data->getObjectId()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <th>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </th>
                </form>
                <th>
                    Addresse
                </th>
                <th>
                    Poste
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

