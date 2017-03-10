@extends('app')

@section('content')
    <div class="container">
        <h3>Nova Pedido</h3>

        @include('errors._check')
        <div class="container">
            {!! Form::open(['route'=>'customer.order.store', 'class'=>'form']) !!}

            <div class="form-group">

                <pre><label for="total">Total: </label> R$ <b id="total">0.00</b></pre>

                <br><br><a href="#" class="btn btn-primary" id="btnNewItem">Novo Item</a><br><br>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <select name="items[0][product_id]" class="form-control">
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }} | R$ {{ $p->price }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::text('items[0][qtd]', 1, ['class'=>'form-control']) !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                {!! Form::submit('Criar pedido', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection

@section('post-script')
    <script>
        $('#btnNewItem').click(function () {
           var row = $('table tbody > tr:last'),
                newRow = row.clone(),
                length = $('table tbody tr').length;

           newRow.find('td').each(function () {
               var td = $(this),
                   input = td.find('input,select'),
                   name = input.attr('name');

               input.attr('name', name.replace((length - 1) + "", length +""));
           });
           newRow.find('input').val(1);
           newRow.insertAfter(row);
            calculeteTotal();
        });
        
        $(document.body).on('click', 'select', function () {
            calculeteTotal();
        });

        $(document.body).on('keyup', 'input', function () {
            calculeteTotal();
        });
        
        function calculeteTotal() {
            var total = 0,
                trLen = $('table tbody tr').length,
                tr = null, price, qtd;

            for (var i=0;i<trLen; i++){
                tr = $('table tbody tr').eq(i);
                price = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }

            $('#total').html(parseFloat(total).toFixed(2));
            
        }
        
    </script>
@endsection


