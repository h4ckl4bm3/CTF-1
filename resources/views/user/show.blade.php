@extends('app')

@section('title', "{$user->name} - 會員資料")

@section('css')
    <style>
        /* TODO: 看要置左還是置中，然後看要不要抽出來做*/
        @media only screen and (max-width: 767px) {
            td {
                text-align: center !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="ui container">
        <h2 class="ui teal header center aligned">
            {{ $user->name }} - 會員資料
        </h2>
        {{-- TODO: 麵包屑抽出來（建議）--}}
        <div class="ui grey message">
            <div class="ui breadcrumb">
                <div class="section">現在位置：</div>
                <a class="section">{{ link_to_route('user.index', '會員清單') }}</a>
                <i class="right arrow icon divider"></i>
                <div class="active section">會員資料</div>
                <i class="right arrow icon divider"></i>
                <div class="active section">{{ $user->name }}</div>
            </div>
        </div>
        <div class="ui header center aligned">
            {{-- Gravatar大頭貼 --}}
            <a href="https://zh-tw.gravatar.com/" target="_blank" title="透過Gravatar更換照片"
               class="ui medium circular image">
                <img src="{{ Gravatar::src($user->email, 200) }}" class="ui image" id="gravatar"/></a><br/>
        </div>

        <table class="ui selectable stackable table">
            <tr>
                <td class="four wide right aligned">名稱：</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="right aligned">Email：</td>
                <td>
                    {{ $user->email }}
                    @if (!$user->isConfirmed)
                        <i class="warning sign icon red" title="尚未完成信箱驗證"></i>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="right aligned">角色：</td>
                <td>
                    @foreach($user->roles as $role)
                        {{ $role->display_name }}<br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="four wide right aligned">註冊時間：</td>
                <td>{{ $user->register_at }}</td>
            </tr>
            <tr>
                <td class="right aligned">註冊IP：</td>
                <td>{{ $user->register_ip }}</td>
            </tr>
            <tr>
                <td class="right aligned">最後登入時間：</td>
                <td>{{ $user->last_login_at }}</td>
            </tr>
            <tr>
                <td class="right aligned">最後登入IP：</td>
                <td>{{ $user->last_login_ip }}</td>
            </tr>
        </table>

        {{-- TODO: text-align: center要獨立成一個text-center --}}
        <div style="text-align: center">
            <a href="{{ route('user.index') }}" class="ui blue basic icon button"><i class="arrow left icon"></i>
                會員清單</a>
            <a href="{{ route('user.edit', $user) }}" class="ui brown basic icon button"><i class="edit icon"></i> 編輯資料</a>
            {!! Form::open(['route' => ['user.destroy', $user], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除此會員嗎？');"]) !!}
            <button type="submit" class="ui icon button red basic">
                <i class="trash icon"></i> 刪除會員
            </button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
