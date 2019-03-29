
					
					$(document).on('click', '.fecha_e_refresh', function(){
						location.href='http://www.geopc.mz.caixa/sumep.mz.caixa/novosiaf/index.php';
						
						});
						
						$(document).on('click', '.cadtratalote', function(){
						
						$.ajax({
							
					
							method: 'POST',
							url: "data\\altera_dados_pedido.php",
							data: $( "#formulario_trata_lote" ).serialize(),
							
							async: false,
							success: function (jsonStr) {//alert()
											var obj5 = JSON.parse(jsonStr);
											
											
											$(function(){
								
								//location.href='http://www.geopc.mz.caixa/sumep.mz.caixa/novosiaf/';
					
							
							
						});
							
											
								}
						});
						
						
						});
						
						$(document).on('click', '.tratar_lote', function(){
							var lotesolicitado = $(this).attr('id');
							
							$.ajax({
								method: 'GET',
								url: "data\\carrega_dados_pedidos.php?lote="+lotesolicitado,
								async: false,
								success: function (jsonStr) {
									var obj = JSON.parse(jsonStr);
									$(function(){
						$("#nomedoloteselecionado").html(obj.lote);
					  
					   
					   for (var i=0; i<obj.pedido_caixa.length; i++) {
							$('#form_pedidos').append('<tr>\
										<td><small>'+ obj.pedido_cliente[i] +'</small></td>\
										<td><small>'+ obj.pedido_caixa[i] +'</small></td>\
                                        <td><input placeholder="..." style="text-align:center" id="contapedido'+[i] +'" maxlength="20" name="pedido_conta_corrente[]"  value="'+ obj.pedido_conta_corrente[i] +'" data-mask="9999.999.99999999-9" class="form-control-2" type="text"></td>\
                                        <td><input placeholder="..." style="text-align:center" id="valorpedido'+[i] +'" name="pedido_valor[]" placeholder="Informe o Valor"  value="'+ obj.pedido_valor[i] +'" valordeamortizacao class="form-control-2" type="text"></td>\
                                        <td><small>'+ obj.pedido_tipo[i] +'</small></td>\
										<td><small>'+ obj.pedido_status[i] +'</small></td>\
										<td>  <select data-placeholder="Selecione o tipo.."  id="novostatuspedido'+[i] +'" name="pedido_novostatus[]" tipodecomando class="select" tabindex="7">\
                                        <option value=""> - </option> \
                                        <option value="SIBAN OK">SIBAN OK</option>\
										<option value="FALTA SIBAN">FALTA SIBAN</option>\
										<option value="RECEBIDO">RECEBIDO</option>\
                                        <option value="NA SUMEP">À SUMEP</option>\
                                        <option value="NL SEM SALDO">NL SEM SALDO</option>\
                                        <option value="NL EM CA">NL EM CA</option>\
                                        <option value="NL SEM COMANDO">NL SEM COMANDO</option>\
                                        <option value="SUMEP RESIDUO SIFBN">SUMEP - RESIDUO SIFBN</option>\
										<option value="SUMEP DEB_PENDENTE">SUMEP DEB_PENDENTE</option>\
										<option value="SUMEP NAO LIQUIDADO">SUMEP - NAO LIQUIDADO</option>\
                                        <option value="CANCELADO">CANCELADO</option>\
										<option value="ACATADO">ACATADO</option>\
										<option value="CONCLUIDO">CONCLUIDO</option>\
                                    </select></td>\
									<input type="hidden" id="pedidoaltera'+[i] +'" name="alterapedido[]" \
																value="'+obj.pedido_numero[i] +'">\
																<input type="hidden" id="conta_pedido_antiga'+[i] +'" name="pedido_conta_corrente_antiga[]" \
																value="'+obj.pedido_conta_corrente[i] +'">\
																<input type="hidden" id="valor_pedido_antiga'+[i] +'" name="pedido_valor_antiga[]" \
																value="'+obj.pedido_valor[i] +'">\
																<input type="hidden" id="status_pedido_antiga'+[i] +'" name="pedido_status_antiga[]" \
																value="'+obj.pedido_status[i] +'">\
                                                </tr>\
							'); 
						 
						
						}
						$('#form_pedidos').append('<input type="hidden" id="pedidosexistentes" name="pedidosexistentes" \
																value="'+obj.pedido_caixa.length +'">\
																'); 
						
						
						
						$("[valordeamortizacao]").maskMoney({
							symbol:'', 
							decimal:',', 
							precision:2, 
							thousands:'.', 
							allowZero:true, 
							showSymbol:false 
						});
						
						
					   
					  $('#tratarlote').modal('show');
						
					});
	
					
				}
				
			});
							
							
						
						
						});
						
						
						
						$(document).on('click', '.visualiza', function(){
							var idvisualiza = $(this).attr('id');
							idvisualiza = idvisualiza.replace("v", "");
							$('#visualizarcontrato').modal('show');
							
							//$("#conteudoModal").html($('#'+id).val());
							
							$.ajax({
							method: 'GET',
							url: "data\\carrega_dados_visualizar.php?id="+idvisualiza,
							success: function (jsonStr) {
								var obj2 = JSON.parse(jsonStr);
					$(function(){
						
					   //$.jGrowl('Processando CNPJ', { sticky: true, theme: 'growl-success', header: 'Successo!' });
					  $("#cnpj_cliente_modal").html(obj2.cnpj);
					  $("#nome_cliente_modal").html(obj2.cliente);
					  $("#conta_corrente_modal").val(obj2.conta_corrente);
					  $("#numero_fro_modal").val(obj2.contrato_bndes);
					  $("#contrato_caixa_modal").val(obj2.contrato_caixa);
					  $("#contrato_bndes_modal").val(obj2.contrato_bndes);
					  $("#valor_modal").val(obj2.valor);
					  $("#tipo_modal").val(obj2.tipo);
					  $("#status_modal").val(obj2.status);
					  $("#obs_modal").html(obj2.obs);
					  $("#pv_modal").val(obj2.pv);
					  $("#sr_modal").val(obj2.sr);
					  $("#gigad_modal").val(obj2.gigad);
					  $("#datacadastramento").html(obj2.data_solicitado);
					  $("#solicitante_nome").html(obj2.solicitante);
					  $("#solicitante_matricula").html(obj2.mat_solicitante);
					 for (var i=0; i<obj2.historico_saldo.length; i++) {
							var cordoefeito,saldoapresentado;
							cordoefeito='default';
							if(obj2.historico_saldo[i]=='Saldo Ok'){cordoefeito='success';}
							if(obj2.historico_saldo[i]=='Saldo Insuficiente'){cordoefeito='warning';}
							if(obj2.historico_saldo[i]=='Saldo Bloqueado'){cordoefeito='danger';}
							if(obj2.historico_saldo[i]=='CONFERENCIA'){cordoefeito='info';}
							$('#form_saldo_conta').append('<tr>\
															<td><i class="icon-clock"> &nbsp Saldo Verificado em  '+ obj2.data_saldo[i] +'</i> &nbsp </td>\
															<td> <span class="label label-'+cordoefeito+'">'+ obj2.historico_saldo[i] +'</span> </td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_dispo[i] +'</span></td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_bloqueado[i] +'</span></td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_total[i] +'</span></td>\
															<br></tr><br>\
							'); 
						 
						
						} 
						
					});
	
					
				}
				
			});
			
			
			
			
						
						});
						
						
						$(document).on('click', '.edita', function(){
							var idedita = $(this).attr('id');
							idedita = idedita.replace("e", "");
							$('#editarcontrato').modal('show');
							
							//$("#conteudoModal").html($('#'+id).val());
							
							$.ajax({
							method: 'GET',
							url: "data\\carrega_dados_visualizar.php?id="+idedita,
							success: function (jsonStr) {
								var obj2 = JSON.parse(jsonStr);
					$(function(){
						
					   //$.jGrowl('Processando CNPJ', { sticky: true, theme: 'growl-success', header: 'Successo!' });
					  $("#cnpj_cliente_editar").html(obj2.cnpj);
					  $("#nome_cliente_editar").html(obj2.cliente);
					  $("#conta_corrente_editar").val(obj2.conta_corrente);
					  $("#editar_conta_antigo").val(obj2.conta_corrente);
					  $("#numero_fro_editar").val(obj2.contrato_bndes);
					  $("#editar_contrato_bndes_antigo").val(obj2.contrato_bndes);
					  $("#contrato_caixa_editar").val(obj2.contrato_caixa);
					  $("#editar_contrato_caixa_antigo").val(obj2.contrato_caixa);
					  $("#contrato_bndes_editar").val(obj2.contrato_bndes);
					  $("#valor_editar").val(obj2.valor);
					  $("#editar_valor_antigo").val(obj2.valor);
					   $("#status_editar").val(obj2.status);
					  $("#editar_status_antigo").val(obj2.status);
					   $("#tipo_editar").val(obj2.tipo);
					   $("#pv_editar").val(obj2.pv);
					  $("#sr_editar").val(obj2.sr);
					  $("#gigad_editar").val(obj2.gigad);
					  $("#editardatacadastramento").html(obj2.data_solicitado);
					  $("#editarsolicitante_nome").html(obj2.solicitante);
					  $("#editarsolicitante_matricula").html(obj2.mat_solicitante);
					 
					 if ((obj2.status=='NA SUMEP')||(obj2.status=='SUMEP RESIDUO SIFBN')||(obj2.status=='SUMEP NAO LIQUIDADO')||(obj2.status=='SUMEP CONTA NAO DEBITADA')){
					 	$('#form_status_editar').append(' <select data-placeholder="Selecione o tipo.."  id="status_editado" name="status_editado" tipodecomando class="select form-control" tabindex="7">\
															<option value="'+obj2.status+'" selected> '+obj2.status+'</option> \
															<option value="CANCELADO">CANCELADO</option>\
															<option value="CONCLUIDO">CONCLUIDO</option>\
														</select>\
							');
					 }else{
					  $('#form_status_editar').append(' <select data-placeholder="Selecione o tipo.."  id="status_editado" name="status_editado" tipodecomando class="select form-control" tabindex="7">\
															<option value="'+obj2.status+'" selected> '+obj2.status+'</option> \
															<option value="SIBAN OK">SIBAN OK</option>\
															<option value="FALTA SIBAN">FALTA SIBAN</option>\
															<option value="RECEBIDO">RECEBIDO</option>\
															<option value="NA SUMEP">À SUMEP</option>\
															<option value="NL SEM SALDO">NL SEM SALDO</option>\
                              <option value="NL EM CA">NL EM CA</option>\
                              <option value="NL SEM COMANDO">NL SEM COMANDO</option>\
															<option value="CANCELADO">CANCELADO</option>\
															<option value="SUMEP RESIDUO SIFBN">SUMEP - RESIDUO SIFBN</option>\
															<option value="SUMEP DEB_PENDENTE">SUMEP DEB_PENDENTE</option>\
															<option value="SUMEP NAO LIQUIDADO">SUMEP - NAO LIQUIDADO</option>\
															<option value="ACATADO">ACATADO</option>\
															<option value="CONCLUIDO">CONCLUIDO</option>\
														</select>\
							'); }

					   $("#obs_editar").html(obj2.obs);
					   $("#obs_modal_editar").html(obj2.obs);
					   $("#protocolo_alterar_dados").val(obj2.protocolo);
					 
					    for (var i=0; i<obj2.historico_saldo.length; i++) {
							var cordoefeito,saldoapresentado;
							cordoefeito='default';
							if(obj2.historico_saldo[i]=='Saldo Ok'){cordoefeito='success';}
							if(obj2.historico_saldo[i]=='Saldo Insuficiente'){cordoefeito='warning';}
							if(obj2.historico_saldo[i]=='Saldo Bloqueado'){cordoefeito='danger';}
							if(obj2.historico_saldo[i]=='Conta Inexistente'){cordoefeito='info';}
							$('#form_saldo_conta_2').append('<tr>\
															<td><i class="icon-clock"> &nbsp Saldo Verificado em  '+ obj2.data_saldo[i] +'</i> &nbsp </td>\
															<td> <span class="label label-'+cordoefeito+'">'+ obj2.historico_saldo[i] +'</span> </td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_dispo[i] +'</span></td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_bloqueado[i] +'</span></td>\
															<td> &nbsp  <span class="pull-center badge bg-'+cordoefeito+' ">R$ '+ obj2.saldo_total[i] +'</span></td>\
															<br></tr><br>\
							'); 
						 
						
						}
					  
						
					});
	
					
				}
				
			});
			
			
			
			
						
						});
						
						
						
						$(document).on('click', '.exclui', function(){
							var idexcluir = $(this).attr('id');
							idexcluir = idexcluir.replace("x", "");
							
							
							//$("#conteudoModal").html($('#'+id).val());
							
							$.ajax({
							method: 'GET',
							url: "data\\carrega_dados_visualizar.php?id="+idexcluir,
							success: function (jsonStr) {
								var obj3 = JSON.parse(jsonStr);
					$(function(){
						
					   //$.jGrowl('Processando CNPJ', { sticky: true, theme: 'growl-success', header: 'Successo!' });
					  
					  $("#nome_cliente_modal_excluir").html(obj3.cliente);
					  $("#confirma_excluir_protocolo").html(obj3.protocolo);
					   $("#contrato_cliente_modal_excluir").html(obj3.contrato_caixa);
					  $("#excluir_protocolo").val(obj3.protocolo);
					  $('#excluirpedido').modal('show');
					
					  
						
					});
	
					
				}
				
			});	
						});
					
					////$("#exclui_apos_confirmacao").on("click", function() {
						//$("[exclui_apos_confirmacao]").click(function(event){
						$(document).on('click', '.exclui_apos_confirmacao', function(){
						$.ajax({
							method: 'POST',
							url: "data\\exclui_pedido.php",
							data: $( "#formulario_excluir" ).serialize(),
							async: false,
							success: function (jsonStr) {
											var obj5 = JSON.parse(jsonStr);
											
											
											$(function(){
								location.href='http://www.geopc.mz.caixa/sumep.mz.caixa/novosiaf/';
								//$("#cadastramento").modal('hide');
								//$("#confirmacao").modal('show');
								//alert('Sua solicitação foi cadastrada com sucesso. Protocolo do pedido  nº 000'+String(obj.seuprotocolo)+'.')
									
								//location.href='http://www.ceopc.sp.caixa/complemex/visualizar_contrato.php?numerodocontrato='+String(obj.contratosisbacen);
								
								//location.href='http://www.geopc.mz.caixa/esteiracomex/lista_contratos.php';
							
							
						});
							
											
								}
						});
			
			
						
						});
						
						$(document).on('click', '.mandei_editar', function(){
							$.ajax({
								method: 'POST',
								url: "data\\editar_dados_pedido.php",
								data: $( "#formulario_editar_amortizacao" ).serialize(),
								async: false,
								success: function (jsonStr) {	
												var obj5 = JSON.parse(jsonStr);
												
												
												$(function(){
													//location.href='http://www.geopc.mz.caixa/sumep.mz.caixa/novosiaf/';
												});
								
												
											}
							});
						});
					
					
	$(document).on('click', '.carregadadoscnpj', function(){
		
		
		
		
													function validarCNPJ(cnpj) {
												    cnpj = cnpj.replace( "." , ""); //tira ponto
												    cnpj = cnpj.replace( "/" , ""); //tira barra
													cnpj = cnpj.replace( "-" , ""); //tira hífen
													cnpj = cnpj.replace(/[^\d]+/g,'');
												 
													if(cnpj == '') return false;
													 
													if (cnpj.length != 14)
														return false;
												 
													// Elimina CNPJs invalidos conhecidos
													if (cnpj == "00000000000000" || 
														cnpj == "11111111111111" || 
														cnpj == "22222222222222" || 
														cnpj == "33333333333333" || 
														cnpj == "44444444444444" || 
														cnpj == "55555555555555" || 
														cnpj == "66666666666666" || 
														cnpj == "77777777777777" || 
														cnpj == "88888888888888" || 
														cnpj == "99999999999999")
														return false;
														 
													// Valida DVs
													tamanho = cnpj.length - 2
													numeros = cnpj.substring(0,tamanho);
													digitos = cnpj.substring(tamanho);
													soma = 0;
													pos = tamanho - 7;
													for (i = tamanho; i >= 1; i--) {
													  soma += numeros.charAt(tamanho - i) * pos--;
													  if (pos < 2)
															pos = 9;
													}
													resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
													if (resultado != digitos.charAt(0))
														return false;
														 
													tamanho = tamanho + 1;
													numeros = cnpj.substring(0,tamanho);
													soma = 0;
													pos = tamanho - 7;
													for (i = tamanho; i >= 1; i--) {
													  soma += numeros.charAt(tamanho - i) * pos--;
													  if (pos < 2)
															pos = 9;
													}
													resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
													if (resultado != digitos.charAt(1))
														  return false;
														   
													return true;
													
												}
												function ajustacnpj(cnpj) {
												    cnpj = cnpj.replace( "." , ""); //tira ponto
												    cnpj = cnpj.replace( "/" , ""); //tira barra
													cnpj = cnpj.replace( "-" , ""); //tira hífen
													cnpj = cnpj.replace(/[^\d]+/g,'');
												return cnpj;
												}
		
						if($("#cnpj").val()==""){
								
							$.jGrowl('Digite um cnpj !!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
							
							return;
						}
						

						if(!validarCNPJ($("#cnpj").val())){
							$.jGrowl('Digite um cnpj válido', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							return;
						}
						
						
						
			
		
			$.ajax({
				method: 'POST',
				url: "data\\carrega_dados_contrato_sumep.php",
				//url: "http://df7562sr500.df.caixa/api/bndes/contratos/"+ajustacnpj($("#cnpj").val())+"/",
				data: $( "#formulario_cnpj" ).serialize(),
				async: false,
				success: function (jsonStr) {
					var obj = JSON.parse(jsonStr);
					$(function(){
						
					  // $.jGrowl('Processando CNPJ', { sticky: true, theme: 'growl-success', header: 'Successo!' });
					  $("#cnpj_cliente").html(obj.cnpj);
					   $("#nome_cliente").html(obj.cliente);
					   $("#cnpj_cliente2").html(obj.cnpj);
					   $("#nome_cliente2").html(obj.cliente);
					   $("#cnpj_cliente3").val(obj.cnpj);
					   $("#nome_cliente3").val(obj.cliente);
					   $("#conta_corrente").val(obj.conta_corrente);
					   
					   
					   if(obj.cliente==""){
								
							$.jGrowl('Não foram encontrados contratos para este CNPJ !!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
							
							return;
						}
					   
					   for (var i=0; i<obj.contrato_caixa.length; i++) {
							$('#form_contratos').append('<tr>\
                                        <td><input placeholder="..." id="bndescarregado'+[i] +'"  name="contrato_bndes[]" value="'+ obj.contrato_bndes[i] +'" data-mask="99999999999" class="form-control" type="text"></td>\
                                        <td><input placeholder="..." id="caixacarregado'+[i] +'"  name="contrato_caixa[]"  value="'+ obj.contrato_caixa[i] +'" data-mask="9999.999.9999999-99" class="form-control" type="text"></td>\
                                        <td><input placeholder="..." id="contacarregado'+[i] +'"  name="conta_corrente[]"  value="'+ obj.conta_corrente +'" data-mask="9999.999.99999999-9" class="form-control" type="text"></td>\
                                        <td><input placeholder="..."  id="valorcarregado'+[i] +'" name="valor[]" placeholder="Informe o Valor"  valordeamortizacao class="form-control" type="text"></td>\
                                        <td>  <select data-placeholder="Selecione o tipo.."  id="tipocarregado'+[i] +'" name="tipo[]" tipodecomando class="select" tabindex="2">\
                                        <option value=""> - </option> \
                                        <option value="A">Amortização</option>\
                                        <option value="L">Liquidação</option>\
                                    </select></td>\
                                                </tr>\
							'); 
						 
						
						}
						$('#form_contratos').append('<input type="hidden" id="contratosexistentes" name="vazio" \
																value="'+obj.contrato_caixa.length +'">\
																'); 
						
						
						
						$("[valordeamortizacao]").maskMoney({
							symbol:'', 
							decimal:',', 
							precision:2, 
							thousands:'.', 
							allowZero:true, 
							showSymbol:false 
						});
						
						//$("[modelocontacorrente]").inputmask("9999.999.99999999-9");
						//$("[modelocontratocaixa]").inputmask("9999.999.9999999-99");
						//$("[modelocontratobndes]").inputmask("99999999999");
					   $("[tipodecomando]").addClass("required select");
					   $("[tipodecheck]").addClass("styled");
					   
					   $("#cadastramento").modal('show');
						
					});
	
					
				}
				
			});
			return false;
			
		
	});
	
	$(document).on('click', '.cadamortizacao', function(){
		
			
				
			for (f=0;f<$("#contratosexistentes").val();f++) {
				 
				
				numerodopedido=f+1;
			
				if(((($('#valorcarregado'+f).val()=="")||($('#valorcarregado'+f).val()<1))&&($('#tipocarregado'+f).val()!=""))||((($('#valorcarregado'+f).val()!="")||($('#valorcarregado'+f).val()>1))&&($('#tipocarregado'+f).val()==""))){
					//if(((($('#valorcarregado'+f).val()=="")||($('#valorcarregado'+f).val()=="0,00"))&&($('#tipocarregado'+f).val()!=""))||((($('#valorcarregado'+f).val()!="")||($('#valorcarregado'+f).val()!="0,00"))&&($('#tipocarregado'+f).val()==""))){
				
						if((($('#valorcarregado'+f).val()=="")||($('#valorcarregado'+f).val()<1))&&($('#tipocarregado'+f).val()!="")){
							$.jGrowl('Informe o valor de amortização da '+numerodopedido+'º linha  !!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
							
						}
						if((($('#valorcarregado'+f).val()!="")||($('#valorcarregado'+f).val()>1))&&($('#tipocarregado'+f).val()=="")){
						
							$.jGrowl('Informe o tipo de comando da '+numerodopedido+'º linha!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						if($('#bndescarregado'+f).val()==""){
							$.jGrowl('Informe o contrato BNDES do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						if($('#caixacarregado'+f).val()==""){
							$.jGrowl('Informe o contrato CAIXA do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						if($('#contacarregado'+f).val()==""){
							$.jGrowl('Informe o numero da conta de débito do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						
						
				
			return false;				
			}
			
			if((($('#valorcarregado'+f).val()!="")||($('#valorcarregado'+f).val()!="0,00"))&&($('#tipocarregado'+f).val()!="")){
				
				
				if(($('#bndescarregado'+f).val()=="")||($('#caixacarregado'+f).val()=="")||($('#contacarregado'+f).val()=="")){
							if($('#bndescarregado'+f).val()==""){
							$.jGrowl('Informe o contrato BNDES do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						if($('#caixacarregado'+f).val()==""){
							$.jGrowl('Informe o contrato BNDES do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						if($('#contacarregado'+f).val()==""){
							$.jGrowl('Informe o numero da conta do '+numerodopedido+'º pedido!!', { sticky: true, theme: 'growl-error', header: 'Atenção ao Erro!' });
							
						}
						return false;
				}
							
						}
			
			
			
			}
			
			
			
			
			
			
		
		$.ajax({
				method: 'POST',
				url: "data\\cadastra_pedido_amortizacao.php",
				data: $( "#formulario_pedido_amortizacao" ).serialize(),
				async: false,
				success: function (jsonStr) {
					//var obj2 = JSON.parse(jsonStr);
					
					
					$(function(){
		$("#cadastramento").modal('hide');
		$("#confirmacao").modal('show');
		//alert('Sua solicitação foi cadastrada com sucesso. Protocolo do pedido  nº 000'+String(obj.seuprotocolo)+'.')
			
		//location.href='http://www.ceopc.sp.caixa/complemex/visualizar_contrato.php?numerodocontrato='+String(obj.contratosisbacen);
		
		//location.href='http://www.geopc.mz.caixa/esteiracomex/lista_contratos.php';
	
	
});
	
					
        }
				
			});
			
			return false;
		
	});
	
	
	
	
	
	
	