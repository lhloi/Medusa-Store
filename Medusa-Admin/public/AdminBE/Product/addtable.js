$(document).on('click','.addrow',function(){
    var tr = `<tr>
                <td>
                    <select class="form-control" name="color[]">
                        @foreach ($color as $data )
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="size[]">
                        @foreach ($size as $data )
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control col-3" name="quantity[]" placeholder="Số Lượng">
                </td>
                <td>
                    <a href="javascriptp:;" class="btn btn-block btn-sm btn-danger deleteRow">X</a>
                </td>
            </tr>`;
            $('tbody').append(tr);
})
$('tbody').on('click','.deleteRow',function(){
    $(this).parent().parent().remove();
})
