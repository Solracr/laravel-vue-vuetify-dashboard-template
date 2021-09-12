import Vue from 'vue'
import Router from 'vue-router'

//Dashboard Page Component
import Home from '../components/Dashboard/DashboardComponent.vue'
import MesaTrabajo from '../components/Dashboard/MesaTrabajo.vue'
import Empresa from '../components/Dashboard/PermisoEmpresa.vue'
import Casos from '../components/Dashboard/PermisoCaso.vue'
import Refugiado from '../components/Dashboard/PermisoRefugiado.vue'
import Minex from '../components/Dashboard/PermisoMinex.vue'
import UserComponent from "../components/Dashboard/UserComponent";
import ProfileComponent from "../components/Dashboard/ProfileComponent";
import CrearEmpresa from "../components/Dashboard/EmpresaComponent";
import WebServiceSat from "../components/Dashboard/Empresa/WebServiceSat";
import Form_Solicitud from "../components/Dashboard/Solicitud/FormSolicitud"
import Requisitos from "../components/Dashboard/Solicitud/Requisitos"

Vue.use(Router)

const router = new Router({
    routes: [        
        {
            path: "/",
            name: "Bandeja",
            component: Home,
            meta: {
                role: ['admin','user','analista'],
                icon: 'mdi-file-document',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/MesaTrabajo",
            name: "Mesa de Trabajo",
            component: MesaTrabajo,
            meta: {
                role: ['admin','analista'],
                icon: 'mdi-file-document',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/Empresa",
            name: "Permiso Empresa",
            component: Empresa,
            meta: {
                role: ['admin','user'],                
                icon: 'mdi-office-building',
                requiresAuth: true
            }
            , hidden: false
        },       
        {
            path: "/Casos",
            name: "Casos Especiales",
            component: Casos,
            meta: {
                role: ['admin','user'],                
                icon: 'mdi-nature-people',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/Regufiado",
            name: "Permiso Refugiado",
            component: Refugiado,
            meta: {
                role: ['admin','user'],                
                icon: 'mdi-flag-variant',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/Minex",
            name: "Permiso MINEX",
            component: Minex,
            meta: {
                role: ['admin','user'],                
                icon: 'mdi-office-building',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/users",
            name: "Usuarios",
            component: UserComponent,
            meta: {
                role: ['admin'],
                icon:'mdi-account',
                requiresAuth: true
            }
            , hidden: false
        },      
        {
            path: "/profile",
            name: "Actualizar EMail",
            component: ProfileComponent,
            meta: {
                role: ['admin','user'],
                icon:'mdi-email-multiple',
                requiresAuth: true
            }
            , hidden: false
        },
        {
            path: "/CrearEmpresa",
            name: "Empresa",
            component: CrearEmpresa,
            meta: {
                role: ['admin','user'],
                icon:'mdi-office-building',
                requiresAuth: true
            }
            , hidden: true
        },
        {
            path: "/WebServiceSat",
            name: "WebService",
            component: WebServiceSat,
            meta: {
                role: ['admin','user'],
                icon:'mdi-office-building',
                requiresAuth: true
            }
            , hidden: true
        },
        {
            path: "/Form_Solicitud",
            name: "Expedientes",
            component: Form_Solicitud,
            meta: {
                role: ['admin','user'],
                icon:'mdi-office-building',
                requiresAuth: true
            }
            , hidden: true
        },
        {
            //path: "/Requisitos/:expediente",
            path: "/Requisitos",
            name: "Requisitos",
            component: Requisitos,
            meta: {
                role: ['admin','user'],
                icon:'mdi-office-building',
                requiresAuth: true
            }
            , hidden: true
        }


    ]
})

export default router
