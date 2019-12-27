@extends('principal')
@section('contenido')
@if(Auth::check())
    @if(Auth::user()->idrol == 1)
    <template v-if="menu==0">
        <dashboard></dashboard>
    </template>
    <template v-if="menu==1">
        <asignadosparami></asignadosparami>
    </template>
    <template v-if="menu==2">
        <mis_tickets></mis_tickets>
    </template>
    <template v-if="menu==3">
        <example-component></example-component>
    </template>
    <template v-if="menu==4">
         <misproyectos></misproyectos>
    </template>
    <template v-if="menu==5">
        <calendario></calendario>        
    </template>
    <template v-if="menu==6">
        <tickets></tickets>
    </template>
    <template v-if="menu==7">
        <solicitudes></solicitudes>
    </template>
    <template v-if="menu==8">
        <proyectos></proyectos>
    </template>
    <template v-if="menu==9">
        <example-component></example-component>
    </template>
    <template v-if="menu==10">
        <labores></labores>
    </template>
    <template v-if="menu==11">
        <hitos-comp></hitos-comp>
    </template>
    <template v-if="menu==12">
        <facturas></facturas>
    </template>
    <template v-if="menu==22">
        <metodospago></metodospago>
    </template>
    <template v-if="menu==13">
        <pagos></pagos>
    </template>
    <template v-if="menu==14">
        <articulos></articulos>
    </template>
    <template v-if="menu==15">
        <example-component></example-component>
    </template>
    <template v-if="menu==16">
        <example-component></example-component>
    </template>
    <template v-if="menu==17">
        <preguntas></preguntas>
    </template>
    <template v-if="menu==18">
        <menupaginas></menupaginas>
    </template>
    <template v-if="menu==19">
        <clientes></clientes>
    </template>
    <template v-if="menu==20">
        <roles-component></roles-component>
    </template>
    <template v-if="menu==21">
        <usuarios></usuarios>
    </template>
    @elseif(Auth::user()->idrol == 2)
    <template v-if="menu==0">
        <dashboard></dashboard>
    </template>
    <template v-if="menu==1">
        <asignadosparami></asignadosparami>
    </template>
    <template v-if="menu==2">
        <mis_tickets></mis_tickets>
    </template>
    <template v-if="menu==3">
        <example-component></example-component>
    </template>
    <template v-if="menu==4">
         <misproyectos></misproyectos>
    </template>
    <template v-if="menu==5">
        <calendario></calendario>        
    </template>
    <template v-if="menu==6">
        <tickets></tickets>
    </template>
    <template v-if="menu==7">
        <solicitudes></solicitudes>
    </template>
    <template v-if="menu==8">
        <proyectos></proyectos>
    </template>
    <template v-if="menu==9">
        <example-component></example-component>
    </template>
    <template v-if="menu==10">
        <labores></labores>
    </template>
    <template v-if="menu==11">
        <hitos-comp></hitos-comp>
    </template>
    <template v-if="menu==12">
        <facturas></facturas>
    </template>
    <template v-if="menu==22">
        <metodospago></metodospago>
    </template>
    <template v-if="menu==13">
        <pagos></pagos>
    </template>
    <template v-if="menu==14">
        <articulos></articulos>
    </template>
    <template v-if="menu==15">
        <example-component></example-component>
    </template>
    <template v-if="menu==16">
        <example-component></example-component>
    </template>
    <template v-if="menu==17">
        <preguntas></preguntas>
    </template>
    <template v-if="menu==18">
        <menupaginas></menupaginas>
    </template>
    <template v-if="menu==19">
        <clientes></clientes>
    </template>
    <template v-if="menu==20">
        <roles-component></roles-component>
    </template>
    <template v-if="menu==21">
        <usuarios></usuarios>
    </template>
    @elseif(Auth::user()->idrol == 3)
    <template v-if="menu==0">
        <dashboard></dashboard>
    </template>
    <template v-if="menu==1">
        <asignadosparami></asignadosparami>
    </template>
    <template v-if="menu==2">
        <mis_tickets></mis_tickets>
    </template>
    <template v-if="menu==3">
        <example-component></example-component>
    </template>
    <template v-if="menu==4">
         <misproyectos></misproyectos>
    </template>
    <template v-if="menu==5">
        <calendario></calendario>        
    </template>
    <template v-if="menu==6">
        <tickets></tickets>
    </template>
    <template v-if="menu==7">
        <solicitudes></solicitudes>
    </template>
    <template v-if="menu==8">
        <proyectos></proyectos>
    </template>
    <template v-if="menu==9">
        <example-component></example-component>
    </template>
    <template v-if="menu==10">
        <labores></labores>
    </template>
    <template v-if="menu==11">
        <hitos-comp></hitos-comp>
    </template>
    <template v-if="menu==12">
        <facturas></facturas>
    </template>
    <template v-if="menu==22">
        <metodospago></metodospago>
    </template>
    <template v-if="menu==13">
        <pagos></pagos>
    </template>
    <template v-if="menu==14">
        <articulos></articulos>
    </template>
    <template v-if="menu==15">
        <example-component></example-component>
    </template>
    <template v-if="menu==16">
        <example-component></example-component>
    </template>
    <template v-if="menu==17">
        <preguntas></preguntas>
    </template>
    <template v-if="menu==18">
        <menupaginas></menupaginas>
    </template>
    <template v-if="menu==19">
        <clientes></clientes>
    </template>
    <template v-if="menu==20">
        <roles-component></roles-component>
    </template>
    <template v-if="menu==21">
        <usuarios></usuarios>
    </template>
    @elseif(Auth::user()->idrol == 4)
    <template v-if="menu==0">
        <dashboard></dashboard>
    </template>
    <template v-if="menu==1">
        <asignadosparami></asignadosparami>
    </template>
    <template v-if="menu==2">
        <mis_tickets></mis_tickets>
    </template>
    <template v-if="menu==3">
        <example-component></example-component>
    </template>
    <template v-if="menu==4">
         <misproyectosC></misproyectosC>
    </template>
    <template v-if="menu==5">
        <calendario></calendario>        
    </template>
    <template v-if="menu==6">
        <tickets></tickets>
    </template>
    <template v-if="menu==7">
        <solicitudes></solicitudes>
    </template>
    <template v-if="menu==8">
        <proyectos></proyectos>
    </template>
    <template v-if="menu==9">
        <example-component></example-component>
    </template>
    <template v-if="menu==10">
        <labores></labores>
    </template>
    <template v-if="menu==11">
        <hitos-comp></hitos-comp>
    </template>
    <template v-if="menu==12">
        <facturas></facturas>
    </template>
    <template v-if="menu==22">
        <metodospago></metodospago>
    </template>
    <template v-if="menu==13">
        <pagos></pagos>
    </template>
    <template v-if="menu==14">
        <articulos></articulos>
    </template>
    <template v-if="menu==15">
        <example-component></example-component>
    </template>
    <template v-if="menu==16">
        <example-component></example-component>
    </template>
    <template v-if="menu==17">
        <preguntas></preguntas>
    </template>
    <template v-if="menu==18">
        <menupaginas></menupaginas>
    </template>
    <template v-if="menu==19">
        <clientes></clientes>
    </template>
    <template v-if="menu==20">
        <roles-component></roles-component>
    </template>
    <template v-if="menu==21">
        <usuarios></usuarios>
    </template>
    @else
    @endif
@endif
@endsection