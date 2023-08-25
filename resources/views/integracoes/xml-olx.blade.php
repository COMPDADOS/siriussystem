@php echo "<?xml version='1.0' encoding='UTF-8'?>" @endphp

<Carga xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
    <Imoveis>
        @foreach($imoveis as $imovel)
        <Imovel>
            <CodigoImovel>{{ $imovel->IMB_IMV_REFERE }}</CodigoImovel>
            <TituloAnuncio>
                @if( $imovel->CONDOMINIO)     
                    {{  $imovel->IMB_TIM_DESCRICAO . " no Bairro " . 
                        $imovel->CEP_BAI_NOME . " - Condominio ".$imovel->CONDOMINIO. " na cidade de  ".$imovel->IMB_IMV_CIDADE}};
                @else
                    {{ $imovel->IMB_TIM_DESCRICAO . " no Bairro " . 
                        $imovel->CEP_BAI_NOME . " na cidade de  ".$imovel->IMB_IMV_CIDADE}}; 
                @endif
            </TituloAnuncio>
            
            <TipoImovel>{{$imovel->OLX_SUBTIPO_IMOVEL}}</TipoImovel>
            <SubTipoImovel>{{ $imovel->OLX_SUBTIPO_IMOVEL }}</SubTipoImovel>
            <Cidade>{{ $imovel->IMB_IMV_CIDADE }}</Cidade>
            <Bairro>{{ $imovel->CEP_BAI_NOME }}</Bairro>
            <CEP>{{ $imovel->IMB_IMV_ENDERECOCEP }}</CEP>
            <TipoOferta>{{ $imovel->TIPOOFERTA }}</TipoOferta>
            <QtdBanheiros>{{ $imovel->IMB_IMV_WCQUA }}</QtdBanheiros>
            <PrecoVenda>{{ $imovel->IMB_IMV_VALVEN }}</PrecoVenda>
            <PrecoLocacao>{{ $imovel->IMB_IMV_VALLOC }}</PrecoLocacao>
            @if($imovel->IMB_IMV_VALORCONDOMINIO)
            <PrecoCondominio>{{ $imovel->IMB_IMV_VALORCONDOMINIO }}</PrecoCondominio>
            @endif
            @if($imovel->IMB_IMV_VALORIPTU)
            <ValorIPTU>{{ $imovel->IMB_IMV_VALORIPTU }}</ValorIPTU>
            @endif
            <AreaUtil>{{ $imovel->IMB_IMV_AREUTI }}</AreaUtil>
            <AreaTotal>{{ $imovel->IMB_IMV_ARETOT }}</AreaTotal>


            <Observacao>{{ $imovel->IMB_TIM_DESCRICAO . " em " . $imovel->CEP_BAI_NOME . " - " . $imovel->IMB_IMV_CIDADE . "\n" . $imovel->IMB_IMV_OBSWEB }}</Observacao>

            <QtdDormitorios>{{ $imovel->IMB_IMV_DORQUA }}</QtdDormitorios>

            <?php /* Subcategoria Casas OLX_SUBTIPO_VARIACAO = 1 */ ?>
            @if($imovel->OLX_SUBTIPO_VARIACAO == 1)
                <QtdVagas>{{ $imovel->IMB_IMV_GARDES + $imovel->IMB_IMV_GARCOB + 0 }}</QtdVagas>
            @endif

            <?php /* Subcategoria Apartamentos OLX_SUBTIPO_VARIACAO = 2 */ ?>
            @if($imovel->OLX_SUBTIPO_VARIACAO == 2)
                <QtdVagas>{{ $imovel->IMB_IMV_GARDES + $imovel->IMB_IMV_GARCOB + 0 }}</QtdVagas>
                <Piscina>{{ $imovel->IMB_IMV_PISCIN == "S" ? 1 : 0 }}</Piscina>
                <SalaoFestas>{{ $imovel->IMB_IMV_SALFES == "S" ? 1 : 0 }}</SalaoFestas>
                <Churrasqueira>{{ $imovel->IMB_IMV_CHURRA == "S" ? 1 : 0 }}</Churrasqueira>
                <QuartoWCEmpregada>{{ $imovel->IMB_IMV_EMPQUA }}</QuartoWCEmpregada>
            @endif

            <?php /* Subcategoria Terrenos, sítios e fazendas OLX_SUBTIPO_VARIACAO = 3 */ ?>
            @if($imovel->OLX_SUBTIPO_VARIACAO == 3)
            @endif

            <?php /* Subcategoria Comércio e Indústria OLX_SUBTIPO_VARIACAO = 4 */ ?>
            @if($imovel->OLX_SUBTIPO_VARIACAO == 3)
                <AreaUtil>{{ $imovel->IMB_IMV_AREUTI }}</AreaUtil>
                <QtdVagas>{{ $imovel->IMB_IMV_GARDES + $imovel->IMB_IMV_GARCOB + 0 }}</QtdVagas>
            @endif

            @if(count($imovel->imagens))
            <Fotos>
                @foreach($imovel->imagens as $imagem)
                    <Foto>
                        @if( $imagem->IMB_IMG_PRINCIPAL == 'S' )
                            <Principal>1</Principal>
                        @endif
                        <URLArquivo>{{ url("storage/images/".$imovel->IMB_IMB_ID."/imoveis/".$imovel->IMB_IMV_ID . "/" . $imagem->IMB_IMG_ARQUIVO) }}</URLArquivo>
                    </Foto>
                @endforeach

            </Fotos>
            @endif
        </Imovel>
        @endforeach
    </Imoveis>
</Carga>
