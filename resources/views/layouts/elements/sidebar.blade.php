<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{ asset('assets/img/user-13.jpg') }}" alt="" /></a>
                </div>
                <div class="info">
                    Sean Ngu
                    <small>Front end developer</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <!--<li class="nav-header">Navigation</li>-->
            <li class="active">
                <a href="javascript:;">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <span class="badge pull-right"></span>
                    <i class="fa fa-inbox"></i> 
                    <span>Admin Management</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{!! route('permissions.index') !!}">Permission</a></li>
                    <li><a href="{!! route('roles.index') !!}">Role</a></li>
                    <li><a href="{!! route('users.index') !!}">User - OnProgress</a></li>
                    <li><a href="{!! route('lookups.index') !!}">Lookup</a></li>
                    <li><a href="{!! route('units.index') !!}">Unit</a></li>
                    <li><a href="{!! route('cities.index') !!}">City</a></li>
                    <li><a href="{!! route('provinces.index') !!}">Province</a></li>
                    <li><a href="{!! route('subdistricts.index') !!}">Sub Disctrict</a></li>
                    <li><a href="{!! route('urbanvillages.index') !!}">Urban Village</a></li>
                </ul>
            </li>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->