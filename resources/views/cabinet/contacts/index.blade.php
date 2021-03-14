@extends('layouts.app')

@section('content')
    @include('cabinet.contacts._nav')

    <p>
        <a href="{{ route('cabinet.contacts.create') }}" class="btn btn-success">Add Contact</a>
    </p>

    <table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td>ФИО</td>
            <td>Номер телеофна</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>
                    {{ $contact->id }}
                </td>
                <td>
                    <a href="{{ route('cabinet.contacts.show', [$contact]) }}">{{ $contact->name }}</a>
                </td>
                <td>
                    {{ $contact->phone }}
                </td>
                <td>
                    <form method="POST" action="{{ route('cabinet.contacts.destroy', $contact) }}" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('cabinet.contacts.edit', [$contact->id]) }}" class="btn-group btn btn-success btn-sm">Edit</a>
                        <button class="btn-group btn btn-danger btn-sm">Удалить</button>
                    </form>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
@endsection
