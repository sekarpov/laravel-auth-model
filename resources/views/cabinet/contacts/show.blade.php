@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            Контакт
        </div>
        <div class="card-body pb-2">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>ФИО:</b> {{ $contact->name }}</li>
                        <li class="list-group-item"><b>Телефон:</b> {{ $contact->phone }}</li>
                        <li class="list-group-item">
                            <div class="d-flex flex-row mb-3">
                                @if (auth()->user() && auth()->user()->hasInFavorites($contact->id))
                                    <form method="POST" action="{{ route('cabinet.favorites.remove', $contact) }}" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-secondary"><span class="fa fa-star"></span> Удалить из избранных</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('cabinet.favorites', $contact) }}" class="mr-1">
                                        @csrf
                                        <button class="btn btn-danger"><span class="fa fa-star"></span> Добавить в избранные</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
