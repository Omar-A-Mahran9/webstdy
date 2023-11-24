<template>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app">
            <aside class="main-sidebar sidebar-light-primary elevation-4">
                <div class="sidebar">
                    <nav class="mt-2">
                        <strong>Filter</strong>

                        <div v-for="option in AllOption">
                            <br />
                            <p>{{ option.OptionName }}</p>
                            <ul
                                class="nav nav-pills nav-sidebar flex-column"
                                data-widget="treeview"
                                role="menu"
                            >
                                <li
                                    v-for="(
                                        values, index
                                    ) in option.optionvalues"
                                    class="nav-item"
                                >
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            v-model="filter"
                                            @click="applyfilter(values.id)"
                                        />
                                        <label class="form-check-label">
                                            {{ values.valueName }}
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <h3 class="text-center">All Products</h3>
                <div class="row justify-content-center">
                    <div
                        v-for="product in AllProduct"
                        :key="product.id"
                        class="card col-2 m-3"
                        style="width: 18rem"
                    >
                        <img
                            :src="imageUrl + '/' + product.productImage"
                            alt="User Avatar"
                        />
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ product.productname }}
                            </h5>
                            <p class="card-text">
                                {{ product.ProductDescription }}
                            </p>
                            <div
                                class="d-flex align-items-center justify-content-between"
                            >
                                <a
                                    @click.prevent="showProduct(product.id)"
                                    class="btn btn-success text-center"
                                    >Buy now</a
                                >
                                <span class="price"
                                    >{{ product.ProductPrice }}
                                    <stron>EGP</stron></span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="control-sidebar control-sidebar-dark">
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
        </div>
    </body>
</template>
<script setup>
import { onMounted, ref } from "vue";

const AllProduct = ref([]);
const AllOption = ref([]);

const filter = ref(false);

const imageUrl = new URL("../../../storage/app", import.meta.url);
const Product = ref();

const allProduct = () => {
    axios.get("/product").then((response) => {
        AllProduct.value = response.data;
    });
};

const applyfilter = (id) => {
    axios.get(`/filter/${id}`, filter).then((response) => {
        AllProduct.value = response.data;
    });
};
const showProduct = (id) => {
    axios.get(`/product/${id}`).then((response) => {
        Product.value = response.data;
    });
};
const Alloption = () => {
    axios.get("/option").then((response) => {
        AllOption.value = response.data;
    });
};
onMounted(() => {
    allProduct();
    Alloption();
});
</script>
