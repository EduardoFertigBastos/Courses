<nav id="mainMenu">
    <ul>
        <li>
            <a href="{{ route('user.index') }}">
                <i class="fa fa-address-book"></i>
                <h3> Usuários </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('instituition.index') }}">
                <i class="fa fa-building"></i>
                <h3> Instituições </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('group.index') }}">
                <i class="fa fa-users"></i>
                <h3> Grupos </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.application') }}">
                <i class="fa fa-money"></i>
                <h3> Investir </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.getBack') }}">
                <i class="fa fa-money"></i>
                <h3> Resgatar </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.index') }}">
                <i class="fa fa-dollar"></i>
                <h3> Aplicações </h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.all') }}">
                <i class="fa fa-dollar"></i>
                <h3> Extrato </h3>
            </a>
        </li>
    </ul>
</nav>