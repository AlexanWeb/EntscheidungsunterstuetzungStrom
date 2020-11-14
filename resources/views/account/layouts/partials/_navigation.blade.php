<ul class="nav flex-column nav-pills">

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account'), 'active')}}" href="{{route('account.index')}}">
            <span data-feather="user"></span>
            Account overview</a>

    </li>
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/profile'), 'active')}}" href="{{route('profile.index')}}">
            <span data-feather="user"></span>
            Profile overview</a>

    </li>


    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/password'), 'active')}}" href="{{route('password.index')}}">
            <span data-feather="edit"></span>
            Change Password</a>

    </li>
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/deactivate'), 'active')}}" href="{{route('deactivate.index')}}">
            <span data-feather="lock"></span>
            Deactivate Password</a>

    </li>

    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/tokens'), 'active')}}" href="{{route('token.index')}}">
            <span data-feather="settings"></span>
            API Tokens</a>

    </li>
    @admin
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('admin/impersonate'), 'active')}}" href="{{route('admin.impersonate.index')}}">
            <span data-feather="user-check"></span>
            Impersonate User</a>

    </li>
    @endadmin

</ul>

<hr>
<ul class="nav flex-column nav-pills">

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account/powerplant/show'), 'active')}}" href="{{route('powerplant.show')}}">
            <span data-feather="database"></span>
            Show Power plant</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account/powerplant'), 'active')}}" href="{{route('powerplant.index')}}">
            <span data-feather="plus"></span>
            Add Power Plant</a>

    </li>


    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('chart/input'), 'active')}}" href="{{ route('chart.input')}}">
            <span data-feather="bar-chart-2"></span>
            Chart</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if((on_page('chart/boxplot/input') || on_page('chart/boxplot' )), 'active')}}"
           href="{{ route('chart.input_boxplot') }}">
            <span data-feather="pie-chart"></span>
            Box-Plot</a>

    </li>

    @admin
    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('admin/import'), 'active')}}" href="{{ route('admin.import') }}">
            <span data-feather="upload"></span>
            Import Data</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('admin/users'), 'active')}}" href="{{ route('admin.users') }}">
            <span data-feather="users"></span>
            Users</a>

    </li>
    @endadmin
</ul>

