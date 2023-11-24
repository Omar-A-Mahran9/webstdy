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
                        <li class="breadcrumb-item active">Options</li>
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
                                    <h5>All Option</h5>
                                    <div class="">
                                        <button
                                            class="btn btn-danger"
                                            @click="AddOption"
                                        >
                                            Add Option
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
                                                <th>Option</th>
                                                <th>value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    option, index
                                                ) in AllOption"
                                                :key="option.id"
                                            >
                                                <td>{{ index + 1 }}</td>
                                                <td>
                                                    {{ option.OptionName }}
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <p
                                                            v-for="optionValue in option.optionvalues"
                                                            :key="
                                                                optionValue.id
                                                            "
                                                        >
                                                            <span class="ml-3">
                                                                -
                                                            </span>
                                                            {{
                                                                optionValue.valueName
                                                            }}
                                                        </p>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a
                                                        @click.prevent="
                                                            DeleteOption(
                                                                option.id
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

    <div id="AddOptionModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="!update" class="modal-title">Add New Option</h5>
                    <h5 v-else class="modal-title">Edit Option</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="InsertOption">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Option name</label>
                                <p
                                    v-if="errors && errors.OptionName"
                                    class="text text-danger"
                                >
                                    {{ errors.OptionName[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="Option.OptionName"
                                    name="OptionName"
                                    id="OptionName"
                                    placeholder="Enter option name"
                                />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="OptionValues">Option Values</label>
                                <p
                                    v-if="errors && errors.OptionValues"
                                    class="text text-danger"
                                >
                                    {{ errors.OptionValues[0] }}*
                                </p>
                                <div class="d-flex">
                                    <input
                                        type="text"
                                        class="form-control mr-2"
                                        v-model="value"
                                        name="OptionValues"
                                        id="OptionValues"
                                        placeholder="Enter Option Value"
                                    />
                                    <div
                                        class="btn btn-success mr-4"
                                        @click="OptionValue"
                                    >
                                        +
                                    </div>
                                </div>
                                <div class="d-flex text-danger">
                                    <p
                                        v-for="(
                                            value, index
                                        ) in Option.OptionValues"
                                        :key="value.id"
                                    >
                                        {{ value }}
                                        <a
                                            @click.prevent="deletevalue(index)"
                                            class="fas fa-trash text-danger mb-3 ml-1 mr-3"
                                        ></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add Option
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
const value = ref();
const AllOption = ref();
const toaster = UseToaster();
const errors = ref(null);
const update = ref(false);
const Option = reactive({
    product_id: "",
    OptionName: "",
    OptionValues: [],
});

const AddOption = () => {
    Option.product_id = "";
    Option.OptionName = "";
    Option.OptionValues = [];
    $("#AddOptionModal").modal("show");
};

const InsertOption = () => {
    axios
        .post("/option", Option)
        .then((response) => {
            $("#AddOptionModal").modal("hide");
            console.log(response.data);
            Alloption.value.unshift(response.data);
            toaster.success("Option Added Successfully");
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
        });
};

const Alloption = () => {
    axios.get("/option").then((response) => {
        AllOption.value = response.data;
        console.log(response.data);
    });
};
const DeleteOption = (id) => {
    axios.delete(`/option/delete/${id}`).then((response) => {
        AllOption.value = AllOption.value.filter((option) => option.id !== id);
        toaster.success("option delete successfully!");
    });
};

const OptionValue = () => {
    Option.OptionValues.push(value.value);
    value.value = "";
};
const deletevalue = (index) => {
    Option.OptionValues.splice(index, 1);
};
onMounted(() => {
    Alloption();
});
</script>
