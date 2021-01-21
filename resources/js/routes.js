import Login from './components/LoginComponent.vue';
import MyPolls from './components/PollsComponent.vue';

 
export const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'mypolls',
        path: '/home',
        component: MyPolls
    }
];