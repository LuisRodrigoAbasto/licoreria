@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <dashboard></dashboard>
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

    <template v-if="menu==5">
        <pedido></pedido>
    </template>

    <template v-if="menu==6">
        <usuario></usuario>
    </template>
    
    
@endsection