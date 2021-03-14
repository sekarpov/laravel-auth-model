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
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
