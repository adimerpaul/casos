<template>
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <!-- Button trigger modal -->
                    <button type="button" v-if="formu" class="btn btn-primary" @click="formulario" >
                        <i class="fa fa-plus"></i> Registrar planilla
                    </button>
                    <form v-else @submit.prevent="guardar">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Guardar</button>
                        <button @click="formulario" class="btn btn-danger"> <i class="fa fa-trash"></i> Cancelar</button>
                        <div class="form-group">
                            <label for="familia"  class="col-form-label">Familia</label>
                            <input id="familia" style="text-transform: uppercase;" name="familia" v-model="caso.familia" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="col-form-label">Direccion</label>
                            <input id="direccion" name="direccion" v-model="caso.direccion" type="text" class="form-control" required>
                        </div>

                    </form>
                    <div class="form-group">
                        <label class="col-form-label">Ubicacion</label>
                        <!--                        <div id="mapid" style="width: 100%; height: 200px;"></div>-->

                        <l-map
                            :zoom="zoom"
                            :center="center"
                            style="height: 200px;width: 100%"
                            @click="addMarker"
                        >
                            <l-tile-layer
                                :url="url"
                                :attribution="attribution"
                            />
                            <l-marker  :lat-lng="marker" ></l-marker>
                        </l-map>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Registros</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered ">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Familia</th>
                                    <th>opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in casos">
                                    <td>{{item.created_at}}</td>
                                    <td>{{item.familia}}</td>
                                    <td>
                                        <button @click="familia(item.id)" class="btn btn-warning p-0"><i class="fa fa-plus-circle"></i> Familiar </button>
                                        <button @click="familiaver(item.id)" class="btn btn-info p-0"><i class="fa fa-eye"></i> Ver Fami </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Familia</th>
                                    <th>opciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >PLANILLA DE RASTRILLAJE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in ver " :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.nombre}}</td>
                                <td><button @click="elidat(item.id);" class="btn btn-danger p-1"> <i class="fa fa-trash"></i></button></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"> <i class="fa fa-eye"></i> Ocultar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="familiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PLANILLA DE RASTRILLAJE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<!--                        <form class="form-inline">-->
