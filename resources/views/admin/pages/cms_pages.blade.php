@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Catalogues</h1>
          
          @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible rounded-0" style="margin-top: 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>{{ Session::get('success_message')}}</strong>
            </div>
          @endif

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">CMS Pages</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">CMS Pages</h3>
              <a href="{{  url('admin/add-edit-cms-page') }}" 
                style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add CMS Page</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Url</th>
                  <th>Created On</th>
                  <th>Status</th> 
                  <th>Action</th> 
                </tr>
                </thead>
                <tbody>
                @foreach($cms_pages as $page)  
                <tr>
                  <td>{{ $page->id }}</td>
                  <td>{{ $page->title }}</td>
                  <td>{{ $page->url }}</td>
                  <td>{{ $page->created_at }}</td>
                  <td>
                    @if($page->status==1)
                      <a class="updateCmsPageStatus" id="page-{{ $page->id }}" page_id="{{ $page->id }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i></a>
                    @else
                      <a class="updateCmsPageStatus" id="page-{{ $page->id }}" page_id="{{ $page->id }}" href="javascript:void(0)">
                      <i class="fas fa-toggle-off fa-lg" aria-hidden="true" status="Inactive"></i></a>  
                    @endif 
                  </td>
                  <td class="center">
                    <a title="Edit CMS Page" href="{{ url('admin/add-edit-cms-page/'.$page->id) }}"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;&nbsp; &nbsp;
                    <a title="Delete CMS Page" href="javascript:void(0)" class="confirmDelete" record="page" recordid="{{ $page->id }}"
                    <?php /*href="{{ url('admin/delete-page/'.$page->id) }}"*/ ?>>&nbsp;<i class="fas fa-trash-alt"></i></a> 
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Url</th>
                  <th>Created On</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection