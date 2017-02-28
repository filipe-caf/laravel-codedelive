@extends('app')

@section('content')
    <div class="container">
        <h2>Pedido  <code>#{{ $order->id }}</code></h2>
        <h4>Cliente: <b>{{$order->client->user->name}}</b></h4>

        <pre><span>Data: {{ $order->created_at }}</span><spam class="pull-right"><b>R$ {{ $order->total }}</b></spam></pre>
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Endereço de entrega:</p>
                <p>
                    {{$order->client->address}}<br>
                    {{$order->client->city}} - {{ $order->client->state }}<br>
                    {{ $order->client->zipcode }}

                </p>
            </div>
        </div>

        {!! Form::model($order, ['route'=>['admin.orders.update', $order->id], 'class'=>'form']) !!}
        <div class="form-group">
            {!! Form::label('Status', 'Status:') !!}
            {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Entregador', 'Entregador:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection