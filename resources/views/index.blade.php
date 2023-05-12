@extends('layouts.master')

@section('title', 'Students')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>{{ __('students.title') }}</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('students.create') }}"
                        class="cta-register btn-sm float-end">{{ __('students.add') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('students.name') }}</th>
                    <th>{{ __('students.username') }}</th>
                    <th>{{ __('students.birthdate') }}</th>
                    <th>{{ __('students.address') }}</th>
                    <th>{{ __('students.phone') }}</th>
                    <th>{{ __('students.email') }}</th>
                </tr>
                @if (count($data) > 0)
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->Full_name }}</td>
                            <td>{{ $row->Username }}</td>
                            <td>{{ $row->BirthDate }}</td>
                            <td>{{ $row->Address }}</td>
                            <td>{{ $row->Phone }}</td>
                            <td>{{ $row->Email }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">{{ __('students.empty') }}</td>
                    </tr>
                @endif
            </table>
            {!! $data->links() !!}
        </div>
    </div>

@endsection
