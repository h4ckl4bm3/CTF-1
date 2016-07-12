@extends('app')

@section('title', '權限與角色')

@section('content')
    <div class="ui container">
        <h2 class="ui teal header center aligned">
            權限與角色
        </h2>
        <h3 class="ui header center aligned">權限清單</h3>
        <table class="ui selectable celled padded unstackable table">
            <thead>
            <tr style="text-align: center">
                <th class="single line">權限節點</th>
                @foreach($roles as $role)
                    <th class="single line">
                        {{ $role->display_name }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>
                        {{ $permission->display_name }}（{{ $permission->name }}）<br/>
                        <small><i class="angle double right icon"></i> {{ $permission->description }}</small>
                    </td>
                    @foreach($roles as $role)
                        <td class="text-center" style="text-align: center">
                            @if($permission->hasRole($role->name))
                                <i class="checkmark icon green large"></i>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <h3 class="ui header center aligned">角色清單</h3>
        @permission('role.manage')
        <a href="{{ route('role.create') }}" class="ui icon blue inverted button"><i class="plus icon" aria-hidden="true"></i> 新增角色</a>
        @endpermission
        <table class="ui selectable celled padded unstackable table">
            <thead>
            <tr style="text-align: center">
                <th class="single line">角色</th>
                <th class="single line">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>
                        {{ $role->display_name }}（{{ $role->name }}）<br/>
                        <small><i class="angle double right icon"></i> {{ $role->description }}</small>
                    </td>
                    <td class="four wide">
                        @permission('role.manage')
                        @unless($role->name == 'admin')
                            <a href="{{ route('role.edit', $role) }}" class="ui icon button blue"><i class="edit icon"></i> 編輯角色</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['role.destroy', $role],
                                'style' => 'display: inline',
                                'onSubmit' => "return confirm('確定要刪除此角色嗎？');"
                            ]) !!}
                            <button type="submit" class="ui icon button red">
                                <i class="trash icon"></i> 刪除角色
                            </button>
                            {!! Form::close() !!}
                        @endunless
                        @endpermission
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection