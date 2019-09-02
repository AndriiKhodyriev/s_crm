 <!-- Modal window create new join -->
 <div class="modal fade" id="newBDCOM">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Добавить новую BDCOM</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('info', 'Введите адрес BDCOM ')}}
                        {{Form::textarea('ipbdcom','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '10.44.0.1'])}}
                    </div>
            </div>      
            <!-- Modal footer -->
            <div class="modal-footer">
                    {{Form::submit('Составить заявку!', ['class' => 'btn btn-success'])}}
                    {!! Form::close() !!}
            </div>
                
        </div>
    </div>
</div>