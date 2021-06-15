@foreach ($contacts as $item)
    <tr>
        <td class="text-center">{{ $item->name }}</td>
        <td class="text-center">{{ $item->company }}</td>
        <td class="text-center">{{ $item->phone }}</td>
        <td class="text-center">{{ $item->email }}</td>
        <td class="text-center">
            <div class="btn-group" >
                <button type="button" class="btn btn-primary edit_contact" data-contact="{{ $item }}">Edit</button>
                <button type="button" class="btn btn-danger delete_contact" data-contact="{{ $item->id }}">Delete</button>
            </div>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="5" align="center">
     {{ $contacts->links() }}
    </td>
</tr>
