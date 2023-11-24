<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome To webstdy-ecommerce</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="wrapper">
                <!-- Content Wrapper. Contains page content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div
                                    class="pl-5 pr-5 pt-4 d-flex align-items-center justify-content-between"
                                >
                                    <h5>All Product</h5>
                                    <div class="">
                                        <button
                                            class="btn btn-danger"
                                            @click="AddProductModalfun"
                                        >
                                            Add Product
                                            <i
                                                class="fas fa-plus ml-2 mr-2"
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Product Name</th>
                                                <th>Product description</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    product, index
                                                ) in AllProduct"
                                                :key="product.id"
                                            >
                                                <td>{{ index + 1 }}</td>
                                                <td>
                                                    {{ product.productname }}
                                                </td>
                                                <td>
                                                    {{
                                                        product.ProductDescription
                                                    }}
                                                </td>
                                                <td>
                                                    {{ product.ProductPrice }}
                                                </td>
                                                <td>
                                                    {{
                                                        product.productQuantity
                                                    }}
                                                </td>

                                                <td>
                                                    <img
                                                        :src="
                                                            imageUrl +
                                                            '/' +
                                                            product.productImage
                                                        "
                                                        alt="User Avatar"
                                                        class="img-size-60 img-square mr-3 rounded"
                                                        width="90"
                                                    />
                                                </td>
                                                <td>
                                                    <a
                                                        class="mr-4"
                                                        @click.prevent="
                                                            EditProduct(product)
                                                        "
                                                        ><i
                                                            class="fas fa-pen text-white bg-primary rounded p-1"
                                                        ></i
                                                    ></a>

                                                    <a
                                                        @click.prevent="
                                                            DeleteProduct(
                                                                product.id
                                                            )
                                                        "
                                                        ><i
                                                            class="fas fa-trash text-danger"
                                                        ></i
                                                    ></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->

                <!-- /.content-wrapper -->
            </div>
        </div>
    </div>

    <div id="AddProductModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="!update" class="modal-title">Add New Product</h5>
                    <h5 v-else class="modal-title">Edit Product</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form v-if="update" @submit.prevent="updateProduct">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Product name</label>
                                <p
                                    v-if="errors && errors.productname"
                                    class="text text-danger"
                                >
                                    {{ errors.productname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.productname"
                                    name="productname"
                                    id="productname"
                                    placeholder="Enter product name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid"
                                    >Product Description</label
                                >
                                <p
                                    v-if="errors && errors.ProductDescription"
                                    class="text text-danger"
                                >
                                    {{ errors.ProductDescription[0] }}*
                                </p>
                                <textarea
                                    class="form-control"
                                    v-model="product.ProductDescription"
                                    name="ProductDescription"
                                    id="productid"
                                    placeholder="Enter product description"
                                >
                                </textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile"
                                    >Product Image</label
                                >
                                <p
                                    v-if="errors && errors.productImage"
                                    class="text text-danger"
                                >
                                    {{ errors.productImage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="event_image"
                                            @change="HandleImage"
                                        />
                                        <label
                                            v-if="product.productImage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                        >
                                            <p v-if="product.productImage.name">
                                                {{ product.productImage.name }}
                                            </p>
                                            <p v-else>
                                                {{ product.productImage }}
                                            </p>
                                        </label>
                                        <label
                                            v-if="!product.productImage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >Choose file
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            >Upload</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Price</label>
                                <p
                                    v-if="errors && errors.ProductPrice"
                                    class="text text-danger"
                                >
                                    {{ errors.ProductPrice[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.ProductPrice"
                                    name="ProductPrice"
                                    id="ProductPrice"
                                    placeholder="Enter product price  EGP"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Quantity</label>
                                <p
                                    v-if="errors && errors.productQuantity"
                                    class="text text-danger"
                                >
                                    {{ errors.productQuantity[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.productQuantity"
                                    name="productQuantity"
                                    id="productQuantity"
                                    placeholder="Enter product Quantity"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            @click.prevent="updateProduct(product.product_id)"
                            class="btn btn-danger"
                        >
                            Edit product
                        </button>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </form>

                <form v-else @submit.prevent="InsertProduct">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Product name</label>
                                <p
                                    v-if="errors && errors.productname"
                                    class="text text-danger"
                                >
                                    {{ errors.productname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.productname"
                                    name="productname"
                                    id="productname"
                                    placeholder="Enter product name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid"
                                    >Product Description</label
                                >
                                <p
                                    v-if="errors && errors.ProductDescription"
                                    class="text text-danger"
                                >
                                    {{ errors.ProductDescription[0] }}*
                                </p>
                                <textarea
                                    class="form-control"
                                    v-model="product.ProductDescription"
                                    name="ProductDescription"
                                    id="productid"
                                    placeholder="Enter product description"
                                >
                                </textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile"
                                    >Product Image</label
                                >
                                <p
                                    v-if="errors && errors.productImage"
                                    class="text text-danger"
                                >
                                    {{ errors.productImage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="event_image"
                                            @change="HandleImage"
                                        />
                                        <label
                                            v-if="product.productImage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                        >
                                            <p v-if="product.productImage.name">
                                                {{ product.productImage.name }}
                                            </p>
                                            <p v-else>
                                                {{ product.productImage }}
                                            </p>
                                        </label>
                                        <label
                                            v-if="!product.productImage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >Choose file
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            >Upload</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Price</label>
                                <p
                                    v-if="errors && errors.ProductPrice"
                                    class="text text-danger"
                                >
                                    {{ errors.ProductPrice[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.ProductPrice"
                                    name="ProductPrice"
                                    id="ProductPrice"
                                    placeholder="Enter product price  EGP"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Quantity</label>
                                <p
                                    v-if="errors && errors.productQuantity"
                                    class="text text-danger"
                                >
                                    {{ errors.productQuantity[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.productQuantity"
                                    name="productQuantity"
                                    id="productQuantity"
                                    placeholder="Enter product Quantity"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="exampleCheck1"
                                        v-model="variant"
                                        @click="choosevariant"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="exampleCheck1"
                                        >Add variant for this product</label
                                    >
                                </div>
                            </div>
                            <div v-if="variant" class="d-flex col-md-12">
                                <div class="form-group col-md-3">
                                    <label>Options</label>
                                    <select
                                        class="form-control"
                                        style="width: 100%"
                                        v-model="Optionid"
                                        @change="optionvalue(Optionid)"
                                    >
                                        <option hidden selected value="">
                                            choose Option
                                        </option>
                                        <option
                                            v-for="Option in AllOption"
                                            :value="Option.id"
                                        >
                                            {{ Option.OptionName }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Value</label>
                                    <select
                                        class="form-control"
                                        style="width: 100%"
                                        v-model="valueid"
                                    >
                                        <option hidden selected value="">
                                            choose Value
                                        </option>
                                        <option
                                            v-for="val in Allvalue"
                                            :value="val.id"
                                        >
                                            {{ val.valueName }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Price</label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="variantprice"
                                        name="productQuantity"
                                        id="productQuantity"
                                        placeholder="Enter variant Price"
                                    />
                                </div>
                                <div
                                    class="form-group btn btn-success mr-4 align-self-center mt-4"
                                    @click="addvariant"
                                >
                                    +
                                </div>
                            </div>
                            <hr />
                            <div class="card-body">
                                <table
                                    id="example2"
                                    class="table table-bordered table-hover"
                                    v-if="productVaria.length > 0"
                                >
                                    <thead>
                                        <tr>
                                            <th>Option</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                Optionselect, index
                                            ) in productVaria"
                                        >
                                            <td>
                                                <div
                                                    v-for="Option in AllOption"
                                                    :key="Option.id"
                                                    class="d-flex"
                                                >
                                                    <div class="mr-4">
                                                        <p
                                                            v-if="
                                                                Option.id ==
                                                                Optionselect.optionId
                                                            "
                                                        >
                                                            {{
                                                                Option.OptionName
                                                            }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        v-for="val in Option.optionvalues"
                                                    >
                                                        <p
                                                            v-if="
                                                                val.id ==
                                                                Optionselect.valueId
                                                            "
                                                        >
                                                            {{ val.valueName }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                {{ Optionselect.variantPrice }}
                                            </td>
                                            <td>
                                                <a
                                                    @click.prevent="
                                                        deleteoption(index)
                                                    "
                                                    ><i
                                                        class="fas fa-trash text-danger"
                                                    ></i
                                                ></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add product
                        </button>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";
import { UseToaster } from "../toaster.js";
const imageUrl = new URL("../../../storage/app", import.meta.url);
const Allvalue = ref([]);
const AllOption = ref();
const Optionid = ref();
const valueid = ref();
const variantprice = ref();
const productVaria = ref([]);

const Alloption = () => {
    axios.get("/option").then((response) => {
        AllOption.value = response.data;
    });
};
const AllProduct = ref([]);
const toaster = UseToaster();
const errors = ref(null);
const update = ref(false);
const variant = ref();
const product = reactive({
    product_id: "",
    productname: "",
    ProductDescription: "",
    productImage: "",
    productQuantity: "",
    ProductPrice: "",
});
const addvariant = () => {
    productVaria.value.push({
        optionId: Optionid.value,
        valueId: valueid.value,
        variantPrice: variantprice.value,
    });
};
const deleteoption = (index) => {
    productVaria.value.splice(index, 1);
};

const AddProductModalfun = () => {
    product.productname = "";
    product.ProductDescription = "";
    product.productImage = "";
    product.productQuantity = "";
    product.ProductPrice = "";
    productVaria.value = [];
    variant.value=false
    $("#AddProductModal").modal("show");
};
const choosevariant = () => {
    if (variant.value == true) {
    }
};
const InsertProduct = () => {
    const formData = new FormData();
    formData.append("productname", product.productname);
    formData.append("ProductDescription", product.ProductDescription);
    formData.append("productImage", product.productImage);
    formData.append("productQuantity", product.productQuantity);
    formData.append("ProductPrice", product.ProductPrice);
    formData.append("variant", JSON.stringify(productVaria.value));

    axios
        .post("/product", formData)
        .then((response) => {
            $("#AddProductModal").modal("hide");
            AllProduct.value.unshift(response.data);
            toaster.success("Product Added Successfully");
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
        });
};

const HandleImage = (e) => {
    const file = e.target.files[0];
    product.productImage = file;
    console.log(product.productImage);
};
const allProduct = () => {
    axios.get("/product").then((response) => {
        AllProduct.value = response.data;
    });
};
const DeleteProduct = (id) => {
    axios.delete(`/product/delete/${id}`).then((response) => {
        console.log(response.data);
        AllProduct.value = AllProduct.value.filter(
            (product) => product.id !== id
        );
        toaster.success("product delete successfully!");
    });
};

const EditProduct = (ProductItem) => {
    update.value = true;
    product.product_id = ProductItem.id;
    product.productname = ProductItem.productname;
    product.ProductDescription = ProductItem.ProductDescription;
    product.productImage = ProductItem.productImage;
    product.productQuantity = ProductItem.productQuantity;
    product.ProductPrice = ProductItem.ProductPrice;
    $("#AddProductModal").modal("show");
};
const updateProduct = (id) => {
    const formData = new FormData();
    formData.append("productname", product.productname);
    formData.append("ProductDescription", product.ProductDescription);
    formData.append("productImage", product.productImage);
    formData.append("productQuantity", product.productQuantity);
    formData.append("ProductPrice", product.ProductPrice);
    axios.post(`/product/update/${id}`, formData).then((response) => {
        const index = AllProduct.value.findIndex(
            (prod) => prod.id === response.data.id
        );
        AllProduct.value[index] = response.data;
        $("#AddProductModal").modal("hide");
        toaster.success("product update Successfully");
    });
};
const optionvalue = (id) => {
    const All = AllOption.value.filter((Option) => Option.id == id);
    Allvalue.value = All[0].optionvalues;
};
onMounted(() => {
    allProduct();
    Alloption();
});
</script>
