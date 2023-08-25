@php echo "<?xml version='1.0' encoding='UTF-8'?>" @endphp

<Document>
    <imoveis>
        <?$contador=0;?>
        @foreach($imoveis as $imovel)
        <imovel>
            <referencia>{{ $imovel->IMB_IMV_REFERE }}</referencia>
            <codigo_cliente>{{ $imovel->IMB_IMV_REFERE }}</codigo_cliente>

            <titulo>
            @if( $imovel->CONDOMINIO) 
                 {{  $imovel->IMB_TIM_DESCRICAO . " no Bairro " . 
                    $imovel->CEP_BAI_NOME . " - Condominio ".$imovel->CONDOMINIO. " na cidade de  ".$imovel->IMB_IMV_CIDADE}};
            @else
                {{ $imovel->IMB_TIM_DESCRICAO . " no Bairro " . 
                    $imovel->CEP_BAI_NOME . " na cidade de  ".$imovel->IMB_IMV_CIDADE}}; 
            @endif 
            </titulo>
            @if( $imovel->IMB_IMV_VALLOC > 0 and $imovel->IMB_IMV_VALVEN > 0)
                <transacao>V</transacao>
                <transacao2>L</transacao2>
            @elseif ( $imovel->IMB_IMV_VALLOC > 0 )
                <transacao>L</transacao>
            @elseif ( $imovel->IMB_IMV_VALVEN > 0)
                <transacao>V</transacao>
            @endif

            
            @if( $imovel->IMB_IMV_FINALIDADE == 'Residencial')
                <finalidade>RE</finalidade>
                @if( $imovel->IMB_TIM_ID == 8  )
                    <tipo>Apartamento</tipo>
                @elseif( $imovel->IMB_TIM_ID == 2)
                    <tipo>Terreno</tipo>
                @elseif( $imovel->IMB_TIM_ID == 9 or $imovel->IMB_TIM_ID == 31 )
                    <tipo>Casa / Sobrado</tipo>
                @elseif( $imovel->IMB_TIM_ID == 16 )
                    <tipo>Casa / Sobrado em Condomínio</tipo>
                @elseif( $imovel->IMB_TIM_ID == 5 )
                    <tipo>Chácara</tipo>
                @elseif( $imovel->IMB_TIM_ID == 29 )
                    <tipo>Cobertura</tipo>
                @elseif( $imovel->IMB_TIM_ID == 17 )
                    <tipo>Flat</tipo>
                @elseif( $imovel->IMB_TIM_ID == 26 )
                    <tipo>Kitnet / Stúdio</tipo>
                @endif
            @endif
            @if( $imovel->IMB_IMV_FINALIDADE <> 'Residencial')
                <finalidade>CO</finalidade>
                @if( $imovel->IMB_TIM_ID == 1 or $imovel->IMB_TIM_ID == 33 )
                    <tipo>Barracão / Galpão</tipo>
                @elseif( $imovel->IMB_TIM_ID == 2 or 
                            $imovel->IMB_TIM_ID == 11 or 
                            $imovel->IMB_TIM_ID == 12 or 
                            $imovel->IMB_TIM_ID == 13 )
                    <tipo>Terreno comercial</tipo>
                @elseif( $imovel->IMB_TIM_ID == 4 or 
                            $imovel->IMB_TIM_ID == 10 or 
                            $imovel->IMB_TIM_ID == 15 or 
                            $imovel->IMB_TIM_ID == 18 )
                    <tipo>Conj. Comercial / Sala</tipo>
                @elseif( $imovel->IMB_TIM_ID == 25)
                    <tipo>Ponto Comercial</tipo>
                @elseif( $imovel->IMB_TIM_ID == 15 or 
                            $imovel->IMB_TIM_ID == 9 )
                    <tipo>Casa Comercial</tipo>

                @elseif( $imovel->IMB_TIM_ID == 27)
                    <tipo>Garagem</tipo>
                @endif

            @endif

            @if( $imovel->IMB_IMV_DESTAQUE == 'S' and $contador <= 5)
                <? $contador++;?>
                <destaque>1</destaque>

            @else
                <destaque>0</destaque>
            @endif


            
            @if( $imovel->IMB_IMV_VALVEN > 0 )            
                <valor>{{ $imovel->IMB_IMV_VALVEN }}</valor>
            @endif
            @if( $imovel->IMB_IMV_VALLOC > 0 )            
                <valor_locacao>{{ $imovel->IMB_IMV_VALLOC }}</valor_locacao>
            @endif
            @if($imovel->IMB_IMV_VALORIPTU)
                <valor_iptu>{{ $imovel->IMB_IMV_VALORIPTU }}</valor_iptu>
            @endif
            @if($imovel->IMB_IMV_VALORCONDOMINIO)
                <valor_condominio>{{ $imovel->IMB_IMV_VALORCONDOMINIO }}</valor_condominio>
            @endif
                        
            <area_total>{{ $imovel->IMB_IMV_ARETOT }}</area_total>
            <area_util>{{ $imovel->IMB_IMV_AREUTI }}</area_util>

            <quartos>{{ $imovel->IMB_IMV_DORQUA }}</quartos>
            <suites>{{ $imovel->IMB_IMV_SUIQUA }}</suites>
            <garagem>{{ $imovel->IMB_IMV_GARCOB }}</garagem>
            <banheiro>{{ $imovel->IMB_IMV_WCQUA }}</banheiro>
            <salas>{{ $imovel->IMB_IMV_SALQUA }}</salas>

            <estado>{{ $imovel->IMB_IMV_ESTADO }}</estado>
            <cidade>{{ $imovel->IMB_IMV_CIDADE }}</cidade>
            <bairro>{{ $imovel->CEP_BAI_NOME }}</bairro>
            <cep>{{ $imovel->IMB_IMV_ENDERECOCEP }}</cep>

            <descritivo>{{ $imovel->descritivo }}</descritivo>

            @if(count($imovel->imagens))
            <fotos_imovel>
                @foreach($imovel->imagens as $imagem)
                    <foto>
                        {{ url("storage/images/".$imovel->IMB_IMB_ID."/imoveis/".$imovel->IMB_IMV_ID . "/" . $imagem->IMB_IMG_ARQUIVO) }}
                    </foto>
                @endforeach
            </fotos_imovel>
            @endif
        </imovel>
        @endforeach
    </imoveis>
</Document>
