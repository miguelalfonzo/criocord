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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Seguridad</a></li>
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><span class="badge badge-dark badge-pill">Seguridad</span>&nbsp; <span class="badge badge-purple badge-pill"><i class="la la-user"></i>Usuarios</span></h4>



                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       <div class="row" style="margin-top: -15px">

                        <div class="col-12 col-sm-6">

                              <input type="text" name="search_usuarios" id="search_usuarios" class="form-control form-control-sm" placeholder="buscar">

                        </div>


                          <div class="col-12 col-sm-6 mt-1 mt-sm-0 ">

                            <div class="row">

                                <div class="col-8">

                                    <select v-model="flag_activo" class="selectpicker form-control form-control-sm" data-style="btn-outline-primary" id="cmb_filter_activo" name="cmb_filter_activo" @change="onChangeEstado($event)">

                                    <option value="2">TODOS</option>
                                    <option value="1">ACTIVOS</option>
                                    <option value="0">INACTIVOS</option>

                                                
                                    </select>
                                </div>

                                <div class="col-4">
                                    
                                    

                                     <button type="button" class="btn btn-sm btn-success waves-effect waves-light"  style="float:right"  v-on:click="get_modal_edit_usuario(0)"><i class="fas fa-plus mr-1"></i>Nuevo</button>

                                </div>
                            </div>
                            

                            

                          </div> 

                        

                    </div>

                    <BlockUI v-if="activaUi":message="msg" :html="html"></BlockUI>

                    <table id="tabla-usuarios" class="table dt-responsive nowrap mt-1" style="width: 100%">
                        <thead>
                            <tr>
                                <th><i class="la la-cog"></i></th>
                                <th>Dni</th>
                                <th>Nombres</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Estado</th>
                                
                                
                            </tr>
                        </thead>


                        <tbody>

                            <tr v-for="tabla_usuario in tabla_usuarios">
                                <td>
                                    

                                    

                                    <button @click="get_modal_edit_usuario(tabla_usuario.IDENTIFICACION)" type="button" class="btn btn-primary waves-effect waves-light btn-xs mr-1" ><i class="mdi mdi-pencil"></i></button>
                                </td>
                                <td>{{tabla_usuario.IDENTIFICACION}}</td>
                                <td>{{tabla_usuario.NAME}}</td>
                                <td>{{tabla_usuario.EMAIL}}</td>
                                <td>{{tabla_usuario.NOMBRE_CARGO}}</td>

                                <td v-if="tabla_usuario.FLAG_ACTIVO==1"><span class="badge badge-success"><i class="fas fa-lock-open mx-1"></i>ACTIVO</span></td>
                                
                                <td v-else-if="tabla_usuario.FLAG_ACTIVO==0"><span class="badge badge-danger"><i class="fas fa-lock mx-1"></i>INACTIVO</span></td>

                                <td v-else>
                                    
                                </td>

                                
                            </tr>

                        </tbody>
                    </table>


                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->





</div> <!-- container -->


<!-- modal de registro de usuario -->

