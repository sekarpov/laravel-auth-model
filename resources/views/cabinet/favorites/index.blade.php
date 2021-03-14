@extends('layouts.app')

@section('content')
    @include('cabinet.favorites._nav')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Телефон</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td><a href="{{ route('cabinet.contacts.show', [$contact]) }}">{{ $contact->name }}</a></td>

                <td>{{ $contact->phone }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $contacts->links() }}
@endsection
