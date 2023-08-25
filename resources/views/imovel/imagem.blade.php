
<div>
    @foreach( $imagens as $img)
        <img src="/concreto/storage/images/imoveis/{{$img->IMB_IMG_ARQUIVO}}" height="768" width="1024">
    @endforeach
</div>