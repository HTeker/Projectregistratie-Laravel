<?php
    $account = Auth::user();
?>

<nav class="uk-navbar uk-margin-large-bottom">
    <a class="uk-navbar-brand uk-hidden-small" href="/">Project 3</a>
    <ul class="uk-navbar-nav uk-hidden-small">
        <!-- Dropdown -->
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Voeg toe <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects/create', 'Project')}}</li>
                    <li>{{ HTML::link('students/create', 'Leerling')}}</li>
                    <li>{{ HTML::link('classrooms/create', 'Klas')}}</li>
                    <li>{{ HTML::link('cohorts/create', 'Cohort')}}</li>
                    <li>{{ HTML::link('crebos/create', 'Crebo')}}</li>
                    <li>{{ HTML::link('teachers/create', 'Docent')}}</li>
                    <li>{{ HTML::link('ratings/create', 'Beoordeling')}}</li>
                    <li class="uk-nav-divider"></li>
                    <li>{{ HTML::link('accounts/create', 'Account')}}</li>
                </ul>
            </div>
        </li>
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Wijzig <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects/edit', 'Project')}}</li>
                    <li>{{ HTML::link('students/edit', 'Leerling')}}</li>
                    <li>{{ HTML::link('classrooms/edit', 'Klas')}}</li>
                    <li>{{ HTML::link('cohorts/edit', 'Cohort')}}</li>
                    <li>{{ HTML::link('crebos/edit', 'Crebo')}}</li>
                    <li>{{ HTML::link('teachers/edit', 'Docent')}}</li>
                    <li>{{ HTML::link('ratings/edit', 'Beoordeling')}}</li>
                    <li class="uk-nav-divider"></li>
                    <li>{{ HTML::link('accounts/edit', 'Account')}}</li>
                </ul>
            </div>
        </li>
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Verwijder <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects/delete', 'Project')}}</li>
                    <li>{{ HTML::link('students/delete', 'Leerling')}}</li>
                    <li>{{ HTML::link('classrooms/delete', 'Klas')}}</li>
                    <li>{{ HTML::link('cohorts/delete', 'Cohort')}}</li>
                    <li>{{ HTML::link('crebos/delete', 'Crebo')}}</li>
                    <li>{{ HTML::link('teachers/delete', 'Docent')}}</li>
                    <li>{{ HTML::link('ratings/delete', 'Beoordeling')}}</li>
                    <li class="uk-nav-divider"></li>
                    <li>{{ HTML::link('accounts/delete', 'Account')}}</li>
                </ul>
            </div>
        </li>
        <!-- This is the container enabling the JavaScript -->
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Bekijk alle <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects', 'Projecten') }}</li>
                    <li>{{ HTML::link('students', 'Leerlingen') }}</li>
                    <li>{{ HTML::link('classrooms', 'Klassen') }}</li>
                    <li>{{ HTML::link('cohorts', 'Cohorten') }}</li>
                    <li>{{ HTML::link('crebos', "Crebo's") }}</li>
                    <li>{{ HTML::link('teachers', 'Docenten') }}</li>
                    <li>{{ HTML::link('ratings', 'Beoordelingen') }}</li>
                    <li class="uk-nav-divider"></li>
                    <li>{{ HTML::link('accounts', 'Accounts') }}</li>
                </ul>
            </div>
        </li>
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Zoeken per <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects/searchByCompleted', 'Afgeronde project') }}</li>
                    <li>{{ HTML::link('projects/searchByClassroom', 'Klas') }}</li>
                    <li>{{ HTML::link('projects/searchByStudent', 'Leerling') }}</li>
                </ul>
            </div>
        </li>
        <li class="uk-parent" data-uk-dropdown="">
            <a href="">Projecten <i class="uk-icon-caret-down"></i></a>

            <div class="uk-dropdown uk-dropdown-navbar">
                <ul class="uk-nav uk-nav-navbar">
                    <li>{{ HTML::link('projects/assign', 'Wijs een project toe') }}</li>
                    <li>{{ HTML::link('projects/rate', 'Beoordeel project') }}</li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            <div class="uk-navbar-content">Ingelogd als {{ $account->voornaam }} {{ $account->tussenvoegsel }} {{ $account->achternaam }} </div>
            <li>
                <li>{{ HTML::link('/logout', 'Log uit') }}</li>
            </li>
        </ul>
    </div>
    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
    <div class="uk-navbar-brand uk-navbar-center uk-visible-small">Brand</div>
</nav>