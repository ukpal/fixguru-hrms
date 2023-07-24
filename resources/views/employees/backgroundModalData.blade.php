<table class="table table-hover">
    <tr>
        <td><strong>Verification Type:</strong></td>
        <td>{{$data->type}}</td>
    </tr>
    <tr>
        <td><strong>Verification Proof:</strong></td>
        <td>
           <img src="{{asset('uploads/background_verification/'.$data->proof)}}" alt="document" width="200"> <br>
           <a href="{{asset('uploads/background_verification/'.$data->proof)}}" download class="mx-auto">Download File</a>
        </td>
    </tr>
    <tr>
        <td><strong>Remarks:</strong></td>
        <td>{{$data->remarks}}</td>
    </tr>
</table>