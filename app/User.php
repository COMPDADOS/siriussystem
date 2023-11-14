<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\mdlImobiliaria;
use App\mdlTipoImovel;
use App\mdlCondominio;
use App\mdlParametros;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table="IMB_ATENDENTE";
    protected $primaryKey = "IMB_ATD_ID";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Recupera todas as unidades vincladas a imobiliaria master do usuário
     * @return Object<Imobiliaria>
     */
    public function getUnidades()
    {
        return mdlImobiliaria::select([
                'IMB_IMB_ID',
                'IMB_IMB_NOME'
            ])
            ->whereRaw(DB::raw("COALESCE(IMB_IMB_NOME,'')<>''''"))
            ->where('IMB_IMB_IDMASTER', $this->mdlImobiliaria->IMB_IMB_IDMASTER)->get();
    }

    /**
     * Retorna os tipos de imóveis vinculados a imobiliaria master do usuario
     * @return Object<ImbTipoImovel>
     */
    public function getTiposImoveis()
    {
        return mdlTipoImovel::select([
                'IMB_TIM_ID',
                'IMB_TIM_DESCRICAO'
            ])
            ->where('IMB_IMB_ID2', $this->mdlImobiliaria->IMB_IMB_IDMASTER)->get();
    }

    /**
     * Retorna todos os condominios cadastrados no sistema
     * @return Object<ImbCondominio>
     */
    public function getCondominios()
    {
        return mdlCondominio::orderBy('IMB_CND_NOME')->get();
    }

    public function imobiliaria( $id)
    {
        $imb = mdlImobiliaria::find($id);

        return $imb;

    }
    

}
