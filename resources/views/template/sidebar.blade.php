
<ul class="metismenu" id="side-menu">

    <li class="menu-title">Navigation</li>

    <li>
        <a href="javascript: void(0);">
            <i class="la la-cog"></i>
            <span class="badge badge-info badge-pill float-right">1</span>
            <span> Mantenimientos </span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('/cliente')}}">Cliente</a>
            </li>
          
        </ul>
    </li>

    

    <li class="menu-title mt-2">Proceso</li>

    <li>

        <a href="javascript: void(0);">
            <i class="la la-briefcase"></i>
            <span> Contratos </span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            <li>
                
                <a href="{{url('/prospecto')}}" >Prospecto</a>

            </li>
            <li>

                <a href="{{url('/contrato')}}" >Contrato</a>
                
            </li>
           
        </ul>
    </li>

    

    <li>
        <a href="javascript: void(0);">
            <i class="la la-phone"></i>
            <span> Cobranzas </span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('/llamada')}}">LLamadas</a>
            </li>
            
        </ul>
    </li>

    

    
    <li class="menu-title mt-2">Configuracón</li>
    

    <li>
        <a href="javascript: void(0);">
            <i class="la la-lock"></i>
            <span> Seguridad </span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('/usuarios')}}">Usuarios</a>
            </li>

            <li>
                <a href="{{url('/roles')}}">Roles</a>
            </li>
            
        </ul>
    </li>


    
</ul>
