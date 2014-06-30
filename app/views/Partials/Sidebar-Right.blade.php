<!-- Begin sidebar column -->
<div class="span4 sidebar page-right-sidebar">


  @section('sidebar-right')

@include('Partials.Sidebar.LoginTabs')

<p>
@include('Partials.Sidebar.Twitter')
</p>

<p>
@include('Partials.Sidebar.News')
</p>
  @show


        </div>
<!-- End sidebar column -->
