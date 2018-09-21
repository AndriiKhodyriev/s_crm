@extends('layouts.app')    

@section('content')
    <div class="container">
        <H1>Новая заявка на подключение</H1>
        <a href="/joins/create" class="btn btn-primary">Составить заявку</a>
    </div>
            <table id="joins_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
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
@endsection
@section('dt_script')
            <script type="text/javascript">
                $(function() {
                    $('#joins_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('datablesAllJoins') }}',
                    columns: [
                                { data: 'id',               name: 'id' },
                                { data: 'street',           name: 'street' },
                                { data: 'build',            name: 'build' },
                                { data: 'full_name',        name: 'full_name'},
                                { data: 'phone_num',        name: 'phone_num'},
                                { data: 'created_at',       name: 'created_at'},
                                { data: 'ticket_status_id', name: 'ticket_status_id'},
                                { data: 'comment',          name: 'comment'},
                                { data: 'action',           name: 'action', orderable: false, searchable: false}
                            ]
                    });
                });
            </script>
@endsection
    
