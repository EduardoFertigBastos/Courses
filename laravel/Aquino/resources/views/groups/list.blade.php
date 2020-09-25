<table class="default-table">
    <thead>
        <tr>
            <td> # </td>
            <td> Nome do Grupo </td>
            <td> Valor </td>
            <td> Instituition </td>
            <td> User </td>
            <td colspan="3"> Opções </td>
        </tr>
    </thead>
    <tbody>
        @foreach($group_list as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td> R$ {{ number_format($group->total_value, 2, ',', '.') }}</td>
                <td>{{ $group->instituition->name }}</td>
                <td>{{ $group->user->name }}</td>
                <td>
                    {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'DELETE']) !!} 
                        {!! Form::submit('Remover') !!}
                    {!! Form::close() !!}                         
                </td>
                <td>
                    <a href="{{ route('group.show', $group->id) }}"> Detalhes </a>
                </td>
                <td>
                    <a href="{{ route('group.edit', $group->id) }}"> Editar </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>