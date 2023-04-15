<template>
    <div>
        <form id="orderForm">
            <fieldset v-bind:class="{validStyle: orderForm.valid, invalidStyle: orderForm.invalid}">
                <legend>New Order</legend>
                <br>
                <label class="labels"> Order ID: </label><input class="inputs" type="text" v-model="orderForm.orderId">
                <label class="labels"> Order Date: </label><input class="inputs" type = "date" v-model="orderForm.orderDate">
                <label class="labels"> Employee: </label><input class="inputs" type = "text" v-model="orderForm.employee">
                <label class="labels"> Customer:</label> <input class="inputs" type = "text" v-model="orderForm.customer">
                <img alt="Small Bread" src="../../src/assets/SmallBread.png" width="185" height="170">

                <fieldset v-bind:class="{validStyle: productForm.valid, invalidStyle: productForm.invalid}">
                <legend>New Item</legend>
                    <label for="products">Products:</label>
                        <select v-model="productForm.product" name="products" id="products">
                            <option value="White Bread">White Bread</option>
                            <option value="Wheat Bread">Wheat Bread</option>
                            <option value="White Buns">White Buns</option>
                            <option value="Wheat Buns">Wheat Buns</option>
                            <option value="French Bread">French Bread</option>
                            <option value="Flatbread">Flatbread</option>
                        </select>
                    <br>
                    <br>
                    <br>
                    <label>Qty:
                        <input id="qty" type="number" min="1" v-model="productForm.productQuantity"/>
                        
                    </label>
                    <br>
                    <br>
                    <button class="button" type="submit" v-on:click.prevent="addProduct()">Add Product</button>
                </fieldset>

                <table v-if="orderForm.products.length > 0">
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                    </tr>
                    <tr v-for="order in orderForm.products" :key="order.id">
                        <td>{{ order.product }}</td>
                        <td>{{ order.productQuantity }}</td>
                    </tr>
                </table>
                

            </fieldset>
            <button class="button" type="submit" v-on:click.prevent="addOrder()">Submit</button>
            <button class="button" v-on:click.prevent="clearOrders()">Clear</button>
        </form>
    </div>
</template>


<script>
import store from '@/store/index.js';

export default {
    productName: "add-order",
    data: function(){
        return{
            orderForm: {
                orderId: "",
                orderDate: "",
                employee: "",
                customer: "",
                id: null,
                products: [],
                valid: false,
                invalid: true
            },
            productForm: {
                id: null,
                productQuantity: 1, 
                product: "",
                valid: false,
                invalid: true
                
            }
        }
    },
    methods: {
        
        addOrder: function() {
            this.orderForm.id = store.state.orders.length + 1;
            store.commit("addOrder", this.orderForm);

            this.orderForm.orderId = "";
            this.orderForm.orderDate = "";
            this.orderForm.employee = ""; 
            this.orderForm.customer = "";
            this.orderForm.products = [];

            //this.$router.push("orders")

        },
        clearOrders: function() {
            store.dispatch("clearOrders");
        },
        
        addProduct: function() {
            this.productForm.id = this.orderForm.products.length + 1;
            this.orderForm.products.push(Object.assign({},this.productForm));

            this.productForm.productQuantity = 1;
            this.productForm.product = "";
        }
    },
    watch: {
        orderForm: {
            handler: function(){
                if(this.orderForm.orderId == ""){
                    this.orderForm.valid = false;
                    this.orderForm.invalid = true;
                }else {
                    this.orderForm.valid = true;
                    this.orderForm.invalid = false;
                }
            },
                deep: true
                
            },
        productForm: {
            handler: function() {
                if(this.productForm.productName != "") {
                    this.productForm.valid = true;
                    this.productForm.invalid = false;
                }else {
                    this.productForm.valid = false;
                    this.productForm.invalid = true;
                }
            },
            deep: true
        }
    },
}
</script>
   

<style scoped>
    div {
        margin: 25px;
    }
    fieldset {
        background-color: #f2d3a1;
        border: 1px solid #EA3C12;
        width: 600px;;
        margin: auto;
        border-radius: 8px;
        padding: 30px;
        margin-top: 40px;
    }

    legend {
        background-color: #DAB897;
        color: #fc6203;
        padding: 8px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
    }
    .labels {
        display: inline block;
        float: left;
        clear: left;
        width: 200px;
        text-align: right;
        margin-bottom: 10px;
        font-weight: bold;
        color: #8b5220;
        padding: 5px;
    }
    label {
        text-align: right;
        font-weight: bold;
        color: #8b5220;
        padding: 10px;
    }
    .inputs {
        display: inline-block;
        float: left;
    }
    textarea {
        display: inline-block;
    }

    button {
        color: #EFE7DD;
        background-color: #DAB897;
        border-radius: 8px;
        border: none;
        padding: 8px;
        font-size: 16px;
        width: 200px;
        font-weight: bold;
        margin: 10px;
    }
    th{
       color:#8b5220 ;
       padding: 15px;
    }
    td{
       color:#8b5220 ;
       padding: 15px;
    }
    img {
        padding-left: 70px;
    }
    select {
        width:150px;
    }
   
</style>