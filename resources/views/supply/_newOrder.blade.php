 <!-- Modal window UPDATE join -->
 <div class="modal fade" id="newOrder">
        <div class="modal-dialog">
            <div class="modal-content">      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Новый заказ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">  
                        {!! Form::open(['action' => 'SupplyController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row" id="content_blc">
                            <div class="col-sm-12">
                            <select name="city_name" id="">
                                <option value=0> Выбрать город</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Название товара</label>
                                <input name="item_name-1" type="text" class="form-control" placeholder="Название товара">
                            </div>
                            <div class="col-sm-2">
                                <label for="">Кол-во</label>
                                <input name="count-1" type="text" class="form-control" placeholder="11">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Описание</label>
                                <input name="description-1" type="text" class="form-control" placeholder="Для чего данный заказ">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">Составить заказ!</button>
                    {!! Form::close() !!}

                </div>      
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success"  id="buttonAddElements">Добавить предмет!</button>

                    <p>Все заказы проходят проверку. Все представленныве поля, обязательны к заполнению</p>
                </div>                
    
            </div>
        </div>
    </div>
    <script>
    var count = 2;
    buttonAddElements.addEventListener("click", function(){
        var input_ItemName = document.createElement('INPUT');
        var input_Count = document.createElement('INPUT');
        var input_Description = document.createElement('INPUT');
        input_ItemName.name = "item_name-" + count;
            input_ItemName.className = "form-control";
        input_Count.name = "count-" + count;
            input_Count.className = "form-control";
        input_Description.name = "description-" + count;
            input_Description.className = "form-control";
        var div_4 = document.createElement('div');
            div_4.className = "col-sm-4";
            div_4.id = "item_div";
        var div_2 = document.createElement('div');
            div_2.className = "col-sm-2";
            div_2.id = "count_div";
        var div_6 = document.createElement('div');
            div_6.className = "col-sm-6";
            div_6.id = "description_div";
        document.querySelector('#content_blc').appendChild(div_4);
            document.querySelector('#item_div').appendChild(input_ItemName);
        document.querySelector('#content_blc').appendChild(div_2);
            document.querySelector('#count_div').appendChild(input_Count);
        document.querySelector('#content_blc').appendChild(div_6);
            document.querySelector('#description_div').appendChild(input_Description);
        
        count++;
    });
    

    
    </script>