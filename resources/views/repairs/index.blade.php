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
	
	<!-- Button to Open the Modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#createRepair">
  Создать заявку на ремонт
</button>
<style>
input[type="search"] { 
padding: 3px;
background: white;
color: black;
border: 1px solid #ccc;
}
input:hover[type="search"] { 
padding: 3px;
background: whitesmoke;
color: black;
border: 1px solid #ccc;
}
th {
color : black;
}
.odd {
background-color: LavenderBlush;
}
.odd:hover { 
background-color: Bisque;
}
.even:hover { 
background-color: Bisque;
}
td { 
color : DarkSlateGrey;
}
label {
color: black;
}
</style>
<div class="container">
	<table id="repairs_table" class="table">
		<thead>
			<tr>
				<th>id</th>
				<th>Логин</th>
				<th>Объект</th>
				<th>Улица</th>
				<th>Дом</th>
				<th>Vlan</th>
				<th>Номер телефона</th>
				<th>Причина обращения</th>
				<th>Комментарий</th>
				<th>Дата создания</th>
				<th>Изменить</th>
			</tr>
			
		</thead>
</table>
</div>

@include('inc.repairCreateForm')
@include('inc.repairUpdateForm')

<script type="text/javascript">
	
    $(document).on( "click", ".update",function() {
			 //$('#updateRepair').modal('show');
			 var id = $(this).attr("id");
			 //alert(id);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ url('datablesRepairFindById') }}",
                        method:"POST",
                        data: {id:id} ,
                        dataType:"json",
                        success:function(data)
                        {
                            $('#updateRepair').modal('show');
                            //alert(data.toSource());
                            $('#login').val(data.login);
                            $('#object_id').val(data.object_id); 
                            $('#str').val(data.street);
                            $('#build').val(data.build);
                            $('#vlan_name').val(data.vlan_name);
                            $('#phone_num').val(data.phone_num);
                            $('#cause').val(data.cause);
                            $('#comment').val(data.cause);
                            $('#action').val(data.id);
                            $('#action_module').attr('action','/repairs/'+data.id);
                        }
                })
		});
	

	

</script>

	

	


@endsection

@section('dt_script')
	<script type="text/javascript">
		$(function() {
	        $('#repairs_table').DataTable({
	            processing: true,
	            serverSide: true,
	            ajax: '{{ url('datablesAllRepairs') }}',
	            //'id','login', 'object','street', 'build','vlan_name','phone_num', 'cause', 'created_at'
	            columns: [
	                                { data: 'id',               name: 'id' },
	                                { data: 'login',        name: 'login'},
	                                { data: 'object_id',           name: 'object_id' },
	                                { data: 'street',           name: 'street' },
	                                { data: 'build',            name: 'build' },
	                                { data: 'vlan_name',            name: 'vlan_name' },
	                                { data: 'phone_num',        name: 'phone_num'},
	                                
	                                //{ data: 'ticket_status_id', name: 'ticket_status_id'},
	                                { data: 'cause',          name: 'cause'},
	                                { data: 'comment',          name: 'comment'},
	                                { data: 'created_at',       name: 'created_at'},
	                                { data: 'action',           name: 'action', orderable: false, searchable: false}
	                            ]

	        });
    });
	</script> 
@endsection