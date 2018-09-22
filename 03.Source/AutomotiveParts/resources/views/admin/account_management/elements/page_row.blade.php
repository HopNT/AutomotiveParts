<tr>
    <td>
        <label>
            @if(array_key_exists($memu->id, $pageSelected))
                <input name="mn_selected_list[{{$memu->id}}]" checked="checked" value="{{$memu->id}}" data-pageid="{{$memu->id}}" data-childs="{{$memu->getLstChildId($memu->pages)}}" data-parent="{{$memu->parent_id}}" type="checkbox" class="parent_{{$memu->parent_id}} ace cb">
            @else
                <input name="mn_selected_list[{{$memu->id}}]" data-pageid="{{$memu->id}}" data-parent="{{$memu->parent_id}}" data-childs="{{$memu->getLstChildId($memu->pages)}}" type="checkbox" class="parent_{{$memu->parent_id}} ace cb">
            @endif
            <span class="lbl"></span>
        </label>
    </td>
    <td class="level-{{$level}}">
        @if($level == 1)
            <b>{{$memu->function_name}}</b>
        @else
            {{$memu->function_name}}
        @endif
    </td>
    <td>{{$memu->description}}</td>
</tr>
