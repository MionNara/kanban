@if (count($errors) > 0)
<!-- From Error List -->
<div class="alert alert-danger">
    <div><Strong>入力した文字を修正してください</Strong></div>
<div><ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach </ul></div></div>
@endif
