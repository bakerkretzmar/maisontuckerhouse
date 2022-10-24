@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    @noposts
        <x-alert type="warning">
            {!! __('Sorry, the page you were trying to visit does not exist.', 'mth') !!}
        </x-alert>

        {!! get_search_form(false) !!}
    @endnoposts
@endsection
