@extends('layouts.new_theme')

@section('content')

<div class="section-header">
    <h1>{{ __('Departments') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
        <div class="breadcrumb-item">{{ __('Departments') }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            @include('common.demo')
            @include('common.errors')
            <div class="card">
                <div class="card-header">
                    <h4 class="inline-block">{{ __('List of Departments') }}</h4>
                    <small id='main'>
                        <a href="{{ route('department.create') }}"
                            class="btn btn-custom  float-right add_button">{{__('Add')}}</a>
                    </small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!count($departments))
                        <div class="empty-state pt-3" data-height="400">
                            <div class="empty-state-icon bg-danger">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('No data found') }} !!</h2>
                            <p class="lead">
                                {{ __('Sorry we cant find any data, to get rid of this message, make at least 1 entry') }}.
                            </p>
                            <a href="{{ route('department.create') }}"
                                class="btn btn-custom mt-4">{{ __('Create new One') }}</a>
                        </div>
                        @else
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr class="text-center text-capitalize">
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    @if (($imap_enables->value) == '1')
                                    <th>{{ __('IMAP status') }}</th>
                                    <th>{{ __('SMTP status') }}</th>
                                    @endif
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td class="text-capitalize">{{$department->name}}</td>
                                    <td>{{$department->email}} </td>
                                     <td>{{ Str::limit($department->description, 30) }}</td>
                                    @if (($imap_enables->value) == '1')

                                    @if (($department->imap_status) == true)
                                    <td class="text-success">{{ __('Active') }}</td>
                                    @else
                                    <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif

                                    @if (($department->smtp_status) == true)
                                    <td class="text-success">{{ __('Active') }}</td>
                                    @else
                                    <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif

                                    @endif
                                    <td class="justify-content-center form-inline">
                                        <a href="{{ route('department.edit', [$department->id]) }}"
                                            class="btn btn-sm bg-transparent"><i class="far fa-edit text-primary"
                                                aria-hidden="true" title="{{ __('Edit') }}"></i></a>
                                        <form action="{{ route('department.destroy', [$department->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm bg-transparent"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"
                                                    title="{{ __('Delete') }}"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection