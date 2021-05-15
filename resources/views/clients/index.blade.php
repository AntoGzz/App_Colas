@extends('clients.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Queue App</h2>
            </div>
            <div class="pull-right">
                <!-- Button trigger create modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create New Client
                </button>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" style="text-align:center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Status</th>
            <th >Action</th>
        </tr>
        @foreach ($clients as $client)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->status }}</td>
            <td>
                <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $clients->links() !!}

    <div class="row">
        <div class="col-lg-12 margin-tb">
        </div>
    </div>

@endsection

@section('content2')
<div class="p-6">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="margin-right: 50px;">
            <h2>Queue 1</h2>
        </div>
        <div class="pull-right">
            Next :
            <span id="c1_minutos">0</span>:<span id="c1_segundos">0</span>
            <br>
            Dear to finish :
            <span>{{$count1*2+2}}:00</span>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Atendiendo</th>
            <th scope="col">En Cola</th>
            <th scope="col">Ultimo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- Pasamos el nombre del usuario cuyo id sea el primero en la tabla -->
                @if($query1first == '')
                    <td>0</td>
                @else
                <td>{{ $query1first->name }}</td>
                @endif

                <!-- Pasamos el count total de la tabla menos 1 -->
                @if($count1 == -1)
                    <td>0</td>
                @else
                    <td>{{ $count1 }}</td>
                @endif

                <!-- Pasamos el nombre del usuario cuyo id sea el ultimo en la tabla -->
                @if($query1last == '')
                    <td>0</td>
                @else
                <td>{{ $query1last->name }}</td>
                @endif
            </tr>
        </tbody>
    </table>
</div>

<div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="margin-right: 50px;">
            <h2>Queue 2</h2>
        </div>
        <div class="pull-right">
            Next :
            <span id="c2_minutos">0</span>:<span id="c2_segundos">0</span>
            <br>
            Dear to finish :
            <span>{{$count2*3+3}}:00</span>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Atendiendo</th>
            <th scope="col">En Cola</th>
            <th scope="col">Ultimo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- Pasamos el nombre del usuario cuyo id sea el primero en la tabla -->
                @if($query2first == '')
                    <td>0</td>
                @else
                <td>{{ $query2first->name }}</td>
                @endif

                <!-- Pasamos el count total de la tabla menos 1 -->
                @if($count2 == -1)
                    <td>0</td>
                @else
                    <td>{{ $count2 }}</td>
                @endif

                <!-- Pasamos el nombre del usuario cuyo id sea el ultimo en la tabla -->
                @if($query2last == '')
                    <td>0</td>
                @else
                <td>{{ $query2last->name }}</td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
@endsection

<!-- Create Modal -->
<div class="modal " id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <input type="text" name="status" class="form-control" placeholder="En Espera" value="En Espera" disabled>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
    const user = {!! json_encode($query2first->id) !!};

    function carga()
    {
        contador_s1 = 0;
        contador_m1 = 2;
        contador_s2 = 0;
        contador_m2 = 3;
        s1 = document.getElementById("c1_segundos");
        m1 = document.getElementById("c1_minutos");
        s2 = document.getElementById("c2_segundos");
        m2 = document.getElementById("c2_minutos");

        window.setInterval(
            function(){
                if(contador_s1==0)
                {
                    if(contador_m1===0 && contador_s1===0)
                    {
                        contador_m1=2;
                        contador_s1=0;
                    }
                    contador_m1--;
                    contador_s1=59;
                }
                s1.innerHTML = contador_s1;
                m1.innerHTML = contador_m1;
                contador_s1--;
            }, 1000);

        window.setInterval(
            function(){
                if(contador_s2==0)
                {
                    if(contador_m2===0 && contador_s2===0)
                    {
                        contador_m2=3;
                        contador_s2=0;
                    }
                    contador_m2--;
                    contador_s2=59;
                }
                s2.innerHTML = contador_s2;
                m2.innerHTML = contador_m2;
                contador_s2--;
            }, 1000);
    }
</script>
