@extends('layouts.app')

@section('content')
	<div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> Для составления заявки нажмите на кнопку "Составить заявку"</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
            <!--/ TITLE -->
            <!-- END OF BREADCRUMB -->
<div class="content-wrap">
	<h1>Ремонты<h1>
	<br>
	<!-- Button to Open the Modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
  Создать заявку на ремонт
</button>
<table id="repairs-table" class="table">
		<thead>
			<tr>
				<th>id</th>
				<th>Логин</th>
				<th>Объект</th>
				<th>Улица</th>
				<th>Дом</th>
				<th>Причина обращения</th>
				<th>Дата создания</th>
			</tr>
			
		</thead>
</table>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Заявка на ремонт</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        {!! Form::open(['action' => 'RepairsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            {{Form::label('login', 'Логин')}}
            {{Form::text('login','',['class' => 'form-control', 'placeholder' => 'Логин'])}}
        </div>
        <div class="form-group">
            {{Form::label('object_id', 'Объект')}}
            {{Form::text('object_id','',['class' => 'form-control', 'placeholder' => 'Объект'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('street', 'Улица')}}
            {{Form::text('street','',['class' => 'form-control', 'placeholder' => 'Ульяновская ул.'])}}
        </div>
        <div class="form-group">
                {{Form::label('build', 'Дом')}}
                {{Form::text('build','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '23Д'])}}
        </div>
        <div class="form-group">
            {{Form::label('vlan_name', 'VLAN')}}
            {{Form::text('vlan_name','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '12'])}}
         </div>
         <div class="form-group">
            {{Form::label('phone_num', 'Номер телефона')}}
            {{Form::text('phone_num','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '+380501234567'])}}
         </div>
         <div class="form-group">
            {{Form::label('cause', 'Причина составления заявки')}}
            {{Form::textarea('cause','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Что болит, на что жалуется'])}}
         </div>
         <div class="form-group">
            {{Form::label('comment', 'Комментарий')}}
            {{Form::textarea('comment','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Тут можно указать любой комментарий по текущей заявке'])}}
         </div>
         
        {{Form::submit('Составить заявку на ремонт!', ['class' => 'btn btn-warning'])}}
        {!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
      </div>

    </div>
  </div>
</div>



	

	


@endsection

@section('dt_script')
	<script type="text/javascript">
		$(function() {
	        $('#repairs-table').DataTable({
	            processing: true,
	            serverSide: true,
	            ajax: '{{ url('datablesAllRepairs') }}',
	            columns: [
	                                { data: 'id',               name: 'id' },
	                                { data: 'login',        name: 'login'},
	                                { data: 'street',           name: 'street' },
	                                { data: 'build',            name: 'build' },
	                                
	                                { data: 'phone_num',        name: 'phone_num'},
	                                { data: 'created_at',       name: 'created_at'},
	                                //{ data: 'ticket_status_id', name: 'ticket_status_id'},
	                                { data: 'cause',          name: 'cause'}
	                                //{ data: 'action',           name: 'action', orderable: false, searchable: false}
	                            ]

	        });
    });
	</script> 
@endsection