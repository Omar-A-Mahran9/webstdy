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

    <div
        v-if="Product"
        style="z-index: 99999"
        class="modal fade"
        id="showProductModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4>show Product</h4>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <img
                                :src="imageUrl + '/' + Product.productImage"
                                alt="User Avatar"
                                class="img-size-60 img-square mr-3 rounded"
                                width="100"
                            />
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 m-2">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="fw-bold modal-title">
                                            {{ Product.productname }}
                                        </h4>
                                        <p class="modal-description">
                                            {{ Product.ProductDescription }}
                                        </p>
                                    </div>
                                    <div
                                        class="col-4 d-flex gap-1 align-items-center"
                                    >
                                        <h4 id="totalPrice"></h4>
                                        <h3 class="fw-bold">
                                            {{ Product.ProductPrice }}
                                            <strong>EGP</strong>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <div
                                class="row align-items-center pb-3 m-2 options-container"
                            ></div>
                            <div v-for="variants in Product.variant">
                                <div v-for="opt in AllOption">
                                    <div v-if="opt.id == variants.Option_id">
                                        <p>{{ opt.OptionName }}</p>
                                        <div v-for="opt in opt.optionvalues">
                                            <a
                                                v-if="
                                                    opt.id ==
                                                    variants.option_values_id
                                                "
                                                class="btn btn-danger"
                                            >
                                                {{ opt.valueName }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>
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
        $("#showProductModal").modal("show");
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
