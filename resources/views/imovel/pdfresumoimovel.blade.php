<html>

<head>

    <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />    


    <style>
    
    .dados-imoveis
        {
            text-align: center;
            color: #4682B4 ; 
            font-size: 16px;
            font-weight: bold;
        }

    .header-imob
        {
            text-align: center;
            color: #4682B4 ; 
            font-size: 20px;
            font-weight: bold;
        }


        .centro-16
    {
            text-align: center;
            color: #08056C ; 
            font-size: 14x;
            font-weight: bold;
            text-align: center;
        }

    .empresa-rodape
    {
            text-align: center;
            color: #000000 ; 
            font-size: 10x;
            font-weight: bold;
            text-align: center;
        }


</style>

</head>

<div class="container">
    <div class="header-imob">
        {{$imobiliaria[0]->IMB_IMB_NOME}}<br>
        Fone:{{$imobiliaria[0]->IMB_IMB_TELEFONE1}}
    </div>
<hr>
<div class="dados-imoveis">
    IMOVEL - {{$imovel[0]->TIPOIMOVEL}}
    Imóvel: {{$imovel[0]->IMB_IMV_REFERE }} - Bairro: {{$imovel[0]->CEP_BAI_NOME }} - Cidade: {{$imovel[0]->IMB_IMV_CIDADE}}
    @if ($imovel[0]->CONDOMINIO  <> '')
    <br>Condominio: {{$imovel[0]->CONDOMINIO}}
    @endif
</div>
<p>
<h4 class="centro-16"><u><b><u>Área Interna<b></u></h4>
    <div class="dados-imoveis">
    Domitórios: {{ $imovel[0]->IMB_IMV_DORQUA }}, sendo {{$imovel[0]->IMB_IMV_SUIQUA}} suíte(s)  
    @if($imovel[0]->IMB_IMV_DORAE == 'S')  -  Com Armário    @endif 
    @if($imovel[0]->IMB_IMV_SUIHID == 'S')  -  Com Hidro    @endif 
    @if( $imovel[0]->IMB_IMV_SALQUA <>'' )  -  Salas: {{$imovel[0]->IMB_IMV_SALQUA}}@endif 
    @if($imovel[0]->IMB_IMV_COZINHA == 'S')  -  Com Cozinha @endif
    @if($imovel[0]->IMB_IMV_PISCIN == 'S')  -  Com Piscina @endif
    @if($imovel[0]->IMB_IMV_CHURRA == 'S')  -  Com Churrasqueira @endif
    </div>
</p>

<h4 class="centro-16" >----------------------------------------------------------------------</h4>

<p>
<h4 class="centro-16" ><u><b><u>Medidas<b></u></h4>
<div class="dados-imoveis">
    Medida do Terreno: {{ $imovel[0]->IMB_IMV_MEDITER}} 
    - Área Constrúida: {{ $imovel[0]->IMB_IMV_ARECON}}m2 
    - Área Total: {{ $imovel[0]->IMB_IMV_ARETOT}}m2 
    - Área Útil: {{ $imovel[0]->IMB_IMV_AREUTI}}m2 
</div>
</p>
<h4 class="centro-16" >----------------------------------------------------------------------</h4>

<p>
    <h4 class="centro-16" ><u><b><u>Observações<b></u></h4>
    <div class="dados-imoveis">
        {{ $imovel[0]->IMB_IMV_OBSWEB}} 
    </div>
</p>

<h4 class="centro-16" >----------------------------------------------------------------------</h4>
@if(!empty($imagem))
    <h4 class="centro-16" ><u><b><u>Imagens<b></u></h4>
        @foreach ($imagem as $img)
        <div class="col-md-4">
            <a href="https://www.siriussystem.com.br/sys/storage/images/{{$imovel[0]->IMB_IMB_ID}}/imoveis/{{$img->IMB_IMV_ID}}/{{$img->IMB_IMG_ARQUIVO}}">
            <img src="https://www.siriussystem.com.br/sys/storage/images/{{$imovel[0]->IMB_IMB_ID}}/imoveis/thumb/{{$img->IMB_IMV_ID}}/100_75{{$img->IMB_IMG_ARQUIVO}}"></a>
        </div>
        @endforeach 
    </table>        
@endif
<br>
<br>
<hr>
<label class="empresa-rodape">
 {{$imobiliaria[0]->IMB_IMB_NOME}} - {{$imobiliaria[0]->IMB_IMB_ENDERECO}} {{$imobiliaria[0]->IMB_IMB_ENDERECONUMERO}}
  - {{$imobiliaria[0]->CEP_BA_NOME}} - Cep: {{$imobiliaria[0]->CEP_BAI_NOME}} - {{$imobiliaria[0]->CEP_CID_NOME}} 
</label>
</div>
</html>
