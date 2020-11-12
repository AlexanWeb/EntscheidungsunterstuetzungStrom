<ul class="nav flex-column nav-pills">

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account'), 'active')}}" href="{{route('account.index')}}">Account overview</a>

    </li>
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/profile'), 'active')}}" href="{{route('profile.index')}}">Profile overview</a>

    </li>


    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/password'), 'active')}}" href="{{route('password.index')}}">Change Password</a>

    </li>
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/deactivate'), 'active')}}" href="{{route('deactivate.index')}}">Deactivate Password</a>

    </li>

    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('account/tokens'), 'active')}}" href="{{route('token.index')}}">API Tokens</a>

    </li>
    @admin
    <li class="nav-item">

        <a class="nav-link {{return_if(on_page('admin/impersonate'), 'active')}}" href="{{route('admin.impersonate.index')}}">Impersonate User</a>

    </li>
    @endadmin

</ul>

<hr>
<ul class="nav flex-column nav-pills">

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account/powerplant/show'), 'active')}}" href="{{route('powerplant.show')}}">Show Power plant</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('account/powerplant'), 'active')}}" href="{{route('powerplant.index')}}">Add Power Plant</a>

    </li>


    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('chart/input'), 'active')}}" href="{{ route('chart.input') }}">Chart</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if((on_page('chart/boxplot/input') || on_page('chart/boxplot' )), 'active')}}"
           href="{{ route('chart.input_boxplot') }}">Box-Plot</a>

    </li>

    @admin
    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('admin/import'), 'active')}}" href="{{ route('admin.import') }}">Import Data</a>

    </li>

    <li class="nav-item ">

        <a class="nav-link {{return_if(on_page('admin/users'), 'active')}}" href="{{ route('admin.users') }}">Users</a>

    </li>
    @endadmin
</ul>
