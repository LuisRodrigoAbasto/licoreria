@extends('principal')
@section('contenido')
    <template v-if="menu==0">
    HOLA MUNDO
    {{-- <ubicacion></ubicacion> --}}
    </template>


    <template v-if="menu==1">
        <producto></producto>
    
    </template>

    <template v-if="menu==2">
        <categoria></categoria>
    </template>

    <template v-if="menu==3">
    <venta></venta>
    </template>

    <template v-if="menu==4">
        <cliente></cliente>
    </template>

    <template v-if="menu==6">
        <cliente></cliente>
    </template>

    <template v-if="menu==7">
        <ingreso></ingreso>
    </template>
    <template v-if="menu==8">
        <egreso></egreso>
    </template>

    <template v-if="menu==9">
        <cuenta></cuenta>
    </template>

    <template v-if="menu==10">
        <!-- <example-component></example-component> -->
    </template>

    <template v-if="menu==11">
        <h1>Contenido del menú 10</h1>
    </template>

    <template v-if="menu==12">
        <h1>Contenido del menú 11</h1>
    </template>

    <template v-if="menu==13">
        <h1>Contenido del menú 12</h1>
    </template>
    
@endsection