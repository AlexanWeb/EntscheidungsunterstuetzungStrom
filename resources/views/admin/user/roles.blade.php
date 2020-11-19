@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="card">
            <h5 class="card-header">Roles for {{ $user->name }}</h5>
            <div class="card-body">
                <form action="{{ route('admin.user.update', [$user]) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <ul  class="list-group">
                        @forelse($roles as $role)
                            <li class="list-group-item">
                                <label>
                                    <input type="checkbox" name="roles[]"
                                           value="{{ $role->id }}" {{ $user->hasRolles($role) ? 'checked' : '' }}>
                                    {{ $role->name }}
                                </label>
                            </li>
                        @empty
                            <li>No roles</li>
                        @endforelse
                    </ul>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-check"></i>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
