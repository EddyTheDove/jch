@extends('admin.body')

@section('body')
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => '_form' ]) !!}
    <div class="page-title">
        <h2>Edit User</h2>
    </div>


    <section class="container-fluid mt-20">

        @include('errors.list')

        <div class="block">
            <div class="block-content form">

                <div class="row pb-20">
                    <div class="col-sm-3">
                        <label>Status</label>
                        <div class="form-select grey">
                            <select name="is_active" class="form-control input-lg">
                                <option value="0" {{ $user->is_active ? '' : 'selected'}}>Inactive</option>
                                <option value="1" {{ $user->is_active ? 'selected' : ''}}>Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label>Role</label>
                        <div class="form-select grey">
                            <select name="role_id" class="form-control input-lg">
                                @foreach( $roles as $role )
                                    <option value="{{ $role->id}}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" name="firstname" class="form-control input-lg" value="{{ $user->firstname }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" name="lastname" class="form-control input-lg" value="{{ $user->lastname }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control input-lg" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="phone" class="form-control input-lg" value="{{ $user->phone }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <div class="text-right mr-20">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="flaticon-check"></i> Update User
        </button>
    </div>

{!! Form::close() !!}


<section class="mt-40">

    <form class="_form" action="{{ route('admin.password') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="container-fluid">
            <div class="block">
                <div class="block-content">
                    <h4>Update Password</h4>

                    <div class="row mt-20">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="password" name="password" required class="form-control input-lg" placeholder="New Password">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="password" name="password_confirm" required class="form-control input-lg" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-lg btn-success btn-block">
                                <i class="flaticon-lock"></i> Save New Password
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
</section>
@endsection