<!--                            <div class="form-group">-->
<!--                                <label for="nombre" class="col-form-label">Nombre Completo</label>-->
<!--                                <input id="nombre" type="text"  class="form-control form-control-sm">-->
<!--                            </div>-->
<!--&lt;!&ndash;                            <div class="form-group row">&ndash;&gt;-->
<!--&lt;!&ndash;                                <div class="col-xs-6">&ndash;&gt;-->
<!--&lt;!&ndash;                                <label for="parentesco" class="col-form-label">Parentesco</label>&ndash;&gt;-->
<!--&lt;!&ndash;&lt;!&ndash;                                <input id="parentesco" type="text" value="Parentesco" class="form-control form-control-sm">&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;                                <select name="parentesco" id="parentesco" class="form-control form-control-sm">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="padres">padres</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="hijos">hijos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="abuelos">abuelos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="nietos">nietos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="hermanos">hermanos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="bisabuelos">bisabuelos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="bisnietos">bisnietos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="tíos">tíos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <option value="sobrinos">sobrinos</option>&ndash;&gt;-->
<!--&lt;!&ndash;                                </select>&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                <div class="col-xs-6">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <label for="celular" class="col-form-label">Nombre Completo</label>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <input id="celular" type="number" class="form-control form-control-sm">&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--                        </form>-->
                        <form class="needs-validation" @submit.prevent="insertdat">
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="nombre">Nombre completo</label>
                                    <input type="text" style="text-transform: uppercase;" class="form-control" v-model="dat.nombre" id="nombre" required>
                                </div>
                                <div class="col-6">
                                    <label for="parentesco" class="col-form-label">Parentesco</label>
                                    <select name="parentesco" id="parentesco" v-model="dat.parentesco" class="form-control">
                                        <option value="padres">padres</option>
                                        <option value="hijos">hijos</option>
                                        <option value="abuelos">abuelos</option>
                                        <option value="nietos">nietos</option>
                                        <option value="hermanos">hermanos</option>
                                        <option value="bisabuelos">bisabuelos</option>
                                        <option value="bisnietos">bisnietos</option>
                                        <option value="tíos">tíos</option>
                                        <option value="sobrinos">sobrinos</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="celular" class="col-form-label">Celular</label>
                                    <input type="text" class="form-control" v-model="dat.celular" id="celular" required>
                                </div>
                                <div class="col-6">
                                    <label for="fecha" class="col-form-label">Fecha nac.</label>
                                    <input type="date" class="form-control" id="fecha" v-model="dat.fecha" required>
                                </div>
                            </div>
                            <div style="text-align: center">CLINICA COVID 19 </div>
                            <div class="form-row">
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Fiebre</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.fiebre" class="custom-control-input"><span class="custom-control-label">{{dat.fiebre==undefined || !dat.fiebre?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Tos seca</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.tos" class="custom-control-input"><span class="custom-control-label">{{dat.tos==undefined || !dat.tos?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Fatiga</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.fatiga" class="custom-control-input"><span class="custom-control-label">{{dat.fatiga==undefined || !dat.fatiga?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Cong. Nasal</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.congestion" class="custom-control-input"><span class="custom-control-label">{{dat.congestion==undefined || !dat.congestion?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Dolor Musc</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.muscular" class="custom-control-input"><span class="custom-control-label">{{dat.muscular==undefined || !dat.muscular?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Dolor Garg.</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.garganta" class="custom-control-input"><span class="custom-control-label">{{dat.garganta==undefined || !dat.garganta?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Cafe. Fron.</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.cafe" class="custom-control-input"><span class="custom-control-label">{{dat.cafe==undefined || !dat.cafe?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Nauseas</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.nauseas" class="custom-control-input"><span class="custom-control-label">{{dat.nauseas==undefined || !dat.nauseas?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Diarrea</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.diarrea" class="custom-control-input"><span class="custom-control-label">{{dat.diarrea==undefined || !dat.diarrea?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Escalofrios</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.escalofrios" class="custom-control-input"><span class="custom-control-label">{{dat.escalofrios==undefined || !dat.escalofrios?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="display: block" >Difi. respi.</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.respiratoria" class="custom-control-input"><span class="custom-control-label">{{dat.respiratoria==undefined || !dat.respiratoria?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" >Otros</label>
                                    <input type="text" class="form-control" v-model="dat.otros" >
                                </div>
                            </div>
                            <div style="text-align: center">NEXO EPIDEMIOLOGICO </div>
                            <div class="form-row">
                                <div class="col-4">
                                    <label class="col-form-label" >A</label>
                                    <input type="text" class="form-control" v-model="dat.a" >
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" >B</label>
                                    <input type="text" class="form-control" v-model="dat.b" >
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" >C</label>
                                    <input type="text" class="form-control" v-model="dat.c" >
                                </div>
                            </div>
                            <div style="text-align: center">FACTORES DE RIESGO  </div>
                            <div class="form-row">
                                <div class="col-4">
                                    <label class="col-form-label" style="display: block" >enfer. pulmonar</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.enfermedad" class="custom-control-input"><span class="custom-control-label">{{dat.enfermedad==undefined || !dat.enfermedad?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" style="display: block" >embarazo</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.embarazo" class="custom-control-input"><span class="custom-control-label">{{dat.embarazo==undefined || !dat.embarazo?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" style="display: block" >inmunode.</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.inmunodepresion" class="custom-control-input"><span class="custom-control-label">{{dat.inmunodepresion==undefined || !dat.inmunodepresion?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" style="display: block" >daño hepático cróni</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.dano" class="custom-control-input"><span class="custom-control-label">{{dat.dano==undefined || !dat.dano?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" style="display: block" >Insu. renal cróni</label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="dat.insuficiencia" class="custom-control-input"><span class="custom-control-label">{{dat.insuficiencia==undefined || !dat.insuficiencia?'NO':'SI'}}</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label" >Otros</label>
                                    <input type="text" class="form-control" v-model="dat.otros2" >
                                </div>
                            </div>
                            <div style="text-align: center">DEFINA  </div>
                            <div class="form-row">
                                <div class="col-6">
                                    <label class="col-form-label" >caso sospecho A,B,C </label>
                                    <input type="text" class="form-control" v-model="dat.caso" >
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label" >caso no sospechoso</label>
                                    <input type="text" class="form-control" v-model="dat.casono" >
                                </div>
                                <div class="col-12">
                                    <label class="col-form-label" >Observaciones</label>
                                    <input type="text" class="form-control" v-model="dat.observaciones" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import { latLng } from "leaflet";
    import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";
    import $ from 'jquery';
    export default {
        name: "Example",
        components: {
            LMap,
            LTileLayer,
            LMarker,
        },
        created() {
            this.datos();
        },
        data() {
            return {
                dat:{},
                formu:true,
                caso:{},
                casos:[],
                ver:[],
                idver:0,
                zoom: 13,
                center: latLng(-17.975680, -67.106717),
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                // withPopup: latLng(47.41322, -1.219482),
                // withTooltip: latLng(47.41422, -1.250482),
                // currentZoom: 11.5,
                // currentCenter: latLng(47.41322, -1.219482),
                // showParagraph: false,
                marker: latLng(-17.975680, -67.106717),
                // showMap: true
            };
        },
        methods: {
            formulario(){
                this.formu=!this.formu;
            },
            addMarker(event) {
                // this.markers.push(event.latlng);
                // console.log(event.latlng);
                this.marker=event.latlng;
            },
            guardar(){
                this.caso.lat=this.marker.lat;
                this.caso.lng=this.marker.lng;
                axios.post('caso',this.caso).then(res=>{
                    // console.log(res)
                    this.datos();
                    this.caso={};
                    this.formu=!this.formu;
                    alert('Guardado correcto');
                })
            },
            datos(){
                axios.get('caso').then(res=>{
                    this.casos=res.data;
                    // console.log(res);
                })
            },
            familia(id){
                $('#familiar').modal('show');
                this.dat.caso_id=id;
                // console.log(this.dat.caso_id);
            },
            familiaver(id){
                $('#ver').modal('show');
                this.idver=id;
                this.datver();
            },
            datver(){
                axios.get('dato/'+this.idver).then(res=>{
                    // console.log(res);
                    this.ver=res.data;
                })
            },
            insertdat(){
                axios.post('dato',this.dat).then(res=>{
                    // console.log(res);
                    alert('Guardado correctamnte');
                    this.dat={};
                    $('#familiar').modal('hide');
                    // this.datos();
                    // this.caso={};
                    // this.formu=!this.formu;
                    // alert('Guardado correcto');
                })
            },
            elidat(id){
                if (confirm('Seguro de elminar?'))
                axios.delete('dato/'+id).then(res=>{
                    this.datver();
                })
            }
        }
    };
</script>
<style>
</style>
