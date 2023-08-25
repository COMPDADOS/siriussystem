@php echo "<?xml version='1.0' encoding='UTF-8'?>" @endphp
        <ListingDataFeed xmlns="http://www.vivareal.com/schemas/1.0/VRSync"
                 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                 xsi:schemaLocation="http://www.vivareal.com/schemas/1.0/VRSync  http://xml.vivareal.com/vrsync.xsd">
                <Header>
                        <Provider>Sirius System ERP e CRM</Provider>
                        <Email>suporte@compdados.com.br</Email>
                        <ContactName>{{env('MAIL_FROM_ADDRESS')}}</ContactName>
                        <PublishDate>{{date('Y-m-d')}}T{{date('H:i:s')}}</PublishDate>
                        <Telephone>14 991857709</Telephone>
                </Header>
                <Listings>

                        @foreach( $imoveis as $imovel )
                        @php
                                $tim = app( 'App\Http\Controllers\ctrTipoImovel')->buscar( $imovel->IMB_TIM_ID);
                                $tipoimovel = $tim->IMB_TIM_DESCRICAO;
                                $vendalocacao='';
                                if( $imovel->IMB_IMV_VALLOC <> 0 AND $imovel->IMB_IMV_VALVEN <> 0 )
                                        $vendalocacao = 'Venda e Locação';
                                if( $imovel->IMB_IMV_VALLOC == 0 AND $imovel->IMB_IMV_VALVEN <> 0 )
                                        $vendalocacao = 'Venda';
                                if( $imovel->IMB_IMV_VALLOC <> 0 AND $imovel->IMB_IMV_VALVEN == 0 )
                                        $vendalocacao = 'Locação';

                                $title='Lindo imóvel do tipo '.$tipoimovel.' para '.$vendalocacao.' na cidade de '.$imovel->IMB_IMV_CIDADE;
                              
                                $imagens = app('App\Http\Controllers\ctrImagem')->carga( $imovel->IMB_IMV_ID);
                                $imobiliaria = app('App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( $idimobiliaria);


                                $grauanuncio = 'STANDARD';
                                if( $imovel->IMB_IMV_SUPERDESTAQUE == 'S' )
                                        $grauanuncio = 'SUPER_PREMIUM';
                                else
                                if( $imovel->IMB_IMV_DESTAQUE == 'S' )
                                        $grauanuncio = 'PREMIUM';

                                $tipoimovelzap = '';
                                $finalidadezap = '';
                                if( $imovel->IMB_IMV_FINALIDADE == 'Residencial')
                                {
                                        if( $tipoimovel == 'Apartamento' ) 
                                        {       $tipoimovelzap = 'Residential / Apartment';
                                        }
                                        elseif( $tipoimovel == 'Casa' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Home';
                                        }
                                        elseif( $tipoimovel == 'Casa em Condominio' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Condo';
                                        }
                                        elseif( $tipoimovel == 'Chacara' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Farm Ranch';
                                        }
                                        elseif( $tipoimovel == 'Cobertura' ) 
                                        {       
                                                $tipoimovelzap = 'Residential / Penthouse';
                                        }
                                        elseif( $tipoimovel == 'Kitnet' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Kitnet';
                                        }
                                        elseif( $tipoimovel == 'Terreno' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Land Lot';
                                        }
                                        elseif( $tipoimovel == 'Sobrado' ) 
                                        {
                                                $tipoimovelzap = 'Residential / Sobrado';
                                        }
                                }
                                
                                if( $imovel->IMB_IMV_FINALIDADE == 'Comercial')
                                {
                                        if( $tipoimovel == 'Fazenda' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Agricultural';
                                        }
                                        elseif( $tipoimovel == 'Sitio' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Agricultural';
                                        }
                                        elseif( $tipoimovel == 'Galpão' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Industrial';
                                        }
                                        elseif( $tipoimovel == 'Terreno' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Land Lot';
                                        }
                                        elseif( $tipoimovel == 'Loja' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Business';
                                        }
                                        elseif( $tipoimovel == 'Salão' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Business';
                                        }
                                        elseif( $tipoimovel == 'Sala Comercial' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Business';
                                        }
                                        elseif( $tipoimovel == 'Box/Garagem' ) 
                                        {
                                                $tipoimovelzap = 'Commercial / Business';
                                        }
                                }
                                
                                        
                        @endphp
                

                        <Listing>
                                <ListingID>{{$imovel->IMB_IMV_ID}}</ListingID>
                                <Title><![CDATA[[{{$title}}]]]></Title>                                
                                @if( $imovel->IMB_IMV_VALLOC == 0 AND $imovel->IMB_IMV_VALVEN <> 0 )                
                                        <TransactionType>Sale</TransactionType>
                                @endif
                                @if( $imovel->IMB_IMV_VALLOC <> 0 AND $imovel->IMB_IMV_VALVEN == 0 )                
                                        <TransactionType>For Rent</TransactionType>
                                @endif
                                @if( $imovel->IMB_IMV_VALLOC <> 0 AND $imovel->IMB_IMV_VALVEN <> 0 )                
                                        <TransactionType>Sale/Rent</TransactionType>
                                @endif
                                <Location displayAddress="Neighborhood">
                                        <Country abbreviation="BR">Brasil</Country>
                                        <State abbreviation="{{$imovel->IMB_IMV_ESTADO}}"><![CDATA[{{$imovel->IMB_IMV_ESTADO}}]]></State>
                                        <City><![CDATA[{{$imovel->IMB_IMV_CIDADE}}]]></City>
                                        
                                        @php
                                                $cep = $imovel->IMB_IMV_ENDERECOCEP;
                                                if( $cep == '' )
                                                        $cep = '17100-000';
                                                else
                                                        $cep = substr( $imovel->IMB_IMV_ENDERECOCEP,0,5 ).'-'.substr( $imovel->IMB_IMV_ENDERECOCEP,5,3 );
                                                 
                                        @endphp
                                        
                                        <PostalCode>{{ $cep }}</PostalCode>
                                        <Latitude>{{$imovel->IMB_IMV_LATITUDE}}</Latitude>
                                        <Longitude>{{$imovel->IMB_IMV_LONGITUDE}}</Longitude>
                                </Location>   
                                <Media>
                                        @foreach($imagens as $imagem)
                                                @if( $imagem->IMB_IMG_PRINCIPAL == 'S' )
                                                        <Item medium="image" caption="img1" primary="true">{{ url("storage/images/".$idimobiliaria."/imoveis/".$imovel->IMB_IMV_ID . "/" . $imagem->IMB_IMG_ARQUIVO) }}</Item>
                                                @endif
                                                @if( $imagem->IMB_IMG_PRINCIPAL <> 'S' )
                                                        <Item medium="image" caption="img2">{{ url("storage/images/".$idimobiliaria."/imoveis/".$imovel->IMB_IMV_ID . "/" . $imagem->IMB_IMG_ARQUIVO) }}</Item>
                                                @endif
                                        @endforeach
                                </Media>                             
                                <ContactInfo>
                                        <Name>{{$imobiliaria->IMB_IMB_NOME}}</Name>
                                        <Email>{{$imobiliaria->IMB_IMB_EMAIL}}</Email>
                                        <Website>{{$imobiliaria->IMB_IMB_URL}}</Website>
                                        <Logo>{{ url("storage/images/".$imovel->IMB_IMB_ID."/logos/logo.jpg") }}</Logo>
                                        <OfficeName>{{$imobiliaria->IMB_IMB_NOME}}</OfficeName>
                                        <Telephone>{{$imobiliaria->IMB_IMB_TELEFONE1}}</Telephone>
                                        <Location>
                                                <Country abbreviation="BR">Brasil</Country>
                                                <State abbreviation="{{$imobiliaria->CEP_UF_SIGLA}}">"{{$imobiliaria->CEP_UF_SIGLA}}"</State>
                                                <City>{{$imobiliaria->CEP_CID_NOME}}</City>
                                                <Neighborhood>{{$imobiliaria->CEP_BAI_NOME}}</Neighborhood>
                                                <Address>{{$imobiliaria->IMB_IMB_ENDERECO}},{{$imobiliaria->IMB_IMB_ENDERECONUMERO}}</Address>
                                                <PostalCode> {{$imobiliaria->IMB_IMB_CEP}} </PostalCode>
                                        </Location>
                                </ContactInfo>                                
                                <PublicationType>{{$grauanuncio}}</PublicationType>
                                <Details>
                                        @if( $imovel->IMB_IMV_VALLOC <> 0 AND $imovel->IMB_IMV_VALVEN <> 0 )                
                                                <TransactionType>Sale/Rent</TransactionType>
                                                <ListPrice currency="BRL">{{number_format($imovel->IMB_IMV_VALVEN,0,'.','')}} </ListPrice>
                                                <RentalPrice currency="BRL" period="Monthly">{{number_format($imovel->IMB_IMV_VALLOC,0,'.','')}}</RentalPrice>
                                        @endif

                                        @if( $imovel->IMB_IMV_VALLOC == 0 AND $imovel->IMB_IMV_VALVEN <> 0 )                
                                                <ListPrice currency="BRL">{{number_format($imovel->IMB_IMV_VALVEN,0,'.','')}}</ListPrice>
                                                <TransactionType>For Sale</TransactionType>
                                        @endif
                                        @if( $imovel->IMB_IMV_VALLOC <> 0 and $imovel->IMB_IMV_VALVEN == 0 )                
                                                <RentalPrice  currency="BRL" period="Monthly">{{number_format($imovel->IMB_IMV_VALLOC,0,'.','')}}</RentalPrice>                                                
                                                <TransactionType>For Rent</TransactionType>
                                        @endif
                                        @if( $imovel->imb_imv_valorcondominio <> 0 )
                                                <PropertyAdministrationFee currency="BRL">{{number_format($imovel->imb_imv_valorcondominio,0,'.','')}} </PropertyAdministrationFee>
                                        @endif
                                        @if( $imovel->IMB_IMV_VALORIPTU <> 0 )
                                                <YearlyTax currency="BRL">{{number_format($imovel->IMB_IMV_VALORIPTU,0,'.','')}} </YearlyTax>
                                        @endif
                                        <Description><![CDATA[ {{$imovel->IMB_IMV_OBSWEB}}]]></Description>
                                        @if( $imovel->IMB_IMV_FINALIDADE <> '' )
                                                <PropertyType>{{$tipoimovelzap}}</PropertyType>
                                        @endif
                                        <Features>
                                                <Feature>@if( $imovel->IMB_IMV_PISCIN == 'S' ) C/Piscina @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_CHURRA == 'S' ) C/Churrasqueira @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_PLAGRO == 'S' ) C/Playground @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_CAMFUT == 'S' ) C/Campo Futebol @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_QUADRAPOLIESPORTIVA == 'S' ) C/Quadra Poliesportiva @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_ELEVADORES == 'S' ) C/Elevador @endif</Feature>
                                                <Feature>@if( $imovel->IMB_IMV_EDICUL == 'S' ) C/Edicula @endif</Feature>
                                        </Features>
                                        <Bathrooms>{{$imovel->IMB_IMV_WCQUA}}</Bathrooms>
                                        <Bedrooms>{{$imovel->IMB_IMV_DORQUA}}</Bedrooms>
                                        <Garage>{{$imovel->IMB_IMV_GARCOB}}</Garage>
                                        <Suites>{{$imovel->IMB_IMV_SUIQUA}}</Suites>
                                        @if( $imovel->IMB_IMV_FINALIDADE == 'Residencial')
                                                <UsageType>Residential</UsageType>
                                        @endif
                                        @if( $imovel->IMB_IMV_FINALIDADE == 'Comecial')
                                                <UsageType>Commercial</UsageType>
                                        @endif
                                        @if( $imovel->IMB_IMV_FINALIDADE == 'Misto')
                                                <UsageType>Residential / Commercial</UsageType>
                                        @endif

                                        @php
                                                $areautil = $imovel->IMB_IMV_AREUTI;
                                                $aretot = $imovel->IMB_IMV_ARETOT;
                                                if( strpos( $areautil,'.' ) <>'')
                                                {
                                                        $pos =  strpos($areautil ,".");
                                                        $areautil = substr( $areautil,0,$pos );
                                                }
                                                if( strpos( $areautil,',' )<>'' )
                                                {
                                                        $pos =  strpos($areautil ,",");
                                                        $areautil = substr( $areautil,0,$pos );
                                                }

                                                if( strpos( $aretot,'.' ) <>'')
                                                {
                                                        $pos =  strpos($aretot ,".");
                                                        $aretot = substr( $aretot,0,$pos );
                                                }
                                                if( strpos( $aretot,',' ) <> '')
                                                {
                                                        $pos =  strpos($aretot ,",");
                                                        $aretot = substr( $aretot,0,$pos );
                                                }
                                                                                                
        
                                        @endphp


                                        @if ( $areautil <> null and $areautil <> '0' and $areautil <>'' )
                                                <LivingArea unit="square metres">{{$areautil}}</LivingArea>
                                                @php
                                                        $aretotdefalut=$areautil;
                                                @endphp
                                        @else
                                                <LivingArea unit="square metres">10</LivingArea>
                                                @php
                                                        $aretotdefalut=10;
                                                @endphp

                                        @endif

                                        @if ( $aretot <> null and $aretot <> '0' and $aretot <>'' )
                                                <LotArea unit="square metres">{{$aretot}}</LotArea>                                        
                                        @else
                                                <LotArea unit="square metres">{{$aretotdefalut}}</LotArea>                                        
                                        @endif

                                        
                                        
                                </Details>

                        </Listing>
                        @endforeach
                </Listings>
        </ListingDataFeed>
