@extends('admin.body')


@section('body')
    <div class="page-title">
        <h2>Users</h2>
    </div>

    <section class="page page-white">
        <div class="container-fluid">
            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-4">
                            <div class="form-select grey">
                                <select class="form-control input-lg" name="role">
                                    <option value="">All</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ Request::get('role') == $role->
                                            name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text"
                                        name="keywords"
                                        class="form-control input-lg"
                                        value="{{ Request::get('keywords') }}"
                                        placeholder="First name, last name or username">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr data-href="/admin/users/{{ $user->id }}/edit">
                                <td class="bold">{{ $user->name() }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->is_active ? 'Yes' : 'No'}}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->
        </div>
    </section>


@endsection
