@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <div class="btn btn-primary">
                                Ga terug
                            </div>
                        </a>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="content-wrapper">
                            <section class="content-header">
                                <h1>
                                    Test voorbeeld
                                </h1>
                            </section>
                            <section class="content">


                                <h2>Ajax bestemming toevoegen</h2>
                                <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Voeg bestemming toe</button>
                                <div>

                                    <!-- Table-to-load-the-data Part -->
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Postcode</th>
                                            <th>Adres</th>
                                            <th>Plaats</th>
                                            <th>Gemeente</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tasks-list" name="tasks-list">
                                        @foreach ($tasks as $task)
                                            <tr id="task{{$task->id}}">
                                                <td>{{$task->id}}</td>
                                                <td>{{$task->postal_code}}</td>
                                                <td>{{$task->address}} {{$task->house_number}}</td>
                                                <td>{{$task->city}}</td>
                                                <td>{{$task->township}}</td>
                                                <td>{{$task->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$task->id}}">Edit</button>
                                                    <button name="delete" class="btn btn-danger btn-xs btn-delete delete-task" value="{{$task->id}}">Verwijder</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End of Table-to-load-the-data Part -->
                                    <!-- Modal (Pop up when detail button clicked) -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                                                         <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Bestemming toevoegen</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::model($task, [
                                                     'method' => 'POST',
                                                     'route' => 'melding.store',
                                                     'id' => 'destination',
                                                     'name' => 'destination'
                                                      ]) !!}

                                                    <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                                                        {!! Form::label('Postcode') !!}
                                                        {!! Form::text('postal_code', false, ['class' => 'form-control', 'id' => 'postal_code']) !!}
                                                        @if($errors->has('postal_code'))
                                                            <span class="help-block">
                                                    {{ $errors->first('postal_code') }}
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{ $errors->has('house_number') ? 'has-error' : '' }}">
                                                        {!! Form::label('Huisnummer') !!}
                                                        {!! Form::text('house_number', null, ['class' => 'form-control', 'id' => 'house_number', 'value' => '']) !!}
                                                        @if($errors->has('house_number'))
                                                            <span class="help-block">
                                                    {{ $errors->first('house_number') }}
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                        {!! Form::label('Straatnaam') !!}
                                                        {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'address', 'value' => '']) !!}
                                                        @if($errors->has('address'))
                                                            <span class="help-block">
                                                    {{ $errors->first('address') }}
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                        {!! Form::label('Plaats') !!}
                                                        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'value' => '']) !!}
                                                        @if($errors->has('city'))
                                                            <span class="help-block">
                                                    {{ $errors->first('city') }}
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{ $errors->has('township') ? 'has-error' : '' }}">
                                                        {!! Form::label('Gemeente') !!}
                                                        {!! Form::text('township', null, ['class' => 'form-control', 'id' => 'township', 'value' => '']) !!}
                                                        @if($errors->has('township'))
                                                            <span class="help-block">
                                                    {{ $errors->first('township') }}
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group {{ $errors->has('milage') ? 'has-error' : '' }}">
                                                        {!! Form::label('Kilometer op locatie') !!}
                                                        {!! Form::text('milage', null, ['class' => 'form-control', 'id' => 'milage', 'value' => '']) !!}
                                                        @if($errors->has('milage'))
                                                            <span class="help-block">
                                                    {{ $errors->first('milage') }}
                                                </span>
                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Opslaan</button>
                                                    <input type="hidden" id="task_id" name="task_id" value="0">

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



                        <meta name="_token" content="{!! csrf_token() !!}" />
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



    <script type="text/javascript">

    $(document).ready(function(){

    var url = "/destination";

    //display modal form for task editing
    $('.open-modal').click(function(){
    var task_id = $(this).val();

    $.get(url + '/' + task_id, function (data) {
    //success data
    console.log(data);
    $('#task_id').val(data.destination_id);
    $('#postal_code').val(data.postal_code);
    $('#address').val(data.address);
    $('#house_number').val(data.house_number);
    $('#city').val(data.city);
    $('#township').val(data.township);
    $('#btn-save').val("update");

    $('#myModal').modal('show');
    })
    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
    $('#btn-save').val("add");
    $('#destination').trigger("reset");
    $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-task').click(function(){

    var task_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

    $.ajax({

    type: "DELETE",
    url: url + '/' + task_id,
    success: function (data) {
    console.log(data);

    $("#destination" + task_id).remove();
    },
    error: function (data) {
    console.log('Error:', data);
    }
    });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
    })

    e.preventDefault();

    var formData = {
        postal_code: $('#postal_code').val(),
        address: $('#address').val(),
        house_number: $('#house_number').val(),
        city: $('#city').val(),
        township: $('#township').val(),
    }

    //used to determine the http verb to use [add=POST], [update=PUT]
    var state = $('#btn-save').val();

    var type = "POST"; //for creating new resource
    var task_id = $('#task_id').val();;
    var my_url = url;

    if (state == "update"){
    type = "PUT"; //for updating existing resource
    my_url += '/' + task_id;
    }

    console.log(formData);

    $.ajax({

    type: type,
    url: my_url,
    data: formData,
    dataType: 'json',
    success: function (data) {
    console.log(data);

    var destination = '<tr id="destination' + data.id + '"><td>' + data.id + '</td><td>' + data.postal_code + '</td><td>' + data.house_number + '</td>'
        + '<td>' + data.city + '</td><td>' + data.township + '</td><td>' + data.address + '</td><td>' + data.created_at + '</td>';
        destination += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
        destination += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';

    if (state == "add"){ //if user added a new record
    $('#tasks-list').append(destination);
    }else{ //if user updated an existing record

    $("#destination" + task_id).replaceWith( destination );
    }

    $('#destination').trigger("reset");

    $('#myModal').modal('hide')
    },
    error: function (data) {
    console.log('Error:', data);
    }
    });
    });
    });

</script>

@endsection