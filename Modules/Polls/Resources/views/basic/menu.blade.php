<li class="{{ Request::is('admin/polls') ? 'active' : '' }} {{ Request::is('admin/polls/*') ? 'active' : '' }} treeview">
  <a href="javascript:;"><i class="{{trans('polls::menu.font_icon')}}"></i> <span>{{trans('polls::menu.sidebar.menu_title')}}</span>
   <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
   <li class="{{ Request::is('admin/polls') ? 'active' : '' }}"><a href="{{route('polls.index')}}"><i class="fa fa-list"></i> {{trans('polls::menu.sidebar.slug')}}</a></li>
   @can('polls.create')
    <li class="{{ Request::is('admin/polls/create') ? 'active' : '' }}"><a href="{{route('polls.create')}}"><i class="fa fa-plus"></i> {{trans('polls::menu.sidebar.create')}}</a></li>
   @endcan
  </ul>
</li>