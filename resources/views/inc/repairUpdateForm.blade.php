<!-- The Modal -->
<div class="modal fade" id="updateRepair">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Редактировать заявку на ремонт</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        {!! Form::open(['id' => 'action_module', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            {{Form::label('login', 'Логин')}}
            {{Form::text('login','',['class' => 'form-control', 'id' => 'username'])}}
        </div>
        <div class="form-group">
            {{Form::label('object_id', 'Объект')}}
            {{Form::text('object_id','',['class' => 'form-control', 'id' => 'arrea_id', 'placeholder' => 'Объект'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('street', 'Улица')}}
            {{Form::text('street','',['class' => 'form-control', 'id' => 'str', 'placeholder' => 'Ульяновская ул.'])}}
        </div>
        <div class="form-group">
                {{Form::label('build', 'Дом')}}
                {{Form::text('build','',['class' => 'form-control', 'id' => 'build', 'placeholder' => '23Д'])}}
        </div>
        <div class="form-group">
            {{Form::label('vlan_name', 'VLAN')}}
            {{Form::text('vlan_name','',['class' => 'form-control', 'id' => 'vlan_name', 'placeholder' => '12'])}}
         </div>
         <div class="form-group">
            {{Form::label('phone_num', 'Номер телефона')}}
            {{Form::text('phone_num','',['class' => 'form-control', 'id' => 'phone_num', 'placeholder' => '+380501234567'])}}
         </div>
         <div class="form-group">
            {{Form::label('cause', 'Причина составления заявки')}}
            {{Form::textarea('cause','',['class' => 'form-control', 'id' => 'cause', 'placeholder' => 'Что болит, на что жалуется'])}}
         </div>
         <div class="form-group">
            {{Form::label('comment', 'Комментарий')}}
            {{Form::textarea('comment','',['class' => 'form-control', 'id' => 'comment', 'placeholder' => 'Тут можно указать любой комментарий по текущей заявке'])}}
         </div>
         
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Редактировать заявку на ремонт!', ['class' => 'btn btn-warning'])}}
        {!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
      </div>

    </div>
  </div>
</div>