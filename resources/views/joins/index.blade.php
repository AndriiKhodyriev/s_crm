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
                <hr>
            <div class="row">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newJoinModal">
                            Составить заявку
                    </button> | 
                <div class="btn-group" position="rigth">

                    <button class="btn btn-warning btn-select" id="1">Новые заявки</button>
                    <button class="btn btn-danger btn-select" id="2">В работе</button>
                    <button class="btn btn-info btn-select" id="3">Закрытые</button>
                </div>
            </div>
        <hr>
            <table id="joins_table" class="table ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Город</th>
                        <th>Улица</th>
                        <th>Дом</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Дата составления заявки</th>
                        <th>Статус заявки</th>
                        <th>Комментарий</th>
                        <th>action</th>
                    </tr>
            </table>
            {{-- INCLUDE modal windows --}}
   @include('joins._formNew')
   @include('joins._formEdit')
        <!-- Update button -->
        <script>
            $(document).on('click', '.update', function(){
                var id = $(this).attr("id");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ url('datablesFindById') }}",
                        method:"POST",
                        data: {id:id} ,
                        dataType:"json",
                        success:function(data)
                        {
                            $('#updateJoin').modal('show');
                            $('#str').val(data.street);
                            $('#build').val(data.build);
                            $('#full_name').val(data.full_name);
                            $('#phone_num').val(data.phone_num);
                            $('#comment').val(data.comment);
                            $('#action').val(data.id);
                            $('#action_module').attr('action','/joins/'+data.id);
                        }
                })
            });
        </script>
        {{--  --}}
        <script type="text/javascript">
                $(document).on('click', '.btn-select', function(){  
                    var id = $(this).attr("id");
                    var url ='/datatablesFindByTicketStatusId/'+id;
                    var table = $('#joins_table').DataTable();
                    table.destroy();
                     $(function() {
                    $('#joins_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: url,
                    columns: [
                                { data: 'id',               name: 'id' },
                                { data: 'city_name',      name: 'city_name'},
                                { data: 'street',           name: 'street' },
                                { data: 'build',            name: 'build' },
                                { data: 'full_name',        name: 'full_name'},
                                { data: 'phone_num',        name: 'phone_num'},
                                { data: 'created_at',       name: 'created_at'},
                                { data: 'status_name',      name: 'status_name'},
                                { data: 'comment',          name: 'comment'},
                                { data: 'action',           name: 'action', orderable: false, searchable: false}
                            ]
                    });
                });
            });
            </script>
@endsection
@section('dt_script')
        <!-- DataTables loader -->
            <script type="text/javascript">
                $(function() {
                    $('#joins_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('datablesAllJoins') }}',
                    columns: [
                                { data: 'id',               name: 'id' },
                                { data: 'city_name',      name: 'city_name'},
                                { data: 'street',           name: 'street' },
                                { data: 'build',            name: 'build' },
                                { data: 'full_name',        name: 'full_name'},
                                { data: 'phone_num',        name: 'phone_num'},
                                { data: 'created_at',       name: 'created_at'},
                                { data: 'status_name',      name: 'status_name'},
                                { data: 'comment',          name: 'comment'},                               
                                { data: 'action',           name: 'action', orderable: false, searchable: false}
                            ]
                    });
                });

                // <!-- edit form button -->
                $(document).on('click', '.update', function(){
                var id = $(this).attr("id");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ url('datablesFindById') }}",
                        method:"POST",
                        data: {id:id} ,
                        dataType:"json",
                        success:function(data)
                        {
                            $('#updateJoin').modal('show');
                            $('#str').val(data.street);
                            $('#build').val(data.build);
                            $('#full_name').val(data.full_name);
                            $('#phone_num').val(data.phone_num);
                            $('#comment').val(data.comment);
                            $('#action').val(data.id);
                            $('#action_module').attr('action','/joins/'+data.id);
                        }
                })
            });
            </script>
        
@endsection
    