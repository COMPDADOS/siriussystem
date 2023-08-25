<header class="main-header">
                <!--  logo  -->
                <div class="logo-holder"><a href="{{route('siteindex')}}"><img src="{{asset('/site/images/logo.png')}}" alt=""></a></div>
                <!-- logo end  -->
                <!-- nav-button-wrap--> 
                <div class="nav-button-wrap color-bg nvminit">
                    <div class="nav-button">
                        <span></span><span></span><span></span>
                    </div>
                </div>
                <!--  login btn -->
                <div class="show-reg-form modal-open"><i class="fas fa-user"></i><span>Área do Cliente</span></div>
                <!-- navigation  end -->
                <!-- header-search-wrapper -->
                <div class="header-search-wrapper novis_search">
                    <div class="header-serach-menu">
                        <div class="custom-switcher fl-wrap">
                            <div class="fieldset fl-wrap">
                                <input type="radio" name="duration-1"  id="buy_sw" class="tariff-toggle" checked>
                                <label for="buy_sw">Comprar</label>
                                <input type="radio" name="duration-1" class="tariff-toggle"  id="rent_sw">
                                <label for="rent_sw" class="lss_lb">Alugar</label>
                                <span class="switch color-bg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="custom-form">
                        <form method="post"  name="registerform">
                            <label>Palavra Chave </label>
                            <input type="text" placeholder="Condomínio , Bairro,  Cidade..." value=""/>
                            <label >Cidades</label>

                            <select  data-placeholder="Cidades" class="chosen-select on-radius no-search-select" >
                                <option value="">Todas as Cidades</option>
                                @foreach( $cidades as $cidade)
                                    <option value="{{$cidade->IMB_IMV_CIDADE}}">{{$cidade->IMB_IMV_CIDADE}}</option>
                                @endforeach
                            </select>
                            <label >Tipo de Imóvel</label>
                            <select data-placeholder="Tipo de Imóvel" class="chosen-select on-radius no-search-select" >
                                <option>Todos os Tipos</option>
                                @foreach( $tipoimovel as $ti)
                                    <option value="{{$ti->IMB_TIM_ID}}">{{$ti->IMB_TIM_DESCRICAO}}</option>
                                @endforeach
                            </select>
                            <label style="margin-top:10px;" >Faixa de Preço</label>
                            <div class="price-rage-item fl-wrap">
                                            <span class="pr_title">Preço:</span>                            
                                            <input type="text" class="price-range-double" data-min="100" data-max="100000"  name="price-range2"  data-step="100" value="1" data-prefix="$">
                                        </div>                            <button onclick="location.href='listing.html'" type="button"  class="btn float-btn color-bg"><i class="fal fa-search"></i> Vamos Lá</button>
                        </form>
                    </div>
                </div>
                <!-- header-search-wrapper end  -->				
                <!-- wishlist-wrap--> 
                
                <!--wishlist-wrap end -->                            
                <!--header-opt-modal-->  
                <!--header-opt-modal end -->  
            </header>