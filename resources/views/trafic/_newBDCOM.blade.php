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
                        <form action="/bdcomadd" method="POST">
                            {{ csrf_field() }}
                            <label for="info">Введите адрес BDCOM</label>
                            <input type="text" name="ipbdcom" id="article-ckeditor" class="form-control" placeholder="10.44.0.1"></input>
                    </div>
            </div>      
            <!-- Modal footer -->
            <div class="modal-footer">
                    <button type="submit" class="btn btn-success new-bdcom">Добавить BDCOM</button>
                </form> 
            </div>
        </div>
    </div>
</div>