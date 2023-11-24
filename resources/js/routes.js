import Dashboard from "@/components/Dashboard.vue";
import product from "@/components/Product.vue";
import Optionns from "@/components/Optionns.vue";
import Home from "@/components/Home.vue";

export default [
    {
        path: "/admin/dashboard",
        name: "admin.dashboard",
        component: Dashboard,
    },
    {
        path: "/admin/product",
        name: "admin.product",
        component: product,
    },
    {
        path: "/admin/optionns",
        name: "admin.optionns",
        component: Optionns,
    },
    {
        path: "/",
        name: "Home",
        component: Home,
    },
];
