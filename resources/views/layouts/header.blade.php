<!-- Main header -->
<div class="main-header row">
    <div class="col-sm-6 col-xs-7">

        <!-- User info -->
        <ul class="user-info pull-left">
            <li class="profile-info dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                    @if (auth('admin')->check())
                        {{auth('admin')->user()->name}}
                    @elseif(auth('callcenter')->check())
                        {{auth('callcenter')->user()->name}}
                    @else
                        {{auth('web')->user()->name}}
                    @endif

                    <span class="caret"></span>
                </a>
            </li>
        </ul>
        <!-- /user info -->

    </div>

    <div class="col-sm-6 col-xs-5">
        <div class="pull-right">
            <ul class="user-info pull-left">

                <!-- Notifications -->
                 <notify></notify>
                <!-- /notifications -->
            </ul>
        </div>
    </div>
</div>
<!-- /main header -->
