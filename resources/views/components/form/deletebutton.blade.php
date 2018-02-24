{!! Form::open(['route' => [$route, $id], 'method' => 'DELETE']) !!}
    {{ Form::button('', ['class' => 'fa fa-remove delete', 'type' => 'submit', 'onclick' => "return confirm('Are you sure?')"]) }}
{!! Form::close() !!}