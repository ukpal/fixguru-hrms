<table class="table table-hover">
    <tr>
        <td><strong>Document Name:</strong></td>
        <td>{{$data->name}}</td>
    </tr>
    <tr>
        <td><strong>Document File:</strong></td>
        <td>
           <img src="{{asset('uploads/emp_documents/'.$data->document)}}" alt="document" width="200"> <br>
           <a href="{{asset('uploads/emp_documents/'.$data->document)}}" download class="mx-auto">Download File</a>
        </td>
    </tr>
    <tr>
        <td><strong>Remarks:</strong></td>
        <td>{{$data->remarks}}</td>
    </tr>
</table>