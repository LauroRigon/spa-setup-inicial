import store from '../vuex'

export default (to, from, next) => {
    if(!isProtectedRoute(to) || isUserAuth()){
        next()
    }else{
        next('/login')
    }
}

const isProtectedRoute = ({meta}) => meta.requireAuth

const isUserAuth = () => store.getters.isLogged