<div id="modal_usuarios" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="labelledyUsuario" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="labelledyUsuario">

                    <img v-if="this.empresauser_prop == '001'" height="25" width="100" src="imagenes/criocord_logo.png">
                    
                    <img v-else-if="this.empresauser_prop == '002'" height="23" width="110" src="imagenes/lazo_de_vida_logo.png">

                   

                    &nbsp;
                    <span class="badge badge-purple badge-pill">Registro de Clientes</span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form class="form-horizontal" id="CreateFormUsuario" @submit.prevent="SalvarUsuario">

                <div class="modal-body">
                

                <div class="card-box text-center" style="padding: 0px">
                    <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0">{{this.vm_usuario_nombre}}</h4>
                    <p class="text-muted">{{this.vm_usuario_apepat}} {{this.vm_usuario_apemat}}</p>

                    <button type="button" class="btn btn-danger btn-xs waves-effect p-1 waves-light" @click="changeImagen()"><small>cambiar</small></button>

                    
                </div>

                    <div class="form-group row margin-top-negative-10">
                            
                            

                            <div class="col-12" >
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="usuario_dni" class="col-form-label">Dni</label>
                                       
                                       <div class="input-group">

                                            <input type="text" class="form-control form-control-md" id="usuario_dni" name="usuario_dni" v-model="vm_usuario_dni" autocomplete="off" v-on:keyup="changeInput('vm_usuario_dni')">
                                                    
                                            <div class="input-group-append">
                                                <button class="btn btn-dark waves-effect waves-light" type="button" v-on:click="searchUsuario()"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        
                                        <span v-if="allerros.vm_usuario_dni" class="text-danger">{{ allerros.vm_usuario_dni[0] }}</span>

                                        

                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="usuario_nombre" class="col-form-label">Nombres</label>
                                       
                                       <input type="text" class="form-control form-control-md" id="usuario_nombre" name="usuario_nombre" v-model="vm_usuario_nombre" autocomplete="off" v-on:keyup="changeInput('vm_usuario_nombre')">
                                        
                                        <span v-if="allerros.vm_usuario_nombre" class="text-danger">{{ allerros.vm_usuario_nombre[0] }}</span>

                                        

                                    </div>
                                    <div class="form-group col-md-4 margin-top-negative-10" >
                                        <label for="usuario_apepat" class="col-form-label">A.Paterno</label>

                                        <input type="text" class="form-control form-control-md" id="usuario_apepat" name="usuario_apepat" v-model="vm_usuario_apepat" autocomplete="off" v-on:keyup="changeInput('vm_usuario_apepat')">

                                        

                                        <span v-if="allerros.vm_usuario_apepat" class="text-danger">{{ allerros.vm_usuario_apepat[0] }}</span>

                                        
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_apemat" class="col-form-label">A.Materno</label>

                                        <input type="text" class="form-control form-control-md" id="usuario_apemat" name="usuario_apemat" v-model="vm_usuario_apemat" autocomplete="off" v-on:keyup="changeInput('vm_usuario_apemat')">

                                        <span v-if="allerros.vm_usuario_apemat" class="text-danger">{{ allerros.vm_usuario_apemat[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_direccion" class="col-form-label">Dirección</label>

                                        <input type="text" class="form-control form-control-md" id="usuario_direccion" name="usuario_direccion" v-model="vm_usuario_direcion" autocomplete="off" v-on:keyup="changeInput('vm_usuario_direcion')">

                                        <span v-if="allerros.vm_usuario_direcion" class="text-danger">{{ allerros.vm_usuario_direcion[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_telefono" class="col-form-label">Teléfono</label>

                                        <input type="text" class="form-control form-control-md" id="usuario_telefono" name="usuario_telefono" v-model="vm_usuario_telefono" autocomplete="off" v-on:keyup="changeInput('vm_usuario_telefono')">

                                        <span v-if="allerros.vm_usuario_telefono" class="text-danger">{{ allerros.vm_usuario_telefono[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_correo" class="col-form-label">Correo</label>

                                        <input type="text" class="form-control form-control-md" id="usuario_correo" name="usuario_correo" v-model="email" autocomplete="off" v-on:keyup="changeInput('email')">

                                        <span v-if="allerros.email" class="text-danger">{{ allerros.email[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_password" class="col-form-label">Password</label>

                                        <input type="password" class="form-control form-control-md disable-buton" id="usuario_password" name="usuario_password" v-model="vm_usuario_password" autocomplete="off" v-on:keyup="changeInput('vm_usuario_password')" readonly="true">

                                        <span v-if="allerros.vm_usuario_password" class="text-danger">{{ allerros.vm_usuario_password[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_cargo" class="col-form-label">Cargo</label>

                                         <Select2 id="usuario_cargo" name="usuario_cargo" v-model="vm_usuario_cargo" :options="this.cargos_prop" v-on:change="changeClaseCargos($event)"/>

                                        <span v-if="allerros.vm_usuario_cargo" class="text-danger">{{ allerros.vm_usuario_cargo[0] }}</span>
                            
                                    </div>

                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="usuario_estado" class="col-form-label">Estado</label>

                                         <Select2 id="usuario_estado" name="usuario_estado" v-model="vm_usuario_estado" :options="this.estados"/>

                                        
                            
                                    </div>


                                    <div class="form-group col-md-4 margin-top-negative-10">
                                        <label for="" class="col-form-label text-primary"><i class="fas fa-plus mr-1"></i>Usuario</label>

                                         <div class="checkbox checkbox-purple checkbox-circle mt-1">
                                                <input id="flag_otra_empresa" name="flag_otra_empresa" type="checkbox"  v-model="flag_otra_empresa">
                                                <label for="flag_otra_empresa">
                                                    <span v-if="this.empresauser_prop=='001'">Lazo de Vida</span>
                                                    <span v-else-if="this.empresauser_prop=='002'">Criocord</span>
                                                </label>
                                            </div>

                                        
                            
                                    </div>

                                    


                                    <div class="form-group col-12 col-sm-12 ">
                                        

                                        <p><i>A los nuevos usuarios se les enviará la contraseña via e-mail</i></p>
                            
                                    </div>

                                    

                                </div>
                                
                            </div>

                            
                        </div>
                 
                   
               </div>

               

               <div class="modal-footer" style="margin-top: -40px">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="la la-close mr-1"></i>Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="la la-check mr-1"></i>Aceptar</button>
                </div>

                </form>


           </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
<!-- fin de modal de registro de usuario-->



</div> <!-- content -->
</template>

<script>

    import datatable from 'datatables.net-bs4';
    import $ from 'jquery';
    import axios from 'axios'
    //select2

    import Select2 from 'v-select2-component';
    require( 'datatables.net-responsive-bs4' );

    export default {

         props: ['empresauser_prop','cargos_prop'],
         components: {
            Select2
        },
          data () {
            return {

                tabla_usuarios:[],
                flag_activo :1,
                msg: 'Cargando...',
                html: '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>',
                activaUi:false,
                vm_usuario_nombre:'',
                vm_usuario_apepat:'',
                vm_usuario_apemat:'',
                vm_usuario_dni:'',
                vm_usuario_direcion:'',
                vm_usuario_telefono:'',
                email:'',
                vm_usuario_password:'',
                vm_usuario_cargo:'',
                vm_usuario_estado:1,
                estados:[{id:1,text:'ACTIVO'},{id:0,text:'INACTIVO'}],
                allerros:[],
                flag_otra_empresa:false
                
            }
        },
        mounted() {
            
            this.LoadDataTableUsuario(this.flag_activo);

        },methods:{

            setDataTableUsuario(){

                this.$nextTick(() => {

                    $("#tabla-usuarios").DataTable({

                     
                        language: {

                        "url": "js/jsApp/idioma-es-datatable.json"

                        },"drawCallback": function(settings) {

                            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")

                        }
                    });

                })

            
            },

            LoadDataTableUsuario(flag_activo){

                $('#tabla-usuarios').DataTable().destroy();

                this.activaUi=true;

                axios.get(this.$base_url + '/list_usuarios',{

                    params:{

                        flag_activo:flag_activo
                    }
                })
                .then(response => {

                    this.tabla_usuarios = response.data;
                    this.activaUi=false;
                    this.setDataTableUsuario();

                })
                .catch(error => {

                    this.activaUi=false;
                    
                    Vue.$toast.error(error.response);

                })

            },
            get_modal_edit_usuario(dni){

                this.clear_all_errors();

                this.activaUi = true;

                 axios.get(this.$base_url + '/get_item_usuario',{

                    params:{

                        dni:dni
                    }
                })
                .then(response => {

                    this.activaUi = false;

                    const result_usuarios = response.data;
                    

                    this.vm_usuario_nombre=result_usuarios[0].NOMBRES;
                    this.vm_usuario_apepat=result_usuarios[0].APEPAT;
                    this.vm_usuario_apemat=result_usuarios[0].APEMAT;
                    this.vm_usuario_dni=result_usuarios[0].IDENTIFICACION;
                    this.vm_usuario_direcion=result_usuarios[0].DIRECCION;
                    this.vm_usuario_telefono=result_usuarios[0].TELEFONO;
                    this.email=result_usuarios[0].EMAIL;
                    this.vm_usuario_password=result_usuarios[0].PASSWORD;
                    this.vm_usuario_cargo=result_usuarios[0].CARGO;
                    this.vm_usuario_estado=result_usuarios[0].FLAG_ACTIVO;

                    this.$nextTick(() => {
                        jQuery('#modal_usuarios').modal('show');
                    });
                    

                })
                .catch(error => {

                    this.activaUi=false;
                    
                    Vue.$toast.error(error.response);

                })

            },onChangeEstado(){

                const val = event.target.value;

                this.LoadDataTableUsuario(val);

            },changeInput($tipo){


                if($tipo == 'vm_usuario_dni'){

                     if( typeof this.allerros.vm_usuario_dni!="undefined"){

                        this.allerros.vm_usuario_dni[0]='';
                         
                    }

                }else if($tipo == 'vm_usuario_nombre'){

                    if( typeof this.allerros.vm_usuario_nombre!="undefined"){

                        this.allerros.vm_usuario_nombre[0]='';
                         
                    }

                }else if($tipo == 'vm_usuario_apepat'){

                    if( typeof this.allerros.vm_usuario_apepat!="undefined"){

                        this.allerros.vm_usuario_apepat[0]='';
                         
                    }

                }else if($tipo == 'vm_usuario_apemat'){

                    if( typeof this.allerros.vm_usuario_apemat!="undefined"){

                        this.allerros.vm_usuario_apemat[0]='';
                         
                    }

                }else if($tipo == 'vm_usuario_direcion'){


                    if( typeof this.allerros.vm_usuario_direcion!="undefined"){

                        this.allerros.vm_usuario_direcion[0]='';
                         
                    }
                }else if($tipo == 'vm_usuario_telefono'){

                    if( typeof this.allerros.vm_usuario_telefono!="undefined"){

                        this.allerros.vm_usuario_telefono[0]='';
                         
                    }

                }else if($tipo == 'email'){

                    if( typeof this.allerros.email!="undefined"){

                        this.allerros.email[0]='';
                         
                    }

                }else if($tipo == 'vm_usuario_password'){

                    if( typeof this.allerros.vm_usuario_password!="undefined"){

                        this.allerros.vm_usuario_password[0]='';
                         
                    }
                }

            },changeClaseCargos(){

                if( typeof this.allerros.vm_usuario_cargo!="undefined"){

                        this.allerros.vm_usuario_cargo[0]='';
                         
                    }

            },clear_all_errors(){


                     if( typeof this.allerros.vm_usuario_dni!="undefined"){

                        this.allerros.vm_usuario_dni[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_nombre!="undefined"){

                        this.allerros.vm_usuario_nombre[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_apepat!="undefined"){

                        this.allerros.vm_usuario_apepat[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_apemat!="undefined"){

                        this.allerros.vm_usuario_apemat[0]='';
                         
                    }

                     if( typeof this.allerros.vm_usuario_direcion!="undefined"){

                        this.allerros.vm_usuario_direcion[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_telefono!="undefined"){

                        this.allerros.vm_usuario_telefono[0]='';
                         
                    }

                    if( typeof this.allerros.email!="undefined"){

                        this.allerros.email[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_password!="undefined"){

                        this.allerros.vm_usuario_password[0]='';
                         
                    }

                    if( typeof this.allerros.vm_usuario_cargo!="undefined"){

                        this.allerros.vm_usuario_cargo[0]='';
                         
                    }

            },SalvarUsuario(){

                axios.post(this.$base_url +'/save_usuario', {

               
               vm_usuario_nombre : this.vm_usuario_nombre,
                vm_usuario_apepat: this.vm_usuario_apepat,
                vm_usuario_apemat:  this.vm_usuario_apemat,
                vm_usuario_dni:  this.vm_usuario_dni,
                vm_usuario_direcion:   this.vm_usuario_direcion,
                vm_usuario_telefono:  this.vm_usuario_telefono,
                email:  this.email,
                vm_usuario_password:  this.vm_usuario_password,
                vm_usuario_cargo:  this.vm_usuario_cargo,
                vm_usuario_estado:  this.vm_usuario_estado,
                flag_otra_empresa :this.flag_otra_empresa
               

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


            },searchUsuario(){

                const documento = this.vm_usuario_dni;

                if(documento.trim() == ""){

                    Vue.$toast.error('Ingrese un número de dni');

                }else{

                    
                    this.clear_all_errors();

                    this.activaUi = true;

                    axios.get(this.$base_url + '/api_item_usuario',{

                        params:{

                            dni:documento
                        }
                    })
                    .then(response => {

                        this.activaUi = false;

                        
                        
                        if(response.data.status=="ok"){

                            Vue.$toast.success(response.data.description);

                            const result_usuarios = response.data.data;
                        this.vm_usuario_nombre=result_usuarios[0].NOMBRES;
                        this.vm_usuario_apepat=result_usuarios[0].APEPAT;
                        this.vm_usuario_apemat=result_usuarios[0].APEMAT;
                        this.vm_usuario_dni=result_usuarios[0].IDENTIFICACION;
                        this.vm_usuario_direcion=result_usuarios[0].DIRECCION;
                        this.vm_usuario_telefono=result_usuarios[0].TELEFONO;
                        this.email=result_usuarios[0].EMAIL;
                        this.vm_usuario_password=result_usuarios[0].PASSWORD;
                        this.vm_usuario_cargo=result_usuarios[0].CARGO;
                        this.vm_usuario_estado=result_usuarios[0].FLAG_ACTIVO;

                        }else if(response.data.status=="error"){

                             Vue.$toast.error(response.data.description);
                        }
                        


                    

                    })
                    .catch(error => {

                        this.activaUi=false;
                    
                        Vue.$toast.error(error.response);

                    })


                }
            },changeImagen(){


            }
        }
    }
</script>
