<ul class="nav nav-pills">
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

</ul>
