<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Auth::guard('admin')->user()->PicturePath}}" class="img-circle" alt="User Image" style="height: 35px;width: 35px;" />
            </div>
            <div class="pull-left info">
                <p>{{ucfirst(Auth::guard('admin')->user()->FullName)}} <a href="javascript:;"><i class="fa fa-circle text-success"></i></a></p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navigation Menu</li>
            @can('backend.dashboard')
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{route('backend.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @endcan
            {{--
            @if(Auth::user()->hasAnyPermissionCustom(['roles.index','permissions.index'],'admin'))
            <li class="{{ Request::is('admin/roles*') ? 'active' : '' }} {{ Request::is('admin/permission*') ? 'active' : '' }} {{ Request::is('admin/email-templates*') ? 'active' : '' }} treeview">
                <a href="javascript:;">
                    <i class="fa fa-sort-amount-desc"></i> <span>Site Managment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                @can('roles.index')
                    @if(\Module::collections()->has('Roles'))
                        @include('roles::basic.menu')
                    @endif 
                @endcan
                @can('permissions.index')
                    @if(\Module::collections()->has('Permissions'))
                        @include('permissions::basic.menu')
                    @endif
                @endcan
                </ul>
            </li>
            @endif
            --}}
            @can('polls.index')
                @if(\Module::collections()->has('Polls'))
                    @include('polls::basic.menu')
                @endif
            @endcan
        </ul>
    </section>
</aside>
<!-- Global model for ajax -->
<div class="modal fade" id="globalModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modelContent">
            <!-- dynamic content goes here  -->
        </div>
    </div>
</div>

