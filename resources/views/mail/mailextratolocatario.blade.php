Olá <i>{{ $nomecliente}}</i>,
<p>
 Segue anexo o extrato de pagamentos do Periodo: {{app( 'App\Http\Controllers\ctrRotinas')->formatarData( $datainicio)}} a {{app( 'App\Http\Controllers\ctrRotinas')->formatarData($datafim)}}
</p>
 
Obrigado,
<br/>
<p>
Departamento de Suporte Técnico
suporte@siriussystem.com.br
</p>