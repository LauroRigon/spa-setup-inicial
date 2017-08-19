//Main do dashboard
import DashboardMain from './Dashboard/components/Main.vue'

//Main de Auth
import AuthMain from './Auth/components/Main.vue'

export default [
    {
        path: '/login',
        component: AuthMain,
        children: [
            {
                path: '/',
                component: require('./Auth/components/Forms/Login.vue')
            }
        ]
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardMain,
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/teste',
        component: require('../views/dashboard/user/User.vue'),
        meta: {
            requireAuth: true
        }
    }
]