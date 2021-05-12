<template>
   <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                            <li class="breadcrumb-item active">Clientes</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><span class="badge badge-dark badge-pill">Mantenimiento</span>&nbsp; <span class="badge badge-purple badge-pill"><i class="la la-user"></i>Clientes</span></h4>

                                    
                                        
                                                            
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <div class="row" style="margin-top: -15px">
                                          
                                          <div class="col-12 col-md-6">
                                          


                                          <div class="row">
                                              
                                                <div class="col-11">
                                                    <Select2  id="autocompletar_cliente"  data-toggle="select2" v-model="select_cliente" @change="onChangeCliente($event)" />
                                                </div>

                                                <div class="col-1">
                                              
                                                    <button class="btn btn-sm btn-danger p-1" v-on:click="resetea_cliente"><i class="fas fa-trash"></i></button>
                                                </div>


                                          </div>
                                          
                                          
                                         

                                        

                                       </div> 

                                        <div class="col-11 col-md-5">
                                            
                                           
                                          <select v-model="select_categoria" class="selectpicker form-control form-control-sm" data-style="btn-outline-primary" id="cmb_filter_categoria" name="cmb_filter_categoria" @change="onChangeCategoria($event)">

                                                <option value="0">Seleccione Categoria</option>

                                                <option v-for="cmbCategoria in this.categorias_prop" v-bind:value="cmbCategoria.id">
                                                    {{ cmbCategoria.text }}
                                                </option>

                                                
                                            </select>
                                            

                                            
                                       </div>


                                       <div class="col-1 col-md-1">
                                        
                                        <!-- <button type="button" class="btn btn-success waves-effect waves-light btn-xs mr-1" data-toggle="modal" data-target="#full-width-modal-cliente" v-on:click="get_modal_edit(0)"><i class="fas fa-plus"></i></button> -->

                                        <button type="button" class="btn btn-success waves-effect waves-light btn-xs mr-1" v-on:click="get_modal_edit(0)"><i class="fas fa-plus"></i></button>

                                       </div>
                                       

                                       </div>
                                       

                                        

                                       <BlockUI v-if="activaUi":message="msg" :html="html"></BlockUI>

                                        <table id="table_list_cliente" class="table dt-responsive nowrap mt-1" style="width: 100%">
                                            <thead class="thead-light ">
                                                <tr >
                                                    <th></th>
                                                    <th>Dni</th>
                                                    <th>Nombres</th>
                                                    <th>F.Nacimiento</th>
                                                    <th>Edad</th>
                                                    <th>Sexo</th>
                                                    <th>Contratos</th>
                                                    
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>

                                               <tr v-for="tabla_cliente in tabla_clientes">

                                                <td>

                                                    <!-- <button @click="get_modal_edit(tabla_cliente.IDENTIFICACION)" type="button" class="btn btn-success waves-effect waves-light btn-xs mr-1" data-toggle="modal" data-target="#full-width-modal-cliente" ><i class="mdi mdi-pencil"></i></button> -->

                                                    <button @click="get_modal_edit(tabla_cliente.IDENTIFICACION)" type="button" class="btn btn-success waves-effect waves-light btn-xs mr-1" ><i class="mdi mdi-pencil"></i></button>

                                                    <button v-show="tabla_cliente.CLASE_CLIENTE=='01'"type="button" class="btn btn-primary waves-effect waves-light btn-xs mr-1" data-toggle="modal" data-target="#modal-plan-seguro"><i class="mdi mdi-account-details"></i></button>

                                                    <button  type="button" class="sa-warning btn btn-danger waves-effect waves-light btn-xs mr-1"><i class="mdi mdi-delete"></i></button>

                                                   
                                                </td>
                                                
                                                <td>{{tabla_cliente.IDENTIFICACION}}</td>
                                                <td>{{tabla_cliente.NOMBRE}}</td>
                                                <td>{{tabla_cliente.FECHA_NACIMIENTO}}</td>
                                                <td>{{tabla_cliente.EDAD}}</td>

                                                <td v-if="tabla_cliente.SEXO=='M'">
                                                    <span style="margin-top:-5px; text-align:center; font-size:135%;" class="btn btn-default btn_resize text-primary fas fa-male glyphicon glyphicon-ok-sign"></span>

                                                </td>

                                                <td v-else-if="tabla_cliente.SEXO=='F'">
                                                    <span style="margin-top:-5px;text-align:center; font-size:135%;" class="btn btn-default btn_resize text-danger fas fa-female"></span>

                                                </td>

                                                <td v-else-if="tabla_cliente.SEXO=='E'">
                                                    <span style="margin-top:-5px;text-align:center; font-size:135%;" class="btn btn-default btn_resize text-success fas fa-home"></span>

                                                </td>

                                                <td v-else>

                                                </td>
                                                
                                                <td>{{tabla_cliente.CANT_SERVICIO_CLIENTE}}</td>
                                                

                                                </tr>
                                               
                                          
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->




                        
                        
                    </div> <!-- container -->

                    <!-- modal de registro -->


  
   <div id="full-width-modal-cliente" class="modal fade"  role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;" >
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="full-width-modalLabel">

                    <img v-if="this.empresauser_prop == '001'" height="25" width="100" src="imagenes/criocord_logo.png">
                    
                    <img v-else-if="this.empresauser_prop == '002'" height="23" width="110" src="imagenes/lazo_de_vida_logo.png">

                   

                    &nbsp;
                    <span class="badge badge-purple badge-pill">Registro de Clientes</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                  
                <form class="form-horizontal" id="CreateFormCliente" @submit.prevent="SalvarCliente">

                <div class="row">
                        
                    <div class="col-12 col-lg-8 margin-top-negative-10">
                        
                        <fieldset class="border p-2">
                        <legend  class="w-auto"><h5>Datos del Cliente</h5></legend>

                        
                        
                        <!-- {{this.idcliente_prop}} -->
                        <div class="form-group row margin-top-negative-10">
                            
                            <div class="col-12" >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cliente_tdocumento" class="col-form-label">Documento</label>
                                       
                                        <Select2 id="cliente_tdocumento" name="cliente_tdocumento" v-model="vm_documento" :options="this.documentos_prop"  v-on:change="changeTipoDocumento($event)" />
                                        
                                        <span v-if="allerros.vm_documento" class="text-danger">{{ allerros.vm_documento[0] }}</span>

                                        

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cliente_ndocumento" class="col-form-label">N° Documento</label>

                                        <div class="input-group">

                                            <input type="text" class="form-control form-control-md" id="cliente_ndocumento" name="cliente_ndocumento" v-model="vm_ndocumento" autocomplete="off" v-on:keyup="changeNumeroDocumento($event)">
                                                    
                                            <div class="input-group-append">
                                                <button class="btn btn-dark waves-effect waves-light" type="button" v-on:click="searchCliente($event)"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>

                                        

                                        <span v-if="allerros.vm_ndocumento" class="text-danger">{{ allerros.vm_ndocumento[0] }}</span>

                                        
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_tcliente" class="col-form-label">Tipo Cliente</label>
                                        

                                        <Select2 id="cliente_tcliente" name="cliente_tcliente" v-model="vm_tcliente" :options="this.clasecliente_prop" v-on:change="changeClaseCliente($event)"/>

                                        <span v-if="allerros.vm_tcliente" class="text-danger">{{ allerros.vm_tcliente[0] }}</span>
                            
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>


                        <div class="form-group row" style="margin-top: -30px">
                            
                            <div class="col-12" >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cliente_apepat" class="col-form-label">A.Paterno</label>
                                        <input type="text" class="form-control form-control-md" id="cliente_apepat" name="cliente_apepat" v-model="vm_apepat" autocomplete="off" v-on:keyup="changeApePat($event)">

                                        <span v-if="allerros.vm_apepat" class="text-danger">{{ allerros.vm_apepat[0] }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cliente_apemat" class="col-form-label">A.Materno</label>
                                        <input type="text" class="form-control form-control-md" id="cliente_apemat" name="cliente_apemat" v-model="vm_apemat" autocomplete="off" v-on:keyup="changeApeMat($event)">

                                        <span v-if="allerros.vm_apemat" class="text-danger">{{ allerros.vm_apemat[0] }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_nombres" class="col-form-label">Nombres</label>
                                        <input type="text" class="form-control form-control-md" id="cliente_nombres" name="cliente_nombres" v-model="vm_nombres" autocomplete="off" v-on:keyup="changeNombres($event)">

                                        <span v-if="allerros.vm_nombres" class="text-danger">{{ allerros.vm_nombres[0] }}</span>
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>


                        <div class="form-group row" style="margin-top: -30px">
                            
                            <div class="col-12 " >
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="cliente_rsocial" class="col-form-label">Razón Social</label>

                                        <input type="text" class="form-control form-control-md" id="cliente_rsocial" name="cliente_rsocial" v-model="vm_razonsocial" autocomplete="off" v-on:keyup="changeRazonSocial($event)">

                                        <span v-if="allerros.vm_razonsocial" class="text-danger">{{ allerros.vm_razonsocial[0] }}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cliente_ncomercial" class="col-form-label">Nombre Comercial</label>

                                        <input type="text" class="form-control form-control-md" id="cliente_ncomercial" name="cliente_ncomercial" v-model="vm_nombrecomercial" autocomplete="off" v-on:keyup="changeNombreComercial($event)">

                                        <span v-if="allerros.vm_nombrecomercial" class="text-danger">{{ allerros.vm_nombrecomercial[0] }}</span>
                                    </div>

                                    
                                </div>
                                
                            </div>

                        </div>

                        <div class="form-group row " style="margin-top: -30px">
                            
                            <div class="col-12 " >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cliente_direccion" class="col-form-label">Dirección</label>

                                        <input type="text" class="form-control form-control-md" id="cliente_direccion" name="cliente_direccion" v-model="vm_direccion" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cliente_referencia" class="col-form-label">Referencia</label>

                                        <input type="text" class="form-control form-control-md" id="cliente_referencia" name="cliente_referencia" v-model="vm_referencia" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_pais" class="col-form-label">Pais</label>
                                        
                                         <Select2 id="cliente_pais" name="cliente_pais" v-model="vm_pais" :options="this.paises_prop" v-on:change="changePais($event)"/>

                                         <span v-if="allerros.vm_pais" class="text-danger">{{ allerros.vm_pais[0] }}</span>
                                        
                                    </div>

                                    
                                </div>
                                
                            </div>

                        </div>


                        <div class="form-group row " style="margin-top: -30px">
                            
                            <div class="col-12 " >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cliente_ubigeo" class="col-form-label">Ubigeo</label>

                                        <Select2  id="autocompletar_ubigeo"  data-toggle="select2" v-model="selected_ubigeo" @change="onChangeUbigeo($event)" />

                                        <span v-if="allerros.selected_ubigeo" class="text-danger " >{{ allerros.selected_ubigeo[0] }}</span>

                                        
                                       
                                       

                                        



                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cliente_ocupacion" class="col-form-label">Ocupacion</label>


                                        <Select2 id="cliente_ocupacion" name="cliente_ocupacion" v-model="vm_ocupacion" :options="this.ocupacion_prop"  v-on:change="changeOcupacion($event)"/>

                                        <span v-if="allerros.vm_ocupacion" class="text-danger">{{ allerros.vm_ocupacion[0] }}</span>
                                        
                                            
                                    </div>

                                    

                                    <div class="form-group col-md-4">
                                        <label for="cliente_residencia" class="col-form-label">Residencia/Dpto</label>

                                        <Select2 id="cliente_residencia" name="cliente_residencia" v-model="vm_residencia" :options="this.departamentos_prop" v-on:change="changeDepartamento($event)" />

                                        <span v-if="allerros.vm_residencia" class="text-danger">{{ allerros.vm_residencia[0] }}</span>
                                        
                                        
                                    </div>

                                    
                                </div>
                                
                            </div>

                        </div>

                    


                       


                        


                        <div class="form-group row " style="margin-top: -10px">
                            <label for="cliente_observacion" class="col-3 col-form-label d-none d-sm-block">Observación</label>
                            <div class="col-12 col-sm-9">
                                
                               

                               <textarea id="cliente_observacion" name="cliente_observacion" class="form-control textarea-plugin" maxlength="225" rows="2" placeholder="Ingrese una observacón (255 carateres como maximo)." v-model="vm_observacion"></textarea>


                               <span v-if="allerros.vm_observacion" class="text-danger">{{ allerros.vm_observacion[0] }}</span>
                            </div>
                        </div>

                         </fieldset>

                    </div>
                    


                    <div class="col-12 col-lg-4 margin-top-negative-10">
                        
                        <fieldset class="border p-2">
                        <legend  class="w-auto"><h5>Complemento</h5></legend>
                    
                        

                        <div class="form-group row mb-1 margin-top-negative-10 ">
                            <label for="cliente_sexo" class="col-3 col-form-label">Sexo</label>
                            <div class="col-9">

                                <Select2 id="cliente_sexo" name="cliente_sexo" v-model="vm_sexo" :options="this.options_sexo" v-on:change="changeSexo($event)"/>

                                <span v-if="allerros.vm_sexo" class="text-danger">{{ allerros.vm_sexo[0] }}</span>


                                
                            </div>
                        </div>
                         <div class="form-group row mb-1">
                            <label for="cliente_ecivil" class="col-3 col-form-label">E.Civil</label>
                            <div class="col-9">

                                <Select2 id="cliente_ecivil" name="cliente_ecivil" v-model="vm_ecivil" :options="this.ecivil_prop" v-on:change="changeEstadoCivil($event)" />

                                <span v-if="allerros.vm_ecivil" class="text-danger">{{ allerros.vm_ecivil[0] }}</span>

                                
                            </div>
                        </div>
                         <div class="form-group row mb-1 mt-2">
                            <label for="cliente_fenac" class="col-3 col-form-label"><small>Nacimiento</small></label>

                            <div class="input-group col-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  badge-info" id="" style="height:27px" >{{this.anios}}</span>
                                </div>
                                    <input type="date" class="form-control form-control-sm" id="cliente_fenac" name="cliente_fenac" v-model="vm_nacimiento" @change="calculaEdad($event)">

                                    <span v-if="allerros.vm_nacimiento" class="text-danger">{{ allerros.vm_nacimiento[0] }}</span>
                                                    
                            </div>
                            
                        </div>
                         <div class="form-group row mb-1">
                            <label for="cliente_estado" class="col-3 col-form-label">Estado</label>
                            <div class="col-9">

                                <Select2 id="cliente_estado" name="cliente_estado" v-model="vm_estado" :options="this.options_estado" v-on:change="changeEstado($event)"/>

                                <span v-if="allerros.vm_estado" class="text-danger">{{ allerros.vm_estado[0] }}</span>


                               
                            </div>
                        </div>
                         <div class="form-group row mb-2 mt-2">
                            <label for="cliente_feingreso" class="col-3 col-form-label">Ingreso</label>
                            <div class="col-9">
                                <input type="date" class="form-control form-control-sm" id="cliente_feingreso" name="cliente_feingreso" v-model="vm_feingreso">
                            </div>
                        </div>

                        <div class="form-group row mb-2 mt-2">
                            <label for="cliente_inubicable" class="col-3 col-form-label">Inubicable</label>
                            



                            

                            <div class="col-9 custom-control custom-switch mt-1 ">
 
                                 &nbsp; &nbsp;

                                <input   type="checkbox" class="custom-control-input " id="cliente_inubicable" name="cliente_inubicable"   v-model="vm_inubicable">

                                

                                <label class="custom-control-label" for="cliente_inubicable"></label>

                                
                            </div>

                           
                        </div>
                        
                        <div class="border-top  mt-2"></div>
                        <h5 class="">Contactos</h5>
                        <div id="accordion" class="mb-1 mt-2">
                                    
                                    
                                    <div class="card mb-1">
                                        <div class="card-header p-2" id="headingThree">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                                    <i class="mdi mdi-send-circle mr-1 text-primary"></i> 
                                                    Contacto #1
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body pb-1">
                                               
                                               <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto1_fijo" class="col-3 col-form-label"><i class="la la-phone d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Fijo</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto1_fijo" name="cliente_contacto1_fijo" placeholder="Fijo" data-toggle="input-mask" data-mask-format="000-0000" maxlength="8" v-model="vm_fijo_contacto1" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto1_movil" class="col-3 col-form-label"><i class="la la-mobile d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Movil</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto1_movil" name="cliente_contacto1_movil" placeholder="Celular"data-toggle="input-mask" data-mask-format="000-000-000" maxlength="11" v-model="vm_movil_contacto1" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto1_email" class="col-3 col-form-label"><i class="la la-envelope d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Email</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto1_email" name="cliente_contacto1_email" placeholder="Email" v-model="vm_email_contacto1" autocomplete="off">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="card mb-1">
                                        <div class="card-header p-2" id="headingFour">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                                    <i class="mdi mdi-send-circle mr-1 text-primary"></i> 
                                                    Contacto #2
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="collapseFour" data-parent="#accordion">
                                            <div class="card-body pb-1">
                                               
                                               <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto2_fijo" class="col-3 col-form-label"><i class="la la-phone d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Fijo</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto2_fijo" name="cliente_contacto2_fijo" placeholder="Fijo"data-toggle="input-mask" data-mask-format="000-0000" maxlength="8" v-model="vm_fijo_contacto2" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto2_movil" class="col-3 col-form-label"><i class="la la-mobile d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Movil</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto2_movil" name="cliente_contacto2_movil" placeholder="Celular"data-toggle="input-mask" data-mask-format="000-000-000" maxlength="11" v-model="vm_movil_contacto2" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto2_email" class="col-3 col-form-label"><i class="la la-envelope d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Email</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto2_email" name="cliente_contacto2_email" placeholder="Email" v-model="vm_email_contacto2" autocomplete="off">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <!-- ultimo contacto -->
                                    <div class="card mb-1">
                                        <div class="card-header p-2" id="headingFive">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseFive" aria-expanded="false">
                                                    <i class="mdi mdi-send-circle mr-1 text-primary"></i> 
                                                    Contacto #3
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-labelledby="collapseFive" data-parent="#accordion">
                                            <div class="card-body pb-1">
                                               
                                               <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto3_fijo" class="col-3 col-form-label"><i class="la la-phone d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Fijo</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto3_fijo" name="cliente_contacto3_fijo" placeholder="Fijo"data-toggle="input-mask" data-mask-format="000-0000" maxlength="8" v-model="vm_fijo_contacto3" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto3_movil" class="col-3 col-form-label"><i class="la la-mobile d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Movil</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto3_movil" name="cliente_contacto3_movil" placeholder="Celular"data-toggle="input-mask" data-mask-format="000-000-000" maxlength="11" v-model="vm_movil_contacto3" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group row margin-top-negative-10">
                                                    <label for="cliente_contacto3_email" class="col-3 col-form-label"><i class="la la-envelope d-block d-sm-none"></i><span class="d-none d-sm-block"><small>Email</small></span></label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control form-control-sm" id="cliente_contacto3_email" name="cliente_contacto3_email" placeholder="Email" v-model="vm_email_contacto3" autocomplete="off">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end #accordions-->


                        
                        </fieldset> 

                    </div>

                </div>
                    
                    
                    
                
                </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="la la-close mr-1"></i>Cancelar</button>

                <button type="submit" form="CreateFormCliente" class="btn btn-success waves-effect waves-light"><i class="la la-check mr-1"></i>Aceptar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    
</div><!-- /.modal -->


<!-- fin de modal de registro -->
                
<!-- modal de servicios aseguradora -->

<div id="modal-plan-seguro" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="servicesModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="servicesModal">

                    <img v-if="this.empresauser_prop == '001'" height="25" width="100" src="imagenes/criocord_logo.png">
                    
                    <img v-else-if="this.empresauser_prop == '002'" height="23" width="110" src="imagenes/lazo_de_vida_logo.png">

                   

                    &nbsp;
                    <span class="badge badge-purple badge-pill">Planes de Seguro</span></h4>
                       

                    <div >
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          
                        <button type="button" class=" btn btn-success btn-sm resize-button" ><i class="fa fa-plus icon-right mr-1"></i>Nuevo</button>
                    </div>
                         

            </div>
            
            <div class="modal-body">
                        
                 <div class="row">
                    <div class="col-12">
                         <div class="card">
                            <div class="card-body">  
                                
                                <table id="table_plan_seguro" class="table dt-responsive nowrap" style="width: 100%" > 

                                    <thead class="thead-light">
                                            <tr >
                                            
                                                <th>Código</th>
                                                <th>Descripción del Plan</th>
                                                <th>% Cobertura</th>
                                            </tr>
                                    </thead>
                                        
                                    <tbody>

                                                
                                        <tr>
                                            <td>Howard Hatfield</td>
                                            <td>Office Manager</td>
                                            <td>San Francisco</td>
                                        </tr>

                                        <tr>
                                            <td>Howard Hatfield</td>
                                            <td>Office Manager</td>
                                            <td>San Francisco</td>
                                        </tr>
                                                
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- fin modal aseguradora -->



</div> <!-- content -->


</template>

<script>



//datatable
import datatable from 'datatables.net-bs4';

//jquery
import $ from 'jquery';


//select2

import Select2 from 'v-select2-component';


//boton responsive datatable
require( 'datatables.net-responsive-bs4' );


import axios from 'axios'



export default {
   props: ["categorias_prop","clasecliente_prop","documentos_prop","ecivil_prop","ocupacion_prop","paises_prop","departamentos_prop","empresauser_prop"],

   components: {
            Select2
    },
   data(){

    return {select_categoria:0,
            select_cliente:'',
            msg: 'cargando..',
            html: '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>',
            activaUi:false ,
            tabla_clientes:[],
            //variables modal
            selected_ubigeo:'',
       
       anios:'',
       vm_inubicable:false,
       vm_documento:'',
        vm_ndocumento:' ',
        vm_tcliente:'',
        vm_apepat:'',
        vm_apemat:'',
        vm_nombres:'',
        vm_razonsocial:'',
        vm_nombrecomercial:'',
        vm_direccion:'',
        vm_referencia:'',
        vm_pais:'',
        
        vm_ocupacion:'',
        vm_residencia:'',
        vm_observacion:'',
        vm_sexo:'',
        vm_ecivil:'',
        vm_nacimiento:'',
        vm_estado:'',
        vm_feingreso:'',
        vm_fijo_contacto1:'',
        vm_movil_contacto1:'',
        vm_email_contacto1:'',
        vm_fijo_contacto2:'',
        vm_movil_contacto2:'',
        vm_email_contacto2:'',
        vm_fijo_contacto3:'',
        vm_movil_contacto3:'',
        vm_email_contacto3:'',
        
        options_sexo:[{id:'M',text:'MASCULINO'},{id:'F',text:'FEMENINO'},{id:'E',text:'EMPRESA'}],
        options_estado:[{id:'ACT',text:'ACTIVO'},{id:'INC',text:'INACTIVO'},{id:'PEN',text:'PROCESO'}],
        allerros:[],
        result_get_item:[]
           
            
           }
   },
   mounted() {
            
        
        $('#autocompletar_cliente').select2({
        language: {

            noResults: function() {

                return "No se encontraron resultados";        
            },
            searching: function() {

                return "Buscando..";
            },
            inputTooShort: function () {
                return "Ingrese 5 carateres como mínimo";
            }
        },

        minimumInputLength: 5,
        placeholder: 'Buscar Cliente..',
        ajax: {
            url: this.$base_url+'/filter_cliente',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
        });

        $('#autocompletar_ubigeo').select2({
        language: {

            noResults: function() {

                return "No se encontraron resultados";        
            },
            searching: function() {

                return "Buscando..";
            },
            inputTooShort: function () {
                return "Ingrese 5 carateres como mínimo";
            }
        },

        minimumInputLength: 5,
        placeholder: 'Buscar Ubigeo..',
        ajax: {
            url: this.$base_url+'/filter_ubigeo',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
        });

        this.list_table_cliente(this.select_cliente,this.select_categoria);
    
    },
    watch: {
       
    },
   created(){

   
    
    
    },methods:{

        setDataTableCliente(){

            this.$nextTick(() => {

                $("#table_list_cliente").DataTable({

                     
                    language: {

                     "url": "js/jsApp/idioma-es-datatable.json"

                    },"drawCallback": function(settings) {

                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")

                    }
                });

            })

            
        },
    

        list_table_cliente(cliente,categoria){

        $('#table_list_cliente').DataTable().destroy();

            this.activaUi=true;

            axios.get(this.$base_url + '/list_cliente',{

                params:{

                    cliente:cliente,
                    categoria:categoria
                }
            })
            .then(response => {

                this.tabla_clientes = response.data;
                this.activaUi=false;
                this.setDataTableCliente();

            })
            .catch(error => {

                this.activaUi=false;
                Vue.$toast.error(error.response);

            })


    },
    onChangeCategoria(){

        
        
        const cliente = this.select_cliente;
        const categoria = event.target.value;
        this.list_table_cliente(cliente,categoria);
        
    },onChangeCliente(){

        
        const categoria = this.select_categoria;
        const cliente = this.select_cliente;
        
        this.list_table_cliente(cliente,categoria);
        
    },resetea_cliente(){

        this.select_cliente='';

    },get_modal_edit(identificacion){

        this.activaUi=true;

        this.clear_all_errors();

        axios.get(this.$base_url + '/get_item_cliente', {


                    params: {

                        documento: identificacion
                    }
                })
                .then(response => {

                    this.activaUi=false;

                    this.result_get_item = response.data;

                    
                    if(this.result_get_item[0].INUBICABLE=="N"){

                        this.vm_inubicable=false;

                    }else if(this.result_get_item[0].INUBICABLE=="S"){

                        this.vm_inubicable=true;

                    }
                    
                    this.selected_ubigeo = this.result_get_item[0].UBIGEO;
                    this.vm_documento=this.result_get_item[0].CODIGO_DOCUMENTO;
                    this.vm_ndocumento=this.result_get_item[0].IDENTIFICACION;
                    this.vm_tcliente=this.result_get_item[0].CLASE_CLIENTE;
                    this.vm_apepat=this.result_get_item[0].APATERNO;
                    this.vm_apemat=this.result_get_item[0].AMATERNO;
                    this.vm_nombres=this.result_get_item[0].NOMBRE_CORTO;
                    this.vm_razonsocial=this.result_get_item[0].NOMBRE;
                    this.vm_nombrecomercial=this.result_get_item[0].ALIAS;
                    this.vm_direccion=this.result_get_item[0].DIRECCION;
                    this.vm_referencia=this.result_get_item[0].REFERENCIA_DE_UBICACION;
                    this.vm_pais=this.result_get_item[0].CODIGO_PAIS;
        
                    this.vm_ocupacion=this.result_get_item[0].OCUPACION;
                    this.vm_residencia=this.result_get_item[0].LOCALIDAD;
                    this.vm_observacion=this.result_get_item[0].OBSERVACIONES;
                    this.vm_sexo=this.result_get_item[0].SEXO;
                    this.vm_ecivil=this.result_get_item[0].ESTADO_CIVIL;
                    this.vm_nacimiento=this.result_get_item[0].FECHA_NACIMIENTO;
                    this.vm_estado=this.result_get_item[0].ESTADO;
                    this.vm_feingreso=this.result_get_item[0].FECHA_INGRESO;
                    this.vm_fijo_contacto1=this.result_get_item[0].TELEFONO_CONTACTO;
                    this.vm_movil_contacto1=this.result_get_item[0].CELULAR_CONTACTO;
                    this.vm_email_contacto1=this.result_get_item[0].MAIL_CONTACTO;
                    this.vm_fijo_contacto2=this.result_get_item[0].TELEFONO_CONTACTO2;
                    this.vm_movil_contacto2=this.result_get_item[0].CELULAR_CONTACTO2;
                    this.vm_email_contacto2=this.result_get_item[0].MAIL_CONTACTO2;
                    this.vm_fijo_contacto3=this.result_get_item[0].TELEFONO_CONTACTO3;
                    this.vm_movil_contacto3=this.result_get_item[0].CELULAR_CONTACTO3;
                    this.vm_email_contacto3=this.result_get_item[0].MAIL_CONTACTO3;
                    
                    this.$nextTick(() => {
                        jQuery('#full-width-modal-cliente').modal('show');
                    });
                    
                    

                })
                .catch(error => {

                    this.activaUi=false;
                    
                    Vue.$toast.error(error.response);
                })
        

    },
    calculaEdad(event){

            const fecha = event.target.value ;

            const birthday = fecha.split('-').reverse().join('/');
            

            let birthday_arr = birthday.split("/");
            let birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
            let ageDifMs = Date.now() - birthday_date.getTime();
            let ageDate = new Date(ageDifMs);

            const result = Math.abs(ageDate.getUTCFullYear() - 1970);
            
            this.anios = result ;

             if( typeof this.allerros.vm_nacimiento!="undefined"){

                this.allerros.vm_nacimiento[0]='';
                         
            }
            
             
            
        },SalvarCliente() {


            

            axios.post(this.$base_url +'/save_cliente', {

               
                vm_documento: this.vm_documento,
                vm_ndocumento: this.vm_ndocumento,
                vm_tcliente: this.vm_tcliente,
                vm_apepat: this.vm_apepat,
                vm_apemat: this.vm_apemat,
                vm_nombres: this.vm_nombres,
                vm_razonsocial: this.vm_razonsocial,
                vm_nombrecomercial: this.vm_nombrecomercial,
                vm_direccion: this.vm_direccion,
                vm_referencia: this.vm_referencia,
                vm_pais: this.vm_pais,
               
                vm_ocupacion: this.vm_ocupacion,
                vm_residencia: this.vm_residencia,
                vm_observacion: this.vm_observacion,
                vm_sexo: this.vm_sexo,
                vm_ecivil: this.vm_ecivil,
                vm_nacimiento: this.vm_nacimiento,
                vm_estado: this.vm_estado,
                vm_feingreso: this.vm_feingreso,
                vm_fijo_contacto1: this.vm_fijo_contacto1,
                vm_movil_contacto1: this.vm_movil_contacto1,
                vm_email_contacto1: this.vm_email_contacto1,
                vm_fijo_contacto2: this.vm_fijo_contacto2,
                vm_movil_contacto2: this.vm_movil_contacto2,
                vm_email_contacto2: this.vm_email_contacto2,
                vm_fijo_contacto3: this.vm_fijo_contacto3,
                vm_movil_contacto3: this.vm_movil_contacto3,
                vm_email_contacto3: this.vm_email_contacto3,
                vm_inubicable:this.vm_inubicable,
                
                selected_ubigeo:this.selected_ubigeo


            }).then(response => {
        
                
                if(response.data.status == "warning"){

                    this.allerros = response.data.data;

                }else if(response.data.status=="error"){

                    Vue.$toast.error(response.data.description);

                }else if(response.data.status=="ok"){

                    Vue.$toast.success(response.data.description);

                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 200);

                }

            }).catch(error => {
                
                Vue.$toast.error(error.response);
            })  

                //limpiar variables
                
               
                
            },changeTipoDocumento(){
                
                if( typeof this.allerros.vm_documento!="undefined"){

                    this.allerros.vm_documento[0]='';
                         
                }
            },changeClaseCliente(){

                if( typeof this.allerros.vm_tcliente!="undefined"){

                    this.allerros.vm_tcliente[0]='';
                         
                }

            },changeNumeroDocumento(){

                if( typeof this.allerros.vm_ndocumento!="undefined"){

                    this.allerros.vm_ndocumento[0]='';
                         
                }

            },changeApePat(){

                 if( typeof this.allerros.vm_apepat!="undefined"){

                    this.allerros.vm_apepat[0]='';
                         
                }
            },changeApeMat(){

                 if( typeof this.allerros.vm_apemat!="undefined"){

                    this.allerros.vm_apemat[0]='';
                         
                }
            },changeNombres(){

                 if( typeof this.allerros.vm_nombres!="undefined"){

                    this.allerros.vm_nombres[0]='';
                         
                }
            },changePais(){

                if( typeof this.allerros.vm_pais!="undefined"){

                    this.allerros.vm_pais[0]='';
                         
                }

            },changeOcupacion(){

                if( typeof this.allerros.vm_ocupacion!="undefined"){

                    this.allerros.vm_ocupacion[0]='';
                         
                }

            },changeDepartamento(){

                if( typeof this.allerros.vm_residencia!="undefined"){

                    this.allerros.vm_residencia[0]='';
                         
                }

            },changeSexo(){

                if( typeof this.allerros.vm_sexo!="undefined"){

                    this.allerros.vm_sexo[0]='';
                         
                }

            },changeEstadoCivil(){

                if( typeof this.allerros.vm_ecivil!="undefined"){

                    this.allerros.vm_ecivil[0]='';
                         
                }

            },changeEstado(){

                if( typeof this.allerros.vm_estado!="undefined"){

                    this.allerros.vm_estado[0]='';
                         
                }

            },changeRazonSocial(){

               if( typeof this.allerros.vm_razonsocial!="undefined"){

                    this.allerros.vm_razonsocial[0]='';
                         
                } 
            },changeNombreComercial(){

               if( typeof this.allerros.vm_nombrecomercial!="undefined"){

                    this.allerros.vm_nombrecomercial[0]='';
                         
                } 
            },
             onChangeUbigeo(){

                if( typeof this.allerros.selected_ubigeo!="undefined"){

                    this.allerros.selected_ubigeo[0]='';
                         
                } 


            },searchCliente(){

   

                const documento = this.vm_ndocumento;

                if(documento.trim()==""){

                    Vue.$toast.error('Ingrese un número de documento');


                }else{

                    this.activaUi=true;
                
                    axios.get(this.$base_url +'/search_cliente', {
                        params: {
                            documento: documento
                        }
                    })
                    .then(response=> {
                        
                        this.activaUi=false;

                        if(response.data.status == "ok"){

                            
                            Vue.$toast.success(response.data.description);

                            const result_get_item_api = response.data.data;

                    
                            if(result_get_item_api[0].INUBICABLE=="N"){

                                this.vm_inubicable=false;

                            }else if(result_get_item_api[0].INUBICABLE=="S"){

                                this.vm_inubicable=true;

                            }
                    
                            this.selected_ubigeo = result_get_item_api[0].UBIGEO;
                            this.vm_documento=result_get_item_api[0].CODIGO_DOCUMENTO;
                            this.vm_ndocumento=result_get_item_api[0].IDENTIFICACION;
                            this.vm_tcliente=result_get_item_api[0].CLASE_CLIENTE;
                            this.vm_apepat=result_get_item_api[0].APATERNO;
                            this.vm_apemat=result_get_item_api[0].AMATERNO;
                            this.vm_nombres=result_get_item_api[0].NOMBRE_CORTO;
                            this.vm_razonsocial=result_get_item_api[0].NOMBRE;
                            this.vm_nombrecomercial=result_get_item_api[0].ALIAS;
                            this.vm_direccion=result_get_item_api[0].DIRECCION;
                            this.vm_referencia=result_get_item_api[0].REFERENCIA_DE_UBICACION;
                            this.vm_pais=result_get_item_api[0].CODIGO_PAIS;
        
                            this.vm_ocupacion=result_get_item_api[0].OCUPACION;
                            this.vm_residencia=result_get_item_api[0].LOCALIDAD;
                            this.vm_observacion=result_get_item_api[0].OBSERVACIONES;
                            this.vm_sexo=result_get_item_api[0].SEXO;
                            this.vm_ecivil=result_get_item_api[0].ESTADO_CIVIL;
                            this.vm_nacimiento=result_get_item_api[0].FECHA_NACIMIENTO;
                            this.vm_estado=result_get_item_api[0].ESTADO;
                            this.vm_feingreso=result_get_item_api[0].FECHA_INGRESO;
                            this.vm_fijo_contacto1=result_get_item_api[0].TELEFONO_CONTACTO;
                            this.vm_movil_contacto1=result_get_item_api[0].CELULAR_CONTACTO;
                            this.vm_email_contacto1=result_get_item_api[0].MAIL_CONTACTO;
                            this.vm_fijo_contacto2=result_get_item_api[0].TELEFONO_CONTACTO2;
                            this.vm_movil_contacto2=result_get_item_api[0].CELULAR_CONTACTO2;
                            this.vm_email_contacto2=result_get_item_api[0].MAIL_CONTACTO2;
                            this.vm_fijo_contacto3=result_get_item_api[0].TELEFONO_CONTACTO3;
                            this.vm_movil_contacto3=result_get_item_api[0].CELULAR_CONTACTO3;
                            this.vm_email_contacto3=result_get_item_api[0].MAIL_CONTACTO3;

                            this.clear_all_errors();

                        }else if(response.data.status == "error"){

                            Vue.$toast.error(response.data.description);

                        }
                    })
                    .catch( error => {

                        this.activaUi=false;

                        Vue.$toast.error(error);
                    })

                }
                    
            },clear_all_errors(){

                if( typeof this.allerros.vm_documento!="undefined"){

                    this.allerros.vm_documento[0]='';
                         
                }

                if( typeof this.allerros.vm_tcliente!="undefined"){

                    this.allerros.vm_tcliente[0]='';
                         
                }

                if( typeof this.allerros.vm_ndocumento!="undefined"){

                    this.allerros.vm_ndocumento[0]='';
                         
                }

                if( typeof this.allerros.vm_apepat!="undefined"){

                    this.allerros.vm_apepat[0]='';
                         
                }

                if( typeof this.allerros.vm_apemat!="undefined"){

                    this.allerros.vm_apemat[0]='';
                         
                }

                if( typeof this.allerros.vm_nombres!="undefined"){

                    this.allerros.vm_nombres[0]='';
                         
                }

                if( typeof this.allerros.vm_pais!="undefined"){

                    this.allerros.vm_pais[0]='';
                         
                }
                if( typeof this.allerros.vm_ocupacion!="undefined"){

                    this.allerros.vm_ocupacion[0]='';
                         
                }

                if( typeof this.allerros.vm_residencia!="undefined"){

                    this.allerros.vm_residencia[0]='';
                         
                }

                if( typeof this.allerros.vm_sexo!="undefined"){

                    this.allerros.vm_sexo[0]='';
                         
                }

                if( typeof this.allerros.vm_ecivil!="undefined"){

                    this.allerros.vm_ecivil[0]='';
                         
                }

                if( typeof this.allerros.vm_estado!="undefined"){

                    this.allerros.vm_estado[0]='';
                         
                }

                if( typeof this.allerros.vm_razonsocial!="undefined"){

                    this.allerros.vm_razonsocial[0]='';
                         
                } 

                if( typeof this.allerros.vm_nombrecomercial!="undefined"){

                    this.allerros.vm_nombrecomercial[0]='';
                         
                }

                if( typeof this.allerros.selected_ubigeo!="undefined"){

                    this.allerros.selected_ubigeo[0]='';
                         
                }

                if( typeof this.allerros.vm_nacimiento!="undefined"){

                    this.allerros.vm_nacimiento[0]='';
                         
                } 


            }
 
    }

}


</script